<?php

namespace Database\Seeders;

use App\Models\EmployeeIncomeTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeIncomeTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Monedero Digital',
                'to_transfer' => true,
            ],
            [
                'name' => 'Vacaciones',
                'to_transfer' => false,
            ],
        ];
        foreach ($templates as $template) {

            $t = new EmployeeIncomeTemplate;
            $t->name = $template['name'];
            $t->to_transfer = $template['to_transfer'];
            $t->save();
        }
    }
}
