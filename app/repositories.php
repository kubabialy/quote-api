<?php
declare(strict_types=1);

use App\Domain\Quote\QuoteRepository;
use App\Infrastructure\Persistence\Quote\LocalFileQuoteRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        QuoteRepository::class => autowire(LocalFileQuoteRepository::class)
    ]);
};
