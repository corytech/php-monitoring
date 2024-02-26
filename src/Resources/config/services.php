<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Corytech\Monitoring\MonitoringInterface;
use Corytech\Monitoring\StatsdMonitoring;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->defaults()
            ->autoconfigure()
            ->autowire()
        ->set(StatsdMonitoring::class, StatsdMonitoring::class)
        ->alias(MonitoringInterface::class, StatsdMonitoring::class)
    ;
};
