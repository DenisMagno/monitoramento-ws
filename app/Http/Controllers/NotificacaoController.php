<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacao;
use App\Exceptions\NotificacaoNotFoundException;

class NotificacaoController extends Controller
{
    public function show($id){
        $notificacao = $this->validarNotificacao($id);

        return response()->json($notificacao, 200);
    }

    private function validarNotificacao($id){
        $notificacao = Notificacao::find($id);

        if($notificacao === null){
            throw new NotificacaoNotFoundException("Notificação não encontrada.");
        }

        return $notificacao;
    }
}
