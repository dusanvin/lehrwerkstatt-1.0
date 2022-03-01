<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create(['Sprache' => 'Keine']);
        Language::create(['Sprache' => 'Arabisch']);
        Language::create(['Sprache' => 'Bosnisch']);
        Language::create(['Sprache' => 'Bulgarisch']);
        Language::create(['Sprache' => 'Chinesisch']);
        Language::create(['Sprache' => 'Englisch']);
        Language::create(['Sprache' => 'Französisch']);
        Language::create(['Sprache' => 'Italienisch']);
        Language::create(['Sprache' => 'Kroatisch']);
        Language::create(['Sprache' => 'Kurdisch']);
        Language::create(['Sprache' => 'Persisch']);
        Language::create(['Sprache' => 'Polnisch']);
        Language::create(['Sprache' => 'Rumänisch']);
        Language::create(['Sprache' => 'Russisch']);
        Language::create(['Sprache' => 'Spanisch']);
        Language::create(['Sprache' => 'Türkisch']);
    }
}
