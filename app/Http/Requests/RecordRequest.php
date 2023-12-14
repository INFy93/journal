<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            'device_id' => ['required'],
            'node_id' => ['required'],
            'user_id' => ['required'],
            'goals' => ['nullable', 'string'],
            'task' => ['required'],
            'consumables' => ['nullable', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'device_id.required' => 'Необходимо выбрать устройство',
            'node_id.required' => 'Ошибка в получении ID ноды',
            'user_id.required' => 'Необходимо выбрать пользователя',
            'task.required' => 'Необходимо написать, что было сделано'
        ];
    }
}
