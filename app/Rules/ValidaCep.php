<?php

namespace App\Rules;

use App\Services\ViaCEP;
use Illuminate\Contracts\Validation\Rule;

class ValidaCep implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     //Injetando o via cep
    protected ViaCEP $viaCep;

    public function __construct(ViaCEP $viaCep)
    {
        $this->viaCep = $viaCep;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Remove caracteres da mascara
        $cep = $this->removeMask($value);

        // As !! retorna sempre um bollean
        return !! $this->viaCep->buscar($cep);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cep inválido.';
    }

    /**
     * Remove os caracteres das mascaras cpf, cep e telefone
     * 
     * @param string $data
     * @return string
     */
    protected function removeMask(string $data)
    {
        return $data = str_replace(['.','-','(',')',' '], '',$data);
    }
}
