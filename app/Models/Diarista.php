<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    /**
     * Define os campos que podem ser gravados
     * @var array
     */
    protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep', 'codigo_ibge', 'foto_usuario'];
    
    /**
     * Define os campos que serão usados na serilização, ou seja, visivel quando converter para json e serem disponiveis na api
     * @var array
     */
    protected $visible = ['nome_completo', 'cidade', 'foto_usuario', 'reputacao'];

    /**
     * Adicionar campos virtual a serialização
     */
    protected $appends = ['reputacao'];

    /**
     * Define caminho completo da imagem
     * @param string $valor
     * @return string 
     */
    public function getFotoUsuarioAttribute($valor)
    {
         return config('app.url') . '/' . $valor;
    }

    /**
     * Define uma reputação randomica
     * @param [type] $valor
     * @return void
     */
    public function getReputacaoAttribute($valor)
    {
        return mt_rand(1, 5);
    }

    /**
     * Busca as diaristas no banco por do código do ibge
     * 
     * @param int $codigoIbge
     * @return array 
     */
    static public function buscaPorCodigoIbge(int $codigoIbge)
    {
        return self::where('codigo_ibge', $codigoIbge)->limit(6)->get();
    }
    
    /**
     * Retorna a quandidade de diaristas por codigo ibge a partir de 6
     * 
     * @param int $codigoIbge
     * @return int 
     */
    static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
        $quantidade = self::where('codigo_ibge', $codigoIbge)->count();

        return $quantidade > 6 ? $quantidade - 6 : 0; 
    }

}
