<?php

namespace Database\Seeders;

use App\Models\SupportType;
use Illuminate\Database\Seeder;


class SupportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SupportTypes = [
            ['id' => '1','name' => 'Enterprise'],
            ['id' => '2','name' => 'Essential'],
                             
        ];

        foreach($SupportTypes as $type) {
            SupportType::create($type);
            } 
    }
}
