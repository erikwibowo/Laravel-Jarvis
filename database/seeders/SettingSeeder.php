<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'user_id'       => 1,
            'favicon'       => null,
            'logo'          => null,
            'name'          => 'Laravel Jarvis',
            'short_name'    => 'Jarvis',
            'Description'   => 'Laravel Jarvis is a starter project made with Laravel Jetstream Inertia Vue and add more additional feature like User, Role & Permission management, Responsive design, Light/Dark Mode, Rich Table with many features. Check the documentation for more installation.'
        ]);
    }
}
