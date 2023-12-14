<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'node_id' => ['required'],
            'device_name' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'device_name.required' => 'Необходимо ввести имя устройства'
        ];
    }
}
