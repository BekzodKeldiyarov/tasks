<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|min:8',
            'body' => 'required|min:16',
            'status' => 'required|in:DRAFT,WAITING,PROCESSING,COMPLETED',
            'date' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The name field is required.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'title.min' => 'The title must be at least 8 characters long.',
            'body.required' => 'The body field is required.',
            'body.min' => 'The title must be at least 16 characters long.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status field should be one of [DRAFT, WAITING, PROCESSING, COMPLETED].',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date field format incorrect.',


        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
