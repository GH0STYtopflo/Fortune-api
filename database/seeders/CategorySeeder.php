<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $dir = dir('/usr/share/fortune');

        while (false !== ($entry = $dir->read())) {
            if (substr($entry, -4, 1) != '.') {
                echo "creating new category '$entry'...\n";
                Category::firstOrCreate(['title' => $entry], ['title' => $entry]);
            }
        }
    }
}
