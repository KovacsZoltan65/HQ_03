<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Inertia\Inertia;

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

    public function render($request, $exception){
        
        // Ha nem hozható létre kapcsolat az adatbázssal
        if ($exception instanceof \PDOException) {
            //return response()->view('errors.database', ['exception' => $exception], 500);
            return Inertia::render('errors/Database', [
                'exceptions' => $exception,
            ]);
        }

        return parent::render($request, $exception);
    }
}
