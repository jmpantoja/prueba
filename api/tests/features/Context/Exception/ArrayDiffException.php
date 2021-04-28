<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Behat\Context\Exception;
use DomainException;

/**
 * Array contains comparator exception
 */
class ArrayDiffException extends DomainException
{
    /**
     * Class constructor
     *
     * @param string $message
     * @param int $code
     * @param Exception $previous
     * @param mixed $needle
     * @param mixed $haystack
     */
    public function __construct(string $message, $needle = null, $haystack = null)
    {
        // Reusable line of ='s
        $line = str_repeat('=', 80);

        // Format the error message
        $message .= PHP_EOL . PHP_EOL . sprintf(<<<MESSAGE
================================================================================
= Needle =======================================================================
================================================================================
%s

================================================================================
= Haystack =====================================================================
================================================================================
%s

MESSAGE
                ,
                json_encode($needle, JSON_PRETTY_PRINT),
                json_encode($haystack, JSON_PRETTY_PRINT)
            );

        parent::__construct($message);
    }
}
