<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    protected $table = "alergias";

    protected $guarded = ['id','created_at', 'updated_at'];

    protected $fillable = ['descricao'];

    public function idoso(){
        return $this->belongsTo(Idoso::class);
    }
}
