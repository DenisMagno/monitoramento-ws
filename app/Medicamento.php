<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = "medicamentos";

    protected $guarded = ['id','created_at', 'updated_at'];
    
    protected $fillable = ['nome', 'quantidade', 'frequencia'];

    public function idoso(){
        return $this->belongsTo(Idoso::class);
    }
}
