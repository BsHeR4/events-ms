<?php

namespace App\Http\Requests;

use App\Rules\CheckEventCapacity;
use App\Rules\UniqueReservation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReservationRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'event_id' => ['required', 'exists:events,id', new UniqueReservation(),  new CheckEventCapacity()],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    public function attributes()
    {
        return [
            'user_id' => 'User',
            'event_id' => 'Event',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'the :attribute should not be empty, please add the :attribute!',
            'exists' => ':attribute does not exist',
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
