<?php


namespace App\Domain\Quote;


class Quote
{
    /**
     * Const containing all representation of quotes
     * required to check if the sentence does not end with an inside quote
     */
    private const QUOTATION_MARKS = ['‘','“', '\'', '"'];

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
        $this->quote = self::parseToShoutedFormat($quote);
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

    /**
     * In case of an inside quote an assumption was made that if quote ends with an exclamation mark
     * then an it counts as if the whole sentence was ended with said exclamation mart in other case
     * an exclamation mark will be added at the end of given string
     *
     * @param string $quote
     * @return string
     */
    private static function parseToShoutedFormat(string $quote): string
    {
        $quote = mb_strtoupper($quote);

        $lastQuotesCharacter = mb_substr($quote, strlen($quote)-1);

        if (in_array($lastQuotesCharacter, self::QUOTATION_MARKS, true)) {
            return $quote[mb_strlen($quote) - 2] === '!' ? $quote : sprintf('%s!', $quote);
        }

        if (!ctype_alnum($lastQuotesCharacter)) {
            $quote = mb_substr($quote, 0, -1);
        }

        return sprintf('%s!', $quote);
    }
}