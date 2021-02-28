<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoleUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->password = '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6';
        $user->email = 'susan.clarin@engagis.com';
        $user->name = 'Susan Clarin';
        $user->save();
        $Role = new RoleUser();
        $Role->roles_id = '1';
        $Role->users_id = $user->id;
        $Role->save();
    }
}
