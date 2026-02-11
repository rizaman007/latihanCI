<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'    => 'Riza MN',
                'email'   => 'riza@example.com',
                'phone'   => '081234567890',
                'message' => 'Halo, ini adalah pesan tes pertama.',
                'created_at' => Time::now(),
            ],
            [
                'name'    => 'Budi Santoso',
                'email'   => 'budi@test.com',
                'phone'   => '081299998888',
                'message' => 'Saya tertarik dengan layanan pengembangan web Laravel.',
                'created_at' => Time::now(),
            ],
        ];
        for ($i = 3; $i <= 15; $i++) {
            $data[] = [
                'name'    => "User Dummy $i",
                'email'   => "user$i@dummy.com",
                'phone'   => "0857000000" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'message' => "Ini adalah pesan otomatis untuk data dummy nomor $i.",
                'created_at' => Time::now(),
            ];
        }

        $this->db->table('contacts')->insertBatch($data);
    }
}