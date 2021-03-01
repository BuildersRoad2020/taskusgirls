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
/*         $user = new User();
        $user->password = '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6';
        $user->email = 'susan.clarin@engagis.com';
        $user->name = 'Susan Clarin';
        $user->save();
        $Role = new RoleUser();
        $Role->roles_id = '1';
        $Role->users_id = $user->id;
        $Role->save(); */

        $users = [
            ['id' => '1','name' => 'Susan Clarin', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Susan.Clarin@engagis.com'],
            ['id' => '2','name' => 'Aeiza Adarne', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Aeiza.Adarne@engagis.com'],
                  
        ];

        $roles = [
            ['roles_id' => '1', 'users_id' => '1'],
            ['roles_id' => '1', 'users_id' => '2'],
            ['roles_id' => '2', 'users_id' => '1'],
            ['roles_id' => '2', 'users_id' => '2']
        ];

        foreach($users as $user) {
           User::create($user); 
            }  

        foreach($roles as $role) {
                RoleUser::create($role); 
                 }  
    }
}
