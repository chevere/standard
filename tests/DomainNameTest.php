<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevere.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chevere\Tests;

use Chevere\Standard\DomainName;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DomainNameTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function dataProviderValid(): array
    {
        return [
            'lowercase' => ['img.example.com', 'img.example.com'],
            'uppercase' => ['IMG.Example.COM', 'img.example.com'],
            'trailing dot' => ['img.example.com.', 'img.example.com'],
            'whitespace' => ['  img.example.com ', 'img.example.com'],
            'idn' => ['Café.Example.com', 'xn--caf-dma.example.com'],
            'punycode uppercase' => ['XN--CAF-DMA.example.com', 'xn--caf-dma.example.com'],
            'hyphen' => ['my-images.example.co.uk', 'my-images.example.co.uk'],
        ];
    }

    #[DataProvider('dataProviderValid')]
    public function testNormalize(string $input, string $expected): void
    {
        $this->assertSame($expected, DomainName::normalize($input));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function dataProviderInvalid(): array
    {
        return [
            'empty' => [''],
            'no dot' => ['localhost'],
            'space inside' => ['img example.com'],
            'underscore' => ['img_x.example.com'],
            'leading hyphen' => ['-img.example.com'],
            'empty label' => ['img..example.com'],
            'scheme' => ['https://img.example.com'],
            'path' => ['img.example.com/path'],
            'label too long' => [str_repeat('a', 64) . '.example.com'],
            'ending numeric' => ['example.123'],
            'IPv4' => ['127.0.0.1'],
            'IPv6' => ['[::1]'],
        ];
    }

    #[DataProvider('dataProviderInvalid')]
    public function testNormalizeInvalid(string $input): void
    {
        $this->expectException(InvalidArgumentException::class);
        DomainName::normalize($input);
    }
}
