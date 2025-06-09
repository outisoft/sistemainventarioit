<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // ¡Importante!

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Reglas que siempre aplican
            'no_employee' => 'required|string|max:50|unique:employees,no_employee',
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'position_choice' => 'required|in:new,existing',

            // --- REGLAS CONDICIONALES ---

            // Reglas para el Puesto Existente
            'position_id_existing' => [
                'required_if:position_choice,existing', // Requerido solo si se elige 'existing'
                'exists:positions,id'
            ],

            // Reglas para el Puesto Nuevo
            'email' => [
                'required_if:position_choice,new', // Requerido solo si se elige 'new'
                'nullable', // Permite que sea nulo si no es requerido
                'email',
                'max:255',
                'unique:positions,email'
            ],
            'puesto' => 'required_if:position_choice,new|nullable|string|max:255',
            'departamento_id' => 'required_if:position_choice,new|nullable|exists:departamentos,id',
            'hotel_id' => 'required_if:position_choice,new|nullable|exists:hotels,id',
            'ad' => 'nullable|string|max:255',
        ];
    }
}