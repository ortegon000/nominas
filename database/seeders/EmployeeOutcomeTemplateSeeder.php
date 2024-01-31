<?php

namespace Database\Seeders;

use App\Models\EmployeeOutcomeTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeOutcomeTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'ISPT',
            ],
            [
                'name' => 'Seguro Social',
            ],
        ];
        foreach ($templates as $template) {

            $t = new EmployeeOutcomeTemplate;
            $t->name = $template['name'];
            $t->save();
        }
    }
}
