<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MatriculaTableSeeder::class);

        $user = new User();
        $user->name = 'Admin Psicoduc';
        $user->email = 'admin@domain.com';
        $user->password = bcrypt('admin123');
        $user->save();

        $user = new User();
        $user->name = 'Colaborador Psicoduc';
        $user->email = 'colaborador@domain.com';
        $user->password = bcrypt('colaborador123');
        $user->save();

    }
}
