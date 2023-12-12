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
use function Chevere\Standard\arrayChangeValue;

final class ArrayChangeValueFunctionTest extends TestCase
{
    public function testNoChange(): void
    {
        $array = ['a', 'b', 'c'];
        $change = arrayChangeValue($array, 'z');
        $this->assertSame($array, $change);
    }

    public function testChange(): void
    {
        $array = ['a', 2, 2, 'c'];
        $expected = ['a', 'two', 'two', 'c'];
        $change = arrayChangeValue($array, 2, 'two');
        $this->assertSame($expected, $change);
    }

    public function testNoChangeStrict(): void
    {
        $array = ['a', 2, 'c'];
        $expected = $array;
        $noChange = arrayChangeValue($array, '2', 'two');
        $this->assertSame($expected, $noChange);
    }
}
