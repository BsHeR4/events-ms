<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'governorate' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'governorate' => 'Governorate',
            'street' => 'Street',
            'image_path' => 'Image path',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'the :attribute should not be empty, please add the :attribute!',
            'max' => 'the :attribute is too long!',
            'image' => 'the file should be only an image',
            'mimes:jpeg,png,jpg,gif,svg' => 'only allowed (jpeg, png, jpg, gif, svg)',
            'image_path.max' => 'maximum size should be 2MB'
        ];
    }

    /**
     * if the validation failed it return a json response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Failed Validate Data',
            'errors' => $validator->errors(),
        ], 422));
    }
}
