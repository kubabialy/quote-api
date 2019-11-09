<?php


namespace App\Domain\Quote\Exceptions;


class QuotesLimitExceededException extends \Exception
{
    public $message = 'Limit of 10 quotes per request exceeded.';
}