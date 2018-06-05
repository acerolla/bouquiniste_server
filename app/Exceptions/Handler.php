<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @param Exception $exception
     *
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception                $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        $status = 500;

        if ($this->isHttpException($exception)) {
            $status = $exception->getStatusCode();
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'error'       => $exception->getMessage() ?: 'Something went wrong',
                'errors'      => $exception->errors(),
                'status_code' => $status,
            ], $status);
        }

        if ($exception instanceof UnauthorizedException) {
            $status = 403;
        }

        return response()->json([
            'error'       => $exception->getMessage() ?: 'Something went wrong',
            'status_code' => $status,
        ], $status);
    }
}
