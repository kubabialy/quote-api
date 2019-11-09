<?php


namespace App\Domain\Quote;


class Quote
{
    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $quote;

    /**
     * Quote constructor.
     * @param string $author
     * @param string $quote
     */
    public function __construct(string $author, string $quote)
    {
        $this->author = $author;
        $this->quote = $quote;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getQuote(): string
    {
        return $this->quote;
    }

    public function getShoutedQuote(): string
    {
        $quote = strtoupper($this->quote);

        $lastQuotesCharacter = substr($quote, strlen($quote)-1);

        if (!ctype_alnum($lastQuotesCharacter)) {
            $quote = substr($quote, 0, -1);
        }

        return sprintf('%s!', $quote);
    }
}