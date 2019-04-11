<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacao extends Model
{
    use SoftDeletes;

    protected $table = "notificacoes";

    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['title', 'body', 'icon', 'sound', 'color', 'clickAction', 'tag', 'link', 'fcm_message_id'];

    public function idoso(){
        return $this->belongsTo(Idoso::class);
    }
}
