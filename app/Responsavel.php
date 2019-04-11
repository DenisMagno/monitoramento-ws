<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsavel extends Model
{
    use SoftDeletes;

    protected $table = "responsaveis";

    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['nome', 'fcm_token'];

    protected $dates = ['deleted_at'];

    public function idosos(){
        return $this->hasMany(Idoso::class);
    }
}