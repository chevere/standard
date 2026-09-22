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

namespace Chevere\Standard\Interfaces;

use Countable;
use Iterator;
use IteratorAggregate;
use Throwable;

/**
 * Describes the component in charge of describing a collection of errors.
 *
 * @extends IteratorAggregate<int, array{pointer: string, detail: string, ...<string, string>}>
 */
interface ErrorsInterface extends IteratorAggregate, Countable
{
    /**
     * Adds an error to the stack.
     *
     * @param string $pointer The pointer to the location of the error (RFC 6901).
     * @param string|Throwable $detail The detail message describing the error.
     * @param string ...$extra Additional context or information about the error (name: value).
     *
     * @see https://www.rfc-editor.org/info/rfc6901/
     */
    public function with(string $pointer, string|Throwable $detail, string ...$extra): self;

    public function getIterator(): Iterator;
}
