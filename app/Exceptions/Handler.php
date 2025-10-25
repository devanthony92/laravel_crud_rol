<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\Permission\Exceptions\UnauthorizedException as SpatieUnauthorizedException;
use Throwable;


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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof AuthorizationException) {
    //         if ($request->wantsJson()) {
    //             // Respuesta JSON para API
    //             return response()->json([
    //                 'message' => 'No tienes permisos para realizar esta acción.'
    //             ], 403);
    //         }

    //         // Respuesta web (redirect con mensaje)
    //         return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
    //     }
    //     if ($exception instanceof SpatieUnauthorizedException) {
    //         if ($request->expectsJson()) {
    //             return response()->json([
    //                 'message' => 'No tienes permisos para realizar esta acción.'
    //             ], 403);
    //         }
    //         return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
    //     }

    //     return parent::render($request, $exception);
    // }
}
