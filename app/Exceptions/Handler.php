<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if ($this->shouldReport($e) && app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse('URL no encontrada', 404);
            }
        });


        $this->renderable(function (\Error $e, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse('Error en el servidor.', 405);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return $this->convertValidationExceptionToResponse($e, $request);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse('El método especificado en la petición no es válido', 405);
            }
        });

        $this->renderable(function (HttpException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
            }
        });

        $this->renderable(function (\BadMethodCallException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), 500);
            }
        });

        $this->renderable(function (BindingResolutionException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), 500);
            }
        });

        $this->renderable(function (DecryptException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), 500);
            }
        });

        $this->renderable(function (ClientException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), 500);
            }
        });

        $this->renderable(function (QueryException $exception, $request) {
            if ($request->is('api/*')) {
                $code = $exception->errorInfo[1];
                if ($code == 1451) {
                    return $this->errorResponse('No se puede eliminar de forma permamente el recurso porque está relacionado con algún otro.', 409);
                }
                if($code == 7){
                    return $this->errorResponse('Error relacionado con la base de datos o sus modelos y los datos enviados.', 409);
                }

                return $this->errorResponse($exception->getMessage(), 500);
            }
        });

        $this->renderable(function (TokenMismatchException $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), 500);
            }
        });

        $this->renderable(function (\Exception $exception, $request) {
            if ($request->is('api/*')) {
                return $this->errorResponse($exception->getMessage(), 500);
            }
        });
    }
}
