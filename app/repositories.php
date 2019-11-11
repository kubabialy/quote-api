<?php
declare(strict_types=1);

use App\Domain\Quote\QuoteRepository;
use App\Infrastructure\Cache\CacheInterface;
use App\Infrastructure\Cache\RedisCacheHandler;
use App\Infrastructure\Persistence\Quote\LocalFileQuoteRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        QuoteRepository::class => autowire(LocalFileQuoteRepository::class),
        CacheInterface::class => autowire(RedisCacheHandler::class)
    ]);
};
