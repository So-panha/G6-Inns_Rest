<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRoomUserRequest extends FormRequest
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
            'price' => 'required|integer',
            'number_of_rooms' => 'required|integer',
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
        ];
    
    }
}



