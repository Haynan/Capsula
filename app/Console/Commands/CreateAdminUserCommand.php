<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserCommand extends Command
{
    protected $signature = 'capsula:create-admin
                            {--name= : Nome do administrador}
                            {--email= : E-mail do administrador}
                            {--password= : Senha do administrador}';

    protected $description = 'Cria ou atualiza o usuário administrador inicial da aplicação.';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Nome do administrador', 'Administrador');
        $email = $this->option('email') ?: $this->ask('E-mail do administrador');
        $password = $this->option('password') ?: $this->secret('Senha do administrador');

        if (! $email || ! $password) {
            $this->error('E-mail e senha são obrigatórios.');

            return self::FAILURE;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ],
        );

        $this->info('Administrador criado/atualizado com sucesso.');

        return self::SUCCESS;
    }
}
