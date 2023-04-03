<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::factory()->create([
            'nom' => "administrateur",
        ]);
        Role::factory()->create([
            'nom' => "commentaire-moderateur",
        ]);
        Role::factory()->create([
            'nom' => "adherent-prenium",
        ]);
        Role::factory()->create([
            'nom' => "adherent",
        ]);
    }
}
