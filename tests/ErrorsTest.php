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

use Chevere\Standard\Errors;
use Exception;
use PHPUnit\Framework\TestCase;

final class ErrorsTest extends TestCase
{
    public function testConstruct(): void
    {
        $errors = new Errors();
        $this->assertSame([], iterator_to_array($errors));
        $this->assertSame(0, count($errors));
    }

    public function testWith(): void
    {
        $errors = new Errors();
        $with = $errors->with('foo', 'bar', extra: 'context');
        $this->assertNotSame($errors, $with);
        $this->assertSame(
            iterator_to_array($with),
            [...$with],
        );
        $this->assertSame(1, count($with));
        $this->assertSame(
            [
                'pointer' => 'foo',
                'detail' => 'bar',
                'extra' => 'context',
            ],
            ...$with,
        );
    }

    public function testWithThrowable(): void
    {
        $errors = (new Errors())->with('name', new Exception('message'));
        $this->assertSame(
            [
                'pointer' => 'name',
                'detail' => 'message',
            ],
            ...$errors,
        );
    }
}
