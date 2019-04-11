<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Idoso extends Model
{
    use SoftDeletes;

    protected $table = "idosos";

    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['nome', 'grupoSanguineo', 'peso', 'altura', 'logradouro', 'numero', 'cep', 'bairro', 'cidade', 'estado', 'complemento'];

    public function responsavel(){
        return $this->belongsTo(Responsavel::class);
    }

    public function alergias(){
        return $this->hasMany(Alergia::class);
    }

    public function medicamentos(){
        return $this->hasMany(Medicamento::class);
    }

    public function contatosEmergencia(){
        return $this->hasMany(ContatoEmergencia::class);
    }

    public function notificacoes(){
        return $this->hasMany(Notificacao::class);
    }
}
