<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;  //Redirecting UnAuthenticated user.

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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }


    /*---------------------My Customized Code---------------------------------------*/
    protected function unauthenticated($request, AuthenticationException $exception)
    {
//        return $request->expectsJson()
//            ? response()->json(['message' => $exception->getMessage()], 401)
//            : redirect()->guest(route('login'));
        if ($request->expectsJson()) {
            response()->json(['message' => $exception->getMessage()], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                return redirect()->guest(route('admin.login'));
                break;

            default:
                return redirect()->guest(route('login'));
        }
    }
}