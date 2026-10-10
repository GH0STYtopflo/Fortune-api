<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Seeds the database with already available fortunes
 * provided by the fortune-mod package
 */
class FortuneSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        require __DIR__ . '/../../scripts/fortune_extractor.php';
    }
}
