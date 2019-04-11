<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ResponsavelNotFoundException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof ResponsavelUpdateException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 422);
        }

        if ($exception instanceof ResponsavelConflictException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof IdosoNotificationCreateException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof IdosoCreateException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 409);
        }

        if ($exception instanceof NotificacaoNotFoundException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof IdosoNotFoundException) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 404);
        }

        return parent::render($request, $exception);
    }
}