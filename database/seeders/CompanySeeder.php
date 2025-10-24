<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'CleanSolutions Lda',
            'email' => 'geral@cleansolutions.pt',
            'phone' => '+351 222 333 444',
            'address' => 'Rua da Limpeza, 123, Porto',
            'nif' => '123456789'
        ]);

        Company::create([
            'name' => 'SparkleClean SA',
            'email' => 'info@sparkleclean.pt',
            'phone' => '+351 211 555 666',
            'address' => 'Avenida da Higiene, 456, Lisboa',
            'nif' => '987654321'
        ]);
    }
}
