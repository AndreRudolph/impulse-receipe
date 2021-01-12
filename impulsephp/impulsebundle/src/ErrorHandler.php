<?php
namespace App;
use Impulse\ImpulseBundle\Kernel\ExceptionHandler;

/**
 * author André Rudolph <rudolph[at]impulse-php.com>
 */
class ErrorHandler extends ExceptionHandler
{
    /**
     * Configures the exception visualization handling for non-debug purpose (e.g. production).
     *
     * @param Throwable $throwable
     *
     * TODO make localization possible!
     */
    protected function configure(Throwable $throwable): void
    {
        $this->customErrorTitle = 'Internal error';
        $this->customErrorMessage = 'An internal error occurred. Please contact the system administrator.';
    }

    /**
     * Configures the exception visualization handling for debug purpose. Please note that this can reveal vulnerable
     * information to the client.
     *
     * @param Throwable $throwable
     */
    protected function configureDebug(Throwable $throwable): void
    {
        $this->includeStackTrace();
    }
}