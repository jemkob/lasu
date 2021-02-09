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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {//https://gist.github.com/jrmadsen67/bd0f9ad0ef1ed6bb594e
            //https://laravel.com/docs/5.6/validation#quick-displaying-the-validation-errors
            $errors = new \Illuminate\Support\MessageBag(['password' => 'For security purposes, the form expired after sitting idle for too long. Please try again.']);
            return redirect()
                            ->back()
                            ->withInput($request->except($this->dontFlash))
                            ->with(['errors' => $errors]);
        }
        return parent::render($request, $exception);
    }
}
