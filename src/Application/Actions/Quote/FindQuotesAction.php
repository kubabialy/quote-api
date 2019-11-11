<?php


namespace App\Application\Actions\Quote;


use App\Domain\Quote\Exceptions\QuotesLimitBelowZeroException;
use App\Domain\Quote\Exceptions\QuotesLimitExceededException;
use App\Domain\Quote\QuoteRepository;
use App\Infrastructure\Cache\CacheInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;


class FindQuotesAction extends QuoteAction
{
    private const QUOTE_LIMIT_PER_REQUEST = 10;

    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(
        LoggerInterface $logger,
        QuoteRepository $quoteRepository,
        CacheInterface $cache
    ) {
        parent::__construct($logger, $quoteRepository);
        $this->cache = $cache;
    }

    /**
     * @return Response
     * @throws QuotesLimitBelowZeroException
     * @throws QuotesLimitExceededException
     * @throws \Slim\Exception\HttpBadRequestException
     */
    protected function action(): Response
    {
        $response = $this->response;

        $limit = (int) $this->request->getQueryParams()['limit'];

        if (self::QUOTE_LIMIT_PER_REQUEST < $limit) {
            throw new QuotesLimitExceededException();
        }

        if (0 > $limit) {
            throw new QuotesLimitBelowZeroException();
        }

        $cacheKey = sprintf('%s-%s', $this->resolveArg('author'), $limit);

        $cachedResult = $this->cache->getElementByKey($cacheKey);

        if ($cachedResult) {
            $response->getBody()->write($cachedResult);

            return $response;
        }

        $author = ucwords(str_replace('-', ' ', $this->resolveArg('author')));

        $quotes = $this->quoteRepository
            ->findQuotesByAuthor($author, $limit);

        $message = $this->buildResponseMessage($author, $quotes);

        $response->getBody()->write($message);

        $this->cache->setElementWithKey($cacheKey, $message);

        return $response;
    }

    private function buildResponseMessage(string $author, array $quotes): string
    {
        if (empty($quotes)) {
            return sprintf('No quotes of %s were found', $author);
        }

        $result = implode(','.PHP_EOL, $quotes);

        $this->cache->setElementWithKey($author, $result);

        return $result;
    }
}