<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notebook extends Model
{
    use SoftDeletes;
    protected $table = 'notebooks';
    protected $fillable = [
        'codigo',
        'fecha_adquisicion',
        'marca',
        'file_name',
        'hash_file_name',
        'deleted_at'
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class)->withTrashed()->get();
    }

    public function get_notebooks()
    {
        $notebook = Notebook::orderBy('id')->get();

        return $notebook;
    }
    public function get_all_notebooks()
    {
        $notebook = Notebook::withTrashed()->orderBy('id')->get();

        return $notebook;
    }

    public function get_notebook($idNotebook)
    {
        $notebook = Notebook::withTrashed()->where('id',$idNotebook)->first();

        return $notebook;
    }
}
