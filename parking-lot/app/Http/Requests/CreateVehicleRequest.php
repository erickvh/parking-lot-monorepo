<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'plate' => 'required|string|max:7|unique:vehicles,plate',
            'brand' => 'required|string|max:20',
            'color' => 'required|string|max:20',
            'type' => 'required|string|exists:type_vehicles,payment_rules',
        ];
    }
}
