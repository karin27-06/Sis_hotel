<?php

namespace App\Http\Requests\Habitacion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number' => 'required|string|max:50|unique:rooms,number,' . $this->route('room')->id,
            'floor_id' => 'required|exists:floors,id',
            'room_type_id' => 'required|exists:room_types,id',
            'price' => 'required|numeric|min:0',
            'characteristics' => 'nullable|string',
            'state' => 'required|in:libre,ocupada,limpieza,mantenimiento,reservado',
        ];
    }

    public function messages(): array
    {
        return [
            'number.required' => 'El número de la habitación es obligatorio.',
            'number.unique' => 'El número de la habitación ya está registrado.',
            'number.max' => 'El número de la habitación no debe exceder los 50 caracteres.',

            'floor_id.required' => 'El piso es obligatorio.',
            'floor_id.exists' => 'El piso seleccionado no es válido.',

            'room_type_id.required' => 'El tipo de habitación es obligatorio.',
            'room_type_id.exists' => 'El tipo de habitación seleccionado no es válido.',

            'price.required' => 'El precio de la habitación es obligatorio.',
            'price.numeric' => 'El precio debe ser un valor numérico.',
            'price.min' => 'El precio no puede ser negativo.',

            'characteristics.string' => 'Las características deben ser texto.',

            'state.required' => 'El estado de la habitación es obligatorio.',
            'state.in' => 'El estado debe ser: libre, ocupada, limpieza, mantenimiento o reservado.',
        ];
    }
}
