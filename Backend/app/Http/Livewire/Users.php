<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Users extends Component
{
    public $layout = 'layouts.app'; // Specify the layout file

    public function message($userId)
    {
        // Logic to handle message action
        $createdConversation =   Conversation::updateOrCreate(['sender_id' => auth()->id(), 'receiver_id' => $userId]);

        $authenticatedUserId = auth()->id();

        # Check if conversation already exists
        $existingConversation = Conversation::where(function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $authenticatedUserId)
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($authenticatedUserId, $userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $authenticatedUserId);
            })->first();

        if ($existingConversation) {
            # Conversation already exists, redirect to existing conversation
            return redirect()->route('chat', ['query' => $existingConversation->id]);
        }

        # Create new conversation
        $createdConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $userId,
        ]);

        return redirect()->route('chat', ['query' => $createdConversation->id]);
    }

    public function render()
    {

        $user_id = Auth()->user()->id;
        if ($user_id == 1) {
            $users = User::whereNotIn('id',[$user_id])->get();;
            return view('livewire.users', ['users' => $users])
                ->layout($this->layout); // Apply the layout here 
        }else{
            $users = User::where('id',1)->get();;
            return view('livewire.users', ['users' => $users])
                ->layout($this->layout); // Apply the layout here 
        }
    }
}
