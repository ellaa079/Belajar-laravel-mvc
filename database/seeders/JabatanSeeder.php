<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        Jabatan::create(['jabatan' => 'Manager']);
        Jabatan::create(['jabatan' => 'Staff']);
        Jabatan::create(['jabatan' => 'Direktur']);
    }
}
