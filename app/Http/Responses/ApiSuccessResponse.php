<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ApiSuccessResponse implements Responsable
{
    public function __construct(
        protected mixed $data = [], 
        protected array $metadata = [],
        protected int $code = HttpFoundationResponse::HTTP_OK,
        protected array $headers = [])
    {}

    public function toResponse($request)
    {
        return response()->json([
            'data' => $this->data,
            'metadata' => $this->metadata,
        ], $this->code, $this->headers);
    }
}