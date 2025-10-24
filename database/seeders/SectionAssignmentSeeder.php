<?php

namespace Database\Seeders;

use App\Models\AccSectionAssignment;
use App\Models\UserSectionAssignment;
use Illuminate\Database\Seeder;

class SectionAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        // Associar alojamentos a secções
        AccSectionAssignment::create(['accommodation_id' => 1, 'accommodation_section_id' => 1]); // Casa Ribeira → Porto Centro
        AccSectionAssignment::create(['accommodation_id' => 2, 'accommodation_section_id' => 1]); // Apartamento Bolhão → Porto Centro
        AccSectionAssignment::create(['accommodation_id' => 3, 'accommodation_section_id' => 2]); // Vila Gaia → Gaia Riverside
        AccSectionAssignment::create(['accommodation_id' => 4, 'accommodation_section_id' => 2]); // Studio Gaia → Gaia Riverside
        AccSectionAssignment::create(['accommodation_id' => 5, 'accommodation_section_id' => 3]); // Casa Praia → Matosinhos Costa

        // Associar utilizadores a secções
        UserSectionAssignment::create(['user_id' => 3, 'accommodation_section_id' => 1]); // Ana Costa → Porto Centro
        UserSectionAssignment::create(['user_id' => 3, 'accommodation_section_id' => 2]); // Ana Costa → Gaia Riverside
        UserSectionAssignment::create(['user_id' => 4, 'accommodation_section_id' => 2]); // João Santos → Gaia Riverside
        UserSectionAssignment::create(['user_id' => 5, 'accommodation_section_id' => 3]); // Sofia Oliveira → Matosinhos Costa
    }
}
