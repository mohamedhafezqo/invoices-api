<?php

namespace App\Listener;

use App\Exception\LogicalException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Class ExceptionListener
 *
 * @package App\Listener
 */
class ExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof LogicalException) {
            $message = json_encode([
                'statusCode' => $exception->getCode(),
                'data' => [],
                'errors' => $exception->getMessage(),
            ]);

            $event->setResponse(new Response($message));
        }
    }
}
