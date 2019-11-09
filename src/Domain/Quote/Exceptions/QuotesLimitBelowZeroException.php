<?php


namespace App\Domain\Quote\Exceptions;


class QuotesLimitBelowZeroException extends \Exception
{
    public $message = 'Quote limit cannot be set to be below 0';
}