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

use PHPUnit\Framework\TestCase;
use function Chevere\Standard\arrayPrefixKeys;

final class ArrayPrefixKeysFunctionTest extends TestCase
{
    public function testEmpty(): void
    {
        $array = [];
        $prefixed = arrayPrefixKeys($array, '');
        $this->assertSame($array, $prefixed);
    }

    public function testPrefix(): void
    {
        $array = [
            'foo' => null,
            'bar' => null,
        ];
        $expected = [
            'prefix.foo' => null,
            'prefix.bar' => null,
        ];
        $prefixed = arrayPrefixKeys($array, 'prefix.');
        $this->assertSame($expected, $prefixed);
    }

    public function testPrefixedIntString(): void
    {
        $array = [
            23 => null,
        ];
        $expected = [
            123 => null,
        ];
        $prefixed = arrayPrefixKeys($array, '1');
        $this->assertSame($expected, $prefixed);
        $prefixed = arrayPrefixKeys($array, '0');
        $expected = [
            '023' => null,
        ];
        $this->assertSame($expected, $prefixed);
    }

    public function testPrefixedInt(): void
    {
        $array = [
            23 => null,
        ];
        $expected = [
            123 => null,
        ];
        $prefixed = arrayPrefixKeys($array, 1);
        $this->assertSame($expected, $prefixed);
        $expected = [
            '023' => null,
        ];
        $prefixed = arrayPrefixKeys($array, 0);
        $this->assertSame($expected, $prefixed);
    }
}
