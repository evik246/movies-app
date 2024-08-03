<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Throwable;

class ApiErrorResponse extends HttpResponse implements Responsable
{
    public function __construct(
        protected Throwable $e,
        protected string $message,
        protected int $code = HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
        public ResponseHeaderBag  $headers = new ResponseHeaderBag())
    {
        parent::__construct(null, $code, $headers->allPreserveCaseWithoutCookies());
    }

    public function toResponse($request)
    {
        $response = ['message' => $this->message];

        if ($this->e && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->e->getMessage(),
                'file' => $this->e->getFile(),
                'line' => $this->e->getLine(),
                'trace' => $this->e->getTraceAsString(),
            ];
        }

        return response()->json($response, $this->statusCode, $this->headers->allPreserveCaseWithoutCookies());
    }
}