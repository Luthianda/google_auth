<?php

namespace Database\Seeders;

use App\Models\Levels;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['level_name' => 'Admin'],
            ['level_name' => 'User']
        ];

        foreach ($levels as $value){
            Levels::create([
                'level_name' => $value['level_name']
            ]);
        }
    }
}
