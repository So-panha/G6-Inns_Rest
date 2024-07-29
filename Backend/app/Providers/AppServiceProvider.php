<?php

namespace App\Providers;

use App\Http\Livewire\Users;
use Illuminate\Support\ServiceProvider;
use App\Models\Mailsetting;

use Livewire\Livewire;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('mailsettings')) {
            $mailsetting = Mailsetting::first();
            if($mailsetting){
                $data = [
                    'driver'            => $mailsetting->mail_transport,
                    'host'              => $mailsetting->mail_host,
                    'port'              => $mailsetting->mail_port,
                    'encryption'        => $mailsetting->mail_encryption,
                    'username'          => $mailsetting->mail_username,
                    'password'          => $mailsetting->mail_password,
                    'from'              => [
                        'address'=>$mailsetting->mail_from,
                        'name'   => 'LaravelStarter'
                    ]
                ];
                Config::set('mail',$data);
                Livewire::component('chat.chat-list', \App\Http\Livewire\Chat\ChatList::class);
                Livewire::component('chat.chat-box', \App\Http\Livewire\Chat\ChatBox::class);
                Livewire::component('app.http.livewire.users', Users::class);

            }
        }
    }

    // app/Providers/AppServiceProvider.php


}
