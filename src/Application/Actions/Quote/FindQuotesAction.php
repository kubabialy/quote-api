<?php


namespace App\Application\Actions\Quote;


use App\Domain\Quote\Exceptions\QuotesLimitBelowZeroException;
use App\Domain\Quote\Exceptions\QuotesLimitExceededException;
use Coduo\PHPHumanizer\StringHumanizer;
use Psr\Http\Message\ResponseInterface as Response;


class FindQuotesAction extends QuoteAction
{
    private const QUOTE_LIMIT_PER_REQUEST = 10;

    /**
     * @return Response
     * @throws QuotesLimitBelowZeroException
     * @throws QuotesLimitExceededException
     * @throws \Slim\Exception\HttpBadRequestException
     */
    protected function action(): Response
    {
        $response = $this->response;

        $author = ucwords(str_replace('-', ' ', $this->resolveArg('author')));

        $limit = (int) $this->request->getQueryParams()['limit'];

        if (self::QUOTE_LIMIT_PER_REQUEST < $limit) {
            throw new QuotesLimitExceededException();
        }

        if (0 > $limit) {
            throw new QuotesLimitBelowZeroException();
        }

        $quotes = $this->quoteRepository
            ->findQuotesByAuthor($author, $limit);

        $response->getBody()
            ->write($this->buildResponseMessage($author, $quotes));

        return $response;
    }

    private function buildResponseMessage(string $author, array $quotes): string
    {
        if (empty($quotes)) {
            return sprintf('No quotes of %s were found', $author);
        }

        return implode(','.PHP_EOL, $quotes);
    }
}