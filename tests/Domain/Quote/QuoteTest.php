<?php


namespace Tests\Domain\Quote;


use App\Domain\Quote\Quote;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    public function quoteProvider(): array
    {
        return [
            [
                'author' => 'Albert Einstein',
                'quote' => 'Strive not to be a success, but rather to be of value.',
                'expectation' => 'STRIVE NOT TO BE A SUCCESS, BUT RATHER TO BE OF VALUE!'
            ],
            [
                'author' => 'Steve Jobs',
                'quote' => 'Your time is limited, so don\'t waste it living someone else\'s life!',
                'expectation' => 'YOUR TIME IS LIMITED, SO DON\'T WASTE IT LIVING SOMEONE ELSE\'S LIFE!'
            ],
            [
                'author' => 'Random Dude',
                'quote' => 'This sentence is missing any punctuation',
                'expectation' => 'THIS SENTENCE IS MISSING ANY PUNCTUATION!'
            ]
        ];
    }

    /**
     * @dataProvider quoteProvider
     * @param string $author
     * @param string $quote
     * @param string $expectation
     */
    public function testQuoteParsing(string $author, string $quote, string $expectation): void
    {
        $quote = new Quote($author, $quote);

        $this->assertEquals($expectation, $quote->getShoutedQuote());
    }
}