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
use Chevere\Standard\Interfaces\ExceptionInterface;
use Throwable;

/**
 * Exception that extends with additional errors context.
 */
class Exception extends \Exception implements ExceptionInterface
{
    /**
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param null|Throwable $previous [optional] The previous throwable used for the exception chaining.
     * @param ErrorsInterface $errors [optional] List of errors associated with the exception
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        private ErrorsInterface $errors = new Errors()
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function errors(): ErrorsInterface
    {
        return $this->errors;
    }
}
