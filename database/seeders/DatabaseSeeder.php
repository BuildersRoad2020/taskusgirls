<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        RolesSeeder::class, 
        UserSeeder::class, 
        TaskTypeSeeder::class, 
        ReplacementReasonSeeder::class,     
        DeviceTypeSeeder::class,    
        ApplicationSeeder::class,
        SolutionTypeSeeder::class,    
        SupportTypeSeeder::class,              
        ]);
    }
}
