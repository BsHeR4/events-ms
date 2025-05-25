<?php

namespace App\Http\Requests;

use App\Rules\DateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EventRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_member' => 'nullable|integer',
            'start_time' => ['required', 'date', new DateRule()],
            'end_time' => 'required|date|after:start_time',
            'organizer_id' => 'required',
            'event_type_id' => 'required|exists:event_types,id',
            'location_id' => 'required|exists:locations,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Event Name',
            'description' => 'Description',
            'max_member' => 'Max Member',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'event_type_id' => 'Event Type',
            'location_id' => 'Location',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'the :attribute should not be empty, please add the :attribute!',
            'max' => 'the :attribute is too long!',
            'exists' => ':attribute does not exist',
            'end_time.after' => 'End Time must be after Start Time',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'organizer_id' => auth()->id(),
        ]);
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
