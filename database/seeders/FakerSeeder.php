<?php

use Illuminate\Database\Seeders;
use App\Empresa;
use App\Otic;
use App\ContactoOtic;
use App\Curso;
use App\Programa;
use App\Notebook;
use App\Proyector;
use App\Relator;
use App\MetasVenta;

class FakerSeeder extends Seeders
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantEmpresas = 20;
        $cantOtic = 10;
        $cantContactoOtic = 20;
        $cantContactoEmpresa = 20;
        $cantCurso = 20;
        $cantPrograma = 5;
        $cantNotebook = 5;
        $cantProyector = 5;
        $cantRelator = 10;
        $cantPendon = 10;

        

        

        factory(Empresa::class, $cantEmpresas)->create();
        factory(\App\ContactoEmpresa::class, $cantContactoEmpresa)->create();
        factory(Otic::class, $cantOtic)->create();
        factory(ContactoOtic::class, $cantContactoOtic)->create();
        factory(Curso::class, $cantCurso)->create();

        $programas = factory(Programa::class, $cantPrograma)->create();

        foreach ($programas as $programa) {
            factory(\App\CursoPrograma::class, 5)->create(['programa_id' => $programa->id]);
        }

        factory(Notebook::class, $cantNotebook)->create();
        factory(Proyector::class, $cantProyector)->create();
        factory(Relator::class, $cantRelator)->create();
        factory(\App\Pendon::class, $cantPendon)->create();

        for ($i=1; $i<34; $i++){
            for ($f=1; $f<13; $f++){
                factory(MetasVenta::class)->create([
                    'mes' => $f,
                    'fecha_reporte' => '2019-'.$f.'-01',
                    'empresa_id' => $i,
                ]);
            }     
        }

    }
}
