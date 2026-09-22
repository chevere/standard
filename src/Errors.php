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

namespace Chevere\Standard;

use Chevere\Standard\Interfaces\ErrorsInterface;
use Iterator;
use Throwable;

final class Errors implements ErrorsInterface
{
    /**
     * @var array<int, array{
     *     pointer: string,
     *     detail: string,
     *     ...<string, string>
     * }>
     */
    private array $errors = [];

    /**
     * @var int<0, max>
     */
    private int $count = 0;

    public function with(string $pointer, string|Throwable $detail, string ...$extra): self
    {
        $new = clone $this;
        $new->errors[] = [
            'pointer' => $pointer,
            'detail' => $detail instanceof Throwable
                ? $detail->getMessage()
                : $detail,
            ...$extra,
        ];
        ++$new->count;

        return $new;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function getIterator(): Iterator
    {
        yield from $this->errors;
    }
}
