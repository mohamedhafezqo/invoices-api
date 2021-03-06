<?php declare(strict_types=1);

namespace App\Exception;

/**
 * Class LogicalException
 *
 * @package App\Exception
 */
class LogicalException extends \Exception
{
    public function __construct($message = null, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
