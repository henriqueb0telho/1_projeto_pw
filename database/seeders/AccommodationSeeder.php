<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    public function run(): void
    {
        // Alojamentos para a secção Porto Centro (empresa 1)
        Accommodation::create([
            'name' => 'Casa da Ribeira',
            'description' => 'Encantadora casa no coração do Porto histórico',
            'address' => 'Rua da Ribeira, 123, Porto',
            'max_guests' => 4,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'cleaning_time_estimate' => 2.5,
            'is_active' => true,
            'company_id' => 1
        ]);

        Accommodation::create([
            'name' => 'Apartamento Bolhão',
            'description' => 'Apartamento moderno próximo ao mercado do Bolhão',
            'address' => 'Praça do Bolhão, 45, Porto',
            'max_guests' => 2,
            'bedrooms' => 1,
            'bathrooms' => 1,
            'cleaning_time_estimate' => 1.5,
            'is_active' => true,
            'company_id' => 1
        ]);

        // Alojamentos para a secção Gaia Riverside (empresa 1)
        Accommodation::create([
            'name' => 'Vila Gaia Douro',
            'description' => 'Vila espaçosa com vista para o rio Douro',
            'address' => 'Avenida Diogo Leite, 78, Vila Nova de Gaia',
            'max_guests' => 6,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'cleaning_time_estimate' => 3.0,
            'is_active' => true,
            'company_id' => 1
        ]);

        Accommodation::create([
            'name' => 'Studio Cais de Gaia',
            'description' => 'Studio acolhedor junto às caves de vinho do Porto',
            'address' => 'Rua do Cais, 22, Vila Nova de Gaia',
            'max_guests' => 2,
            'bedrooms' => 1,
            'bathrooms' => 1,
            'cleaning_time_estimate' => 1.0,
            'is_active' => true,
            'company_id' => 1
        ]);

        // Alojamentos para a secção Matosinhos Costa (empresa 1)
        Accommodation::create([
            'name' => 'Casa de Praia Leça',
            'description' => 'Casa familiar a poucos metros da praia',
            'address' => 'Avenida da Liberdade, 156, Matosinhos',
            'max_guests' => 5,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'cleaning_time_estimate' => 2.0,
            'is_active' => true,
            'company_id' => 1
        ]);

        // Alguns alojamentos para a segunda empresa
        Accommodation::create([
            'name' => 'Loft Chiado',
            'description' => 'Loft elegante no coração de Lisboa',
            'address' => 'Rua do Carmo, 89, Lisboa',
            'max_guests' => 3,
            'bedrooms' => 1,
            'bathrooms' => 1,
            'cleaning_time_estimate' => 1.5,
            'is_active' => true,
            'company_id' => 2
        ]);
    }
}
