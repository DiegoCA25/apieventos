<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (NotFoundHttpException $e,$request) {
            if ($request->is('api/cities/*')) {
                return response()->json([
                    'status'=>false,
                    'message'=> 'The selected city is invalid'
                ],404);
            }
            if ($request->is('api/events/*')) {
                return response()->json([
                    'status'=>false,
                    'message'=> 'The selected event is invalid'
                ],404);
            }
        });
    }
}
