<?php

namespace App\Http\Requests\CCTV;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSwitchRequest extends FormRequest
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
            'name' => 'required|string|unique:cctv_switches,name,' . optional($this->route('cctv_switch'))->id,
            'idf' => 'nullable|string',
            'zona' => 'nullable|in:A,B,C',
            'location_id' => 'nullable|exists:specific_locations,id',
            'brand' => 'required|string',
            'model' => 'required|string',
            'serial' => 'required|string|unique:cctv_switches,serial,' . optional($this->route('cctv_switch'))->id,
            'mac' => 'required|string|unique:cctv_switches,mac,' . optional($this->route('cctv_switch'))->id,
            'ip' => 'required|ip|unique:cctv_switches,ip,' . optional($this->route('cctv_switch'))->id,
            'password' => 'nullable|string',
            'tipo' => 'required|in:principal,secundario,idf',
            'connected_to_id' => 'nullable|exists:cctv_switches,id',
            'connected_port' => 'nullable|string',
            'from_provider' => 'boolean',
            'region_id' => 'required|exists:regions,id',
        ];
    }
}
