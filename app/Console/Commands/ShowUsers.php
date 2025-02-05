<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lista todos os usuários do sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::all();

        $this->table(['ID', 'Nome', 'E-mail', 'É admin'], $users->map(function ($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
                $this->isAdmin($user->is_admin)
            ];
        }));
    }

    private function isAdmin($field)
    {
        $list = [
            0 => 'Não',
            1 => 'Sim'
        ];

        return $list[$field];
    }
}
