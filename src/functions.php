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

/**
 * @return array<int> Bits (powers of two)
 */
function getBits(int $value): array
{
    $return = [];
    $bit = 1;
    while ($bit <= $value) {
        if ($bit & $value) {
            $return[] = $bit;
        }
        $bit <<= 1;
    }

    return $return;
}

function notEmpty(mixed $value): bool
{
    return ! empty($value);
}

/**
 * @phpstan-ignore-next-line
 */
function arrayFilterBoth(array $array, ?callable $callback = null): array
{
    return (new ArrayStandard($array))->filterBoth($callback);
}

/**
 * @phpstan-ignore-next-line
 */
function arrayFilterValue(array $array, ?callable $callback = null): array
{
    return (new ArrayStandard($array))->filterValue($callback);
}

/**
 * @phpstan-ignore-next-line
 */
function arrayFilterKey(array $array, ?callable $callback = null): array
{
    return (new ArrayStandard($array))->filterKey($callback);
}

/**
 * @param string|int $key The key(s) to change (name: change,)
 * @phpstan-ignore-next-line
 */
function arrayChangeKey(array $array, string|int ...$key): array
{
    return (new ArrayStandard($array))->changeKey(...$key);
}

/**
 * @phpstan-ignore-next-line
 */
function arrayPrefixKeys(array $array, string|int $prefix): array
{
    return (new ArrayStandard($array))->prefixKeys($prefix);
}

/**
 * @phpstan-ignore-next-line
 */
function arrayPrefixValues(array $array, string|int|float $prefix): array
{
    return (new ArrayStandard($array))->prefixValues($prefix);
}

/**
 * @param string|int $key Key(s) to unset.
 * @phpstan-ignore-next-line
 */
function arrayUnsetKey(array $array, string|int ...$key): array
{
    return (new ArrayStandard($array))->unsetKey(...$key);
}

/**
 * @param string|int $key Key(s) to take.
 * @phpstan-ignore-next-line
 */
function arrayFromKey(array $array, string|int ...$key): array
{
    return (new ArrayStandard($array))->fromKey(...$key);
}