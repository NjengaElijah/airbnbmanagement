<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Repo\ApiResponseTrait;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response   as ResponseCode;   

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
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
   public function render( $request, Throwable $e)
    {

        if ($request->wantsJson()) {
            if ($e instanceof ModelNotFoundException) {
                return $this->warning($e->getMessage(),ResponseCode::HTTP_NOT_FOUND);
            }
            if ($e instanceof ValidationException   ) {
                return $this->warning($e->validator->errors()->first(),ResponseCode::HTTP_BAD_REQUEST);
            }
            if ($e instanceof NotFoundHttpException) {
                return $this->notFound('Path / Endpoint not found', [$request->path()]);
            }
            if ($e instanceof QueryException    ) {
                return $this->warning('We encountered an error, We are working to resolve it.', $e->getMessage(),ResponseCode::HTTP_BAD_REQUEST);
            }

            if ($e instanceof AuthenticationException) {
                return $this->unauthorized('Un authorized.');
            }
            return $this->failed($e->getMessage(),[
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace(),
            ]);
        }

        return parent::render($request,$e);
    }
}
