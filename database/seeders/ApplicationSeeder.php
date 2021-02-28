<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $reasons = [
            ['id' => '1','name' => '7-Eleven'],
            ['id' => '2','name' => 'Compass'],
            ['id' => '3','name' => 'MH RR'],
            ['id' => '4','name' => 'Eye Play'],                        
            ['id' => '5','name' => 'Eze Impress'],     
            ['id' => '6','name' => 'MRH Kiosk'],     
            ['id' => '7','name' => 'Telstra Pricer'],  
            ['id' => '8','name' => 'Urban Circus'],                                                        
        ];

        foreach($reasons as $reason) {
            Application::create($reason);
            }          
    }
}
