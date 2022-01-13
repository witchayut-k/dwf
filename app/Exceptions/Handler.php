<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Intervention\Image\Exception\NotFoundException;
use Mockery\Exception\InvalidOrderException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        // $this->renderable(function (InvalidOrderException $e, $request) {
        //     return response()->view('errors.invalid-order', [], 500);
        // });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('admin/*'))
                return response()->view('backend.errors.404', compact('e'), 404);
            else
                return response()->view('frontend.errors.404', compact('e'), 404);
        });

        $this->renderable(function (UnauthorizedException $e, $request) {
            if ($request->is('admin/*'))
                return response()->view('backend.errors.403', compact('e'), 403);
            else
                return response()->view('frontend.errors.403', compact('e'), 403);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('admin/*'))
                return response()->view('backend.errors.419', compact('e'), 403);
            else
                return response()->view('frontend.errors.404', compact('e'), 404);
        });
    }
}
