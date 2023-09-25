<?php

namespace Repo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponseTrait
{
    private function response($status, $message = 'Success', $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => $status,
                'data' => $data,
                'message' => $message,
            ],
            $status
        );
    }

    public function success($data = [], $message = 'success'): \Illuminate\Http\JsonResponse //200
    {
        return $this->response(ResponseAlias::HTTP_OK, $message, $data);
    }

    public function warning($message = 'warning', $data = [], $response_code = ResponseAlias::HTTP_UNPROCESSABLE_ENTITY): \Illuminate\Http\JsonResponse
    {
        return $this->response($response_code, $message, $data);
    }

    public function notFound($message = 'Not found', $data = []): \Illuminate\Http\JsonResponse //500
    {
        return $this->response(ResponseAlias::HTTP_NOT_FOUND, $message, $data);
    }
    public function failed($message = 'Internal server error', $data = []): \Illuminate\Http\JsonResponse //500
    {
        return $this->response(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, $message, $data);
    }
    public function unauthorized($message = 'Un authorized', $data = []): \Illuminate\Http\JsonResponse //500
    {
        return $this->response(ResponseAlias::HTTP_UNAUTHORIZED, $message, $data);
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        if (request()->wantsJson()) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                        'errors' => $errors,
                        'message' => 'Failed validation',
                    ],
                    ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        return back()->with([
            'success' => 0,
            'msg' => collect($validator->getMessageBag()->getMessages())->first()[0],
        ]);

        throw new \Exception(collect($validator->getMessageBag()->getMessages())->first()[0]);
    }
}