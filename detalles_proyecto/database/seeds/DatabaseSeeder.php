<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'nombre' => Str::random(10),
            'apellido' => Str::random(10),
            'correo' => 'admin@gmail.com',
            'usuario' => 'admin',
            'contrasena' => md5('admin'),
        ]);
    }
}
