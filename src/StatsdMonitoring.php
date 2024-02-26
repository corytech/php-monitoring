<?php

declare(strict_types=1);

namespace Corytech\Monitoring;

use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection\UdpSocket;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class StatsdMonitoring implements MonitoringInterface
{
    private Client $client;

    public function __construct(
        #[Autowire(env: 'STATSD_HOST')]
        string $statsdHost,
        #[Autowire(env: 'int:STATSD_PORT')]
        int $statsdPort,
        #[Autowire(env: 'STATSD_NAMESPACE')]
        string $statsdNamespace
    ) {
        $connection = new UdpSocket($statsdHost, $statsdPort);
        $this->client = new Client($connection, $statsdNamespace);
    }

    public function increment(string $key, array $tags = [], float $sampleRate = 1.0): void
    {
        $this->client->increment($key, $sampleRate, $tags);
    }

    public function decrement(string $key, array $tags = [], float $sampleRate = 1.0): void
    {
        $this->client->decrement($key, $sampleRate, $tags);
    }

    public function count(string $key, float|int $value, array $tags = [], float $sampleRate = 1.0): void
    {
        $this->client->count($key, $value, $sampleRate, $tags);
    }

    public function timing(string $key, float $value, array $tags = [], float $sampleRate = 1.0): void
    {
        $this->client->timing($key, $value, $sampleRate, $tags);
    }

    public function startTiming(string $key, array $tags = []): void
    {
        $this->client->startTiming($key, $tags);
    }

    public function endTiming(string $key, array $tags = [], float $sampleRate = 1.0): void
    {
        $this->client->endTiming($key, $sampleRate, $tags);
    }

    public function gauge(string $key, float|int|string $value, array $tags = []): void
    {
        $this->client->gauge($key, $value, $tags);
    }
}
