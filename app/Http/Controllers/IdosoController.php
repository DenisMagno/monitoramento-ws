<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idoso;
use App\Notificacao;
use App\Events\FallAlert;
use App\Exceptions\IdosoNotFoundException;
use App\Exceptions\IdosoNotificationCreateException;
use App\Http\Resources\NotificacaoResource;

class IdosoController extends Controller
{
    public function storeNotificacao($id, Request $request){
        $notificacao = new Notificacao();

        $notificacao->idoso_id = $id;
        $notificacao->fill($request->all());

        if($notificacao->save()){
            event(new FallAlert($notificacao));

            if(Notificacao::find($notificacao->id) === null){
                throw new IdosoNotificationCreateException("Não foi possível criar a notificação do idoso!");
            }else{
                return response()->json(new NotificacaoResource($notificacao), 201);
            }
        }else{
            throw new IdosoNotificationCreateException("Não foi possível criar a notificação do idoso!");
        }
    }

    public function show($id){
        $idoso = $this->validarIdoso($id);

        return response()->json($idoso, 200);
    }

    private function validarIdoso($id){
        $idoso = Idoso::find($id);

        if($idoso === null){
            throw new IdosoNotFoundException("Idoso não encontrado.");
        }

        return $idoso;
    }
}