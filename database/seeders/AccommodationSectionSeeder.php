<?php

namespace Database\Seeders;

use App\Models\AccommodationSection;
use Illuminate\Database\Seeder;

class AccommodationSectionSeeder extends Seeder
{
    public function run(): void
    {
        AccommodationSection::create([
            'name' => 'Porto Centro',
            'description' => 'Alojamentos no centro histórico do Porto',
            'company_id' => 1
        ]);

        AccommodationSection::create([
            'name' => 'Gaia Riverside',
            'description' => 'Alojamentos junto ao rio em Vila Nova de Gaia',
            'company_id' => 1
        ]);

        AccommodationSection::create([
            'name' => 'Matosinhos Costa',
            'description' => 'Alojamentos na zona costeira de Matosinhos',
            'company_id' => 1
        ]);
    }
}
