<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCEP
{
  /**
   * Consulta CEP no via cep
   * 
   * @param string $cep
   * @return boolean|array
   */
   public function buscar(string $cep)
   {
     //Monta a url dinâmica que será consultada no WS do Via CEP
     $url = sprintf('https://viacep.com.br/ws/%s/json/', $cep);
     
     //Pega a resposta do via cep
     $reposta = Http::get($url);

     //Verifica se a resposta falhou <> de 200
     if ($reposta->failed()) {
       return false;
     }

     $dados = $reposta->json();

     //Verifica se a resposta é invalida ex.:cep = 999999999
     if (isset($dados['erro']) && $dados['erro']===true) {
       return false;
     }

     return $dados;
   }
}