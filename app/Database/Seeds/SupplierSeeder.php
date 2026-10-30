<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $this->db->table('suppliers')->insert([
                'name' => 'Supplier ' . $i,
                'address' => 'Alamat Supplier ' . $i,
                'phone' => '08123456' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'email' => 'supplier' . $i . '@example.com',
            ]);
        }
    }
}
