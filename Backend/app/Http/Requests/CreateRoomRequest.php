<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
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
            //
            'name' => 'required|string|min:5',
            'price' => 'required|integer|min:1',
            'capacity' => 'required|string|min:5',
            'number_of_rooms' => 'required|integer|min:1',
            'bed_type_id' => 'required|integer|min:1',
            'type_of_room_id' => 'required|integer|min:1',
            'description' => 'required|string',
            'guest_house_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }
}
