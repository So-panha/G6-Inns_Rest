<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingUserRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'number_of_rooms' => 'required|integer|min:1',
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'paymented' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'create_by_id' => 'required|exists:users,id',
        ];
    }
}

