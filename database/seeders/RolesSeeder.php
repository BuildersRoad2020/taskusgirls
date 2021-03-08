<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => '1','title' => 'Admin'],
            ['id' => '2','title' => 'User'],
            ['id' => '3', 'title' => 'L2']         
        ];

        foreach($roles as $role) {
            Roles::create($role);
            }   
    }
}
