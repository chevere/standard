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
use function Chevere\Standard\uuidV4;

final class UuidV4FunctionTest extends TestCase
{
    public function testFunction(): void
    {
        $uuidV4 = uuidV4();
        $this->assertMatchesRegularExpression(
            '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
            $uuidV4
        );
    }
}
