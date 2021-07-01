<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\Services\ViaCEP;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{
    /**
     * Handle the incoming request.
     * Metodo Invoke permite criar um controller com um única ação, ou seja apenas um metodo por controller
     * O metodo Invoke  através do cep recebido busca os dados do endereço e com o codigo de IBGE busca as diaristas da mesma área. 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ViaCEP $viaCEP)
    {
       $endereco = $viaCEP->buscar($request->cep);

       //Verifica endereço
       if ($endereco === false) {
           return response()->json(['erro'=>'Cep Invalido'], 400);
       }
        
       $diaristas = Diarista::buscaPorCodigoIbge($endereco['ibge']);
       $quantidade_diaristas = Diarista::quantidadePorCodigoIbge($endereco['ibge']);

       return [
           'diaristas'=> $diaristas,
           'quantidade_diaristas'=>$quantidade_diaristas
       ];
    }
}
