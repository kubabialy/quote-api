<?php


namespace App\Domain\Quote;


interface QuoteRepository
{
    /**
     * @param int $numberOfQuotes
     * @return Quote[]
     * @throws QuotesLimitExceededException
     */
    public function findQuoteByAuthor(int $numberOfQuotes): array;
}