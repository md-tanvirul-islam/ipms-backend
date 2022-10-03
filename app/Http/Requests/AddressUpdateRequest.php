<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'ip'    => ['required', 'ip', Rule::unique('addresses')->ignore($this->address->id)],
            'label' => ['required', 'string', Rule::unique('addresses')->ignore($this->address->id)]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(errorResponse(422, $validator->errors(), 'Validation Error.'));
    }
}
