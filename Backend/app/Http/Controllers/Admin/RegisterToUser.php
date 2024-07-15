<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterToUser extends Controller
{
    public function store(Request $request)
    {
        return view('RegisterToUser.register');

        $validated = $request->validate([
            'id' => 'required|numeric',
            'image' => 'required|image|max:2048',
            'nid' => 'required|image|max:2048',
            'message' => 'nullable|string|max:255',
        ]);


    }
}
