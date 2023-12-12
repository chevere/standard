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
use function Chevere\Standard\randomString;

final class RandomStringFunctionTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            [10],
            [20],
            [30],
            [40],
            [50],
            [60],
            [70],
            [80],
            [90],
            [100],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRandomString(int $length): void
    {
        $random = randomString($length);
        $this->assertSame($length, strlen($random));
    }
}
