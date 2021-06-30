<?php

namespace App\Http\Controllers;

use App\Services\ViaCEP;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{
    /**
     * Handle the incoming request.
     * Metodo Invoke permite criar um controller com um única ação, ou seja apenas um metodo por controller
     * O metodo Invoke irá buscas as Diaristas por CEP
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ViaCEP $viaCEP)
    {
        $viaCEP->buscar($request->cep);
    }
}
