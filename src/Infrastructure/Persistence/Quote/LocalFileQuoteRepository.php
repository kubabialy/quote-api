<?php


namespace App\Infrastructure\Persistence\Quote;


use App\Domain\Quote\Quote;
use App\Domain\Quote\QuoteRepository;

class LocalFileQuoteRepository implements QuoteRepository
{
    /**
     * @param string $author
     * @param int $numberOfQuotes
     * @return array
     */
    public function findQuotesByAuthor(string $author, int $numberOfQuotes): array
    {
        $localFile = fopen(__DIR__ . '/quotes.json', 'rb') or die('Could not open file');
        $fileContent = fread($localFile, filesize(__DIR__ . '/quotes.json'));
        fclose($localFile);

        $collection = json_decode($fileContent, false);

        $quotes = [];
        foreach ($collection->quotes as $item) {
            if ($item->author === $author) {
                $quote = new Quote($item->author, $item->quote);
                $quotes[] = $quote->getQuote();
            }
        }

        return $quotes;
    }
}