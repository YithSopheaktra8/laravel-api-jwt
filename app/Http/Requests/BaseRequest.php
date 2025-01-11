<?php

namespace App\Http\Requests;

use App\Http\Resources\ApiResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;


class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function failedValidation(Validator $validator)
    {
        $resource = ApiResource::error($validator->errors()->toArray(), 'Validation Error', Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException(
            response()->json($resource, Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
