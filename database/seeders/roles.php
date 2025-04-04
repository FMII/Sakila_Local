<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password=Hash::make('12345678',);
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'invitado']);
        Role::create(['name' => 'cliente']);
        // Staff::create([
        //     'first_name' => 'admin',
        //     'last_name' => 'admin',
        //     'address_id' => 1,
        //     'picture' => null,
        //     'email' => 'fgolmos10@gmail.com',
        //     'store_id' => 1,
        //     'active' => 1,
        //     'username' => 'admin',
        //     'password' => $password,
        //     'rol_id' => 1,
        // ]);

        Staff::insert([
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'address_id' => 1,
                'picture' => null,
                'email' => 'ivettemolina@gmail.com',
                'store_id' => 1,
                'active' => 1,
                'username' => 'admin',
                'password' => $password,
                'rol_id' => 1,
            ],
            [
                'first_name' => 'Jesus',
                'last_name' => 'Aranda',
                'address_id' => 1,
                'picture' => null,
                'email' => 'jesus_aranda_rdz@hotmail.com',
                'store_id' => 1,
                'active' => 1,
                'username' => 'Aranda',
                'password' => $password,
                'rol_id' => 1,
            ],
            [
                'first_name' => 'Gael',
                'last_name' => 'Guevara',
                'address_id' => 1,
                'picture' => null,
                'email' => 'angelgaelguevara@gmail.com',
                'store_id' => 1,
                'active' => 1,
                'username' => 'Gael',
                'password' => $password,
                'rol_id' => 1,
            ]
        ]);
    }
}
