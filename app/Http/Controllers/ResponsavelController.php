<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsavel;
use App\Notificacao;
use App\Idoso;
use App\Exceptions\ResponsavelNotFoundException;
use App\Exceptions\ResponsavelUpdateException;
use App\Exceptions\ResponsavelConflictException;
use App\Exceptions\IdosoCreateException;

class ResponsavelController extends Controller
{
    public function updateToken($id, Request $request){
        $responsavel = $this->validarResponsavel($id);

        $token = $request->input('fcm_token');

        if($responsavel->fcm_token != $token){
            $responsavel->fcm_token = $token;
            if(!$responsavel->save()){
                throw new ResponsavelUpdateException("Responsável não pôde ser atualizado.");
            }
    
            return response()->json($responsavel, 200);
        }else{
            throw new ResponsavelConflictException("Token não foi alterado!");
        }
    }

    public function store(Request $request){
        $responsavel = new Responsavel();

        $token = $request->input('fcm_token');

        $responsavel->fill($request->all());
        $responsavel->save();

        return response()->json($responsavel, 201);
    }

    public function show($id){
        $responsavel = $this->validarResponsavel($id);

        return response()->json($responsavel, 200);
    }

    public function storeIdoso($id, Request $request){
        $idoso = new Idoso();

        $idoso->responsavel_id = $id;
        $idoso->fill($request->all());

        if($idoso->save()){
            return response()->json($idoso, 201);
        }else{
            throw new IdosoCreateException("Não foi possível criar o idoso!");
        }
    }

    private function validarResponsavel($id){
        $responsavel = Responsavel::find($id);

        if($responsavel === null){
            throw new ResponsavelNotFoundException("Responsável não encontrado.");
        }

        return $responsavel;
    }
}