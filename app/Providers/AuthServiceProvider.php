<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registre quaisquer serviços de autenticação e autorização.
     *
     * @return void
     */
    public function boot()
    {
        // Registra as policies
        $this->registerPolicies();

        // Define a permissão para criação de admins
        Gate::define('create-admin', function (User $user) {
            return $user->role === 'admin';
        });
    }

    /**
     * Registre as policies do sistema.
     *
     * @return void
     */
    public function registerPolicies()
    {
        // Aqui você registra as policies do seu sistema, se houver
    }
}
