<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneStoreRequest extends FormRequest
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
            'extension' => 'required|unique:phones,extension',
            'service' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:phones,serial',
            'room_id' => 'required|exists:rooms,id',
            'region_id' => 'required|exists:regions,id',
        ];
    }
}
