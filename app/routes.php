<?php
declare(strict_types=1);

use App\Application\Actions\Quote\FindQuotesAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/quotes', function (Group $group) {
        $group->get('/shout/{author}', FindQuotesAction::class);
    });
};
