<?php


namespace App\Domain\Quote;


interface QuoteRepository
{
    /**
     * This method returns converted quotes for given author
     *
     * @param string $author
     * @param int $numberOfQuotes
     * @return Quote[]
     */
    public function findQuotesByAuthor(string $author, int $numberOfQuotes): array;
}