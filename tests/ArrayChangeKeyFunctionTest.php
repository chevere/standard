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
use function Chevere\Standard\arrayChangeKey;

final class ArrayChangeKeyFunctionTest extends TestCase
{
    public function testNoChange(): void
    {
        $array = [
            'key1' => null,
            'key2' => null,
        ];
        $change = arrayChangeKey($array, test: 'try');
        $this->assertSame($array, $change);
        $change = arrayChangeKey($array, 'try');
        $this->assertSame($array, $change);
    }

    public function testChange(): void
    {
        $changeKey = 'try';
        $array = [
            'keyA' => null,
            'keyB' => null,
            'keyC' => null,
        ];
        $expected = [
            'keyB' => null,
            'keyC' => null,
            $changeKey => null,
        ];
        $change = arrayChangeKey($array, keyN: 'keyM', keyA: $changeKey);
        $this->assertNotSame($array, $change);
        $this->assertSame($expected, $change);
    }

    public function testChangeFromInt(): void
    {
        $changeKey = 'key1';
        $array = [
            0 => null,
        ];
        $expected = [
            $changeKey => null,
        ];
        $change = arrayChangeKey($array, ...[
            0 => $changeKey,
        ]);
        $this->assertNotSame($array, $change);
        $this->assertSame($expected, $change);
    }

    public function testChangeToInt(): void
    {
        $changeKey = 0;
        $array = [
            'key1' => null,
        ];
        $expected = [
            $changeKey => null,
        ];
        $change = arrayChangeKey($array, key1: $changeKey);
        $this->assertNotSame($array, $change);
        $this->assertSame($expected, $change);
    }
}
