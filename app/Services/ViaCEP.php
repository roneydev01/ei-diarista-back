<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCEP
{
   public function buscar(string $cep)
   {
     //Monta a url dinâmica que será consultada no WS do Via CEP
     $url = sprintf('https://viacep.com.br/ws/%s/json/', $cep);
     
     //Pega a resposta do via cep
     $reposta = Http::get($url);

     dd($reposta);
   }
}