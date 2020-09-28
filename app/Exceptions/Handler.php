<?php

namespace App\Exceptions;

use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        /*   $this->renderable(function ($request, Exception $exception) {
            if ($exception instanceof TokenBlacklistedException) {
                return response(['error' => 'Token can not be used, get new one'], Response::HTTP_BAD_REQUEST);
            } elseif ($exception instanceof TokenInvalidException) {
                return response(['error' => 'Token is invalid'], Response::HTTP_BAD_REQUEST);
            } elseif ($exception instanceof TokenExpiredException) {
                return response(['error' => 'Token is expired'], Response::HTTP_BAD_REQUEST);
            } elseif ($exception instanceof JWTException) {
                return response(['error' => 'Token is not provided'], Response::HTTP_BAD_REQUEST);
            }
            return parent::render($request, $exception);
        });
        */
    }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenBlacklistedException) {
            return response(['error' => 'Token can not be used, get new one'], Response::HTTP_BAD_REQUEST);
        } elseif ($exception instanceof TokenInvalidException) {
            return response(['error' => 'Token is invalid'], Response::HTTP_BAD_REQUEST);
        } elseif ($exception instanceof TokenExpiredException) {
            return response(['error' => 'Token is expired'], Response::HTTP_BAD_REQUEST);
        } elseif ($exception instanceof JWTException) {
            return response(['error' => 'Token is not provided'], Response::HTTP_BAD_REQUEST);
        }
        return parent::render($request, $exception);
    }
}
