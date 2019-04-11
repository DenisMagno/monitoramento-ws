<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContatoEmergencia extends Model
{
    protected $table = "contatos_emergencia";

    protected $guarded = ['id','created_at', 'updated_at'];

    protected $fillable = ['nome', 'numero', 'parentesco'];

    public function idoso(){
        return $this->belongsTo(Idoso::class);
    }
}
