<?php declare(strict_types=1);

namespace kstirkou\OAT\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class InvalidArgumentException
 *
 * @package kstirkou\OAT\Exception
 */
class InvalidArgumentException extends HttpException
{
    /**
     * @inheritdoc
     */
    public function __construct(string $message = null, \Exception $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(400, $message, $previous, $headers, $code);
    }
}