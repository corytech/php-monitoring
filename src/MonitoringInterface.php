<?php

declare(strict_types=1);

namespace Corytech\Monitoring;

interface MonitoringInterface
{
    /**
     * @psalm-param array<string,string> $tags
     */
    public function increment(string $key, array $tags = [], float $sampleRate = 1.0): void;

    /**
     * @psalm-param array<string,string> $tags
     */
    public function decrement(string $key, array $tags = [], float $sampleRate = 1.0): void;

    /**
     * @psalm-param array<string,string> $tags
     */
    public function count(string $key, int|float $value, array $tags = [], float $sampleRate = 1.0): void;

    /**
     * @psalm-param array<string,string> $tags
     */
    public function timing(string $key, float $value, array $tags = [], float $sampleRate = 1.0): void;

    /**
     * @psalm-param array<string,string> $tags
     */
    public function startTiming(string $key, array $tags = []): void;

    /**
     * @psalm-param array<string,string> $tags
     */
    public function endTiming(string $key, array $tags = [], float $sampleRate = 1.0): void;

    /**
     * @psalm-param array<string,string> $tags
     */
    public function gauge(string $key, int|string|float $value, array $tags = []): void;
}
