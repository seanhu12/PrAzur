<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RolTableSeeder::class);
        $this->call(RolUserTableSeeder::class);
        $this->call(CiudadTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(TipoServicioTableSeeder::class);
        $this->call(MotivoTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(TematicaTableSeeder::class);
        $this->call(TipoContactoTableSeeder::class);
        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(EstapaTableSeeder::class);
        $this->call(ParametroTableSeeder::class);
        $this->call(EstadoOperacionalTableSeeder::class);
        $this->call(UrgenciaTableSeeder::class);
        $this->call(ComplejidadGrupoTableSeeder::class);
        $this->call(FocoIntervencionTableSeeder::class);
        $this->call(ParticipantePerfilTableSeeder::class);
        $this->call(TipoDocumentoChecklistTableSeeder::class);
        $this->call(EmpresaTableSeeder::class); 

        // $this->call(FakerSeeder::class);

    }
}
