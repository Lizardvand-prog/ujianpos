<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SalesSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 200; $i++) {
            $this->db->table('sales')->insert([
                'supplier_id' => rand(1, 100),
                'total' => rand(10000, 1000000),
            ]);
        }
    }
}
