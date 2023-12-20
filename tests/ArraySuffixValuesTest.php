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
use function Chevere\Standard\arraySuffixValues;

final class ArraySuffixValuesTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            ['foo', 'bar'],
            [1, 1],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFunction($value, $suffix): void
    {
        $list = [$value];
        $result = arraySuffixValues($list, $suffix);
        $this->assertSame([$value . $suffix], $result);
    }

    public function testTypeJuggling(): void
    {
        $list = ['wea'];
        $prefix = 1;
        $result = arraySuffixValues($list, $prefix);
        $this->assertSame(['wea1'], $result);
    }
}
