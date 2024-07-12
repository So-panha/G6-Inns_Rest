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
            'price' => 'required|integer',
            'number_of_rooms' => 'required|integer',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
           
        ];
    }
}

