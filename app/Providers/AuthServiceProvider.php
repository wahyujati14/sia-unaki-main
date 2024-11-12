<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $name = 'Halo '.@Auth::user()->name??request()->name;
            return (new MailMessage)
                ->from('support.unaki@gmail.com', 'Admin')
                ->greeting($name)
                ->line('Terima kasih telah melakukan Pendaftaran di Universitas AKI.  Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.')
                ->salutation(' ')
                ->subject('Verifikasi alamat email')
                ->action('Verifikasi Email', $url);
        });
    }
}
