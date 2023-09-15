<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            SexoSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            PermisoSeeder::class,
            PersonSeeder::class,
            UserSeeder::class,
            LaboratorioSeeder::class,
            GeolocalizacionLaboratorioSeeder::class,
            ModuloSeeder::class,
            LaboratorioModuloSeeder::class,
            OrigenNauplioSeeder::class,
            ActividadSeeder::class,
            EstadioLarvalSeeder::class,
            ValorCrecimientoSeeder::class,
            EstadioLarvalValorSeeder::class,
            BranquiaSeeder::class,
            MediosCultivoSeeder::class,
            AlimentacionSeeder::class,
            DietaSeeder::class,
            LipidoSeeder::class,
            MusculosSeeder::class,
            GrupoSeeder::class
        ]);
    }
}
