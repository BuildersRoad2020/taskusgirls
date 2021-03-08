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
            ['id' => '3','name' => 'Wendell Segundo', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'wendell.segundo@engagis.com'],
            ['id' => '4','name' => 'Melvin Dacut', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Melvin.Dacut@engagis.com'],
            ['id' => '5','name' => 'Samir Bastola', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Samir.Bastola@engagis.com'],
            ['id' => '6','name' => 'Dinesh Lama', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Dinesh.Lama@engagis.com'],
            ['id' => '7','name' => 'Naila Casino', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Naila.Casino@engagis.com'],
            ['id' => '8','name' => 'Emee Casas', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Emee.Casas@engagis.com'],
            ['id' => '9','name' => 'Keziah Cababaros Adarne', 'password' => '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6', 'email' => 'Keziah.Cababaros@engagis.com'],
       
        ];

        $roles = [
            ['roles_id' => '1', 'users_id' => '1'],
            ['roles_id' => '1', 'users_id' => '2'],
            ['roles_id' => '2', 'users_id' => '1'],
            ['roles_id' => '2', 'users_id' => '2'],
            ['roles_id' => '1', 'users_id' => '3'],
            ['roles_id' => '3', 'users_id' => '3'],
            ['roles_id' => '3', 'users_id' => '4'],
            ['roles_id' => '3', 'users_id' => '5'],
            ['roles_id' => '3', 'users_id' => '6'],      
            ['roles_id' => '3', 'users_id' => '7'], 
            ['roles_id' => '3', 'users_id' => '8'],
            ['roles_id' => '3', 'users_id' => '9'],                                            
        ];

        foreach($users as $user) {
           User::create($user); 
            }  

        foreach($roles as $role) {
                RoleUser::create($role); 
                 }  
    }
}
