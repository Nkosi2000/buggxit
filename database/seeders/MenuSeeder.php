<?php

namespace Database\Seeders;
use App\Models\Menu;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Menu::create(['label' => 'Home', 'url' => '/', 'order' => 1]);
        Menu::create(['label' => 'Products', 'url' => '/products', 'order' => 2]);
        Menu::create(['label' => 'About', 'url' => '/about', 'order' => 3]);
        Menu::create(['label' => 'Contact', 'url' => '/contact', 'order' => 4]);
    }
}
