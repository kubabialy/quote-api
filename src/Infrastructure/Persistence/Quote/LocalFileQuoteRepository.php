<?php


namespace App\Infrastructure\Persistence\Quote;


use App\Domain\Quote\Quote;
use App\Domain\Quote\QuoteRepository;

class LocalFileQuoteRepository implements QuoteRepository
{
    /**
     * @param string $author
     * @param int $numberOfQuotes
     * @param string|null $path
     * @return array
     */
    public function findQuotesByAuthor(string $author, int $numberOfQuotes, string $path = __DIR__.'/quotes.json'): array
    {
        $localFile = fopen($path, 'rb') or die('Could not open file');
        $fileContent = fread($localFile, filesize($path));
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