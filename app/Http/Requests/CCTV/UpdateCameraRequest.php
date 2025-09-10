<?php

namespace App\Http\Requests\CCTV;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCameraRequest extends FormRequest
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
            'name' => 'required|string|unique:cctv_cameras,name,' . optional($this->route('cctv_camera'))->id,
            'idf' => 'nullable|string',
            'zona' => 'nullable|in:A,B,C',
            'location_id' => 'nullable|exists:specific_locations,id',
            'brand' => 'required|string',
            'model' => 'required|string',
            'serial' => 'required|string|unique:cctv_cameras,serial,' . optional($this->route('cctv_camera'))->id,
            'mac' => 'required|string|unique:cctv_cameras,mac,' . optional($this->route('cctv_camera'))->id,
            'ip' => 'required|ip|unique:cctv_cameras,ip,' . optional($this->route('cctv_camera'))->id,
            'type_camera_id' => 'required|exists:type_cameras,id',
            'switch_id' => 'nullable|exists:cctv_switches,id',
            'connected_port' => 'nullable|string',
            'region_id' => 'required|exists:regions,id',
        ];
    }
}
