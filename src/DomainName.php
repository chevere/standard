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

use InvalidArgumentException;

final class DomainName
{
    /**
     * Normalizes a custom domain to its lowercase ASCII (punycode) form.
     *
     * @throws InvalidArgumentException If the domain is not a valid hostname
     */
    public static function normalize(string $domain): string
    {
        $domain = rtrim(trim($domain), '.');
        if ($domain === '') {
            throw new InvalidArgumentException();
        }
        $ascii = idn_to_ascii(
            $domain,
            IDNA_NONTRANSITIONAL_TO_ASCII | IDNA_CHECK_BIDI | IDNA_CHECK_CONTEXTJ,
            INTL_IDNA_VARIANT_UTS46
        );
        if ($ascii === false) {
            throw new InvalidArgumentException();
        }
        $ascii = strtolower($ascii);
        if (! str_contains($ascii, '.')
            || filter_var($ascii, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) === false
        ) {
            throw new InvalidArgumentException();
        }

        return $ascii;
    }
}
