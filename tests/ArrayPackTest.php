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
use function Chevere\Standard\arrayPack;

final class ArrayPackTest extends TestCase
{
    public function testNoPacking(): void
    {
        $array = [
            'a_id' => 1,
            'b_num' => 2,
            'c_val' => 3,
        ];
        $packed = arrayPack($array);
        $this->assertSame($array, $packed);
    }

    public function testPacking(): void
    {
        $array = [
            'a_id' => null,
            'b_num' => 2,
            'c_val' => 3,
        ];
        $expected = [
            'a' => [
                'id' => null,
            ],
            'b' => [
                'num' => 2,
            ],
            'c' => [
                'val' => 3,
            ],
        ];
        $packed = arrayPack($array, a_: 'a', b_: 'b', c_: 'c');
        $this->assertSame($expected, $packed);
    }
}
