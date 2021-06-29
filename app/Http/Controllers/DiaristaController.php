<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{   
    /**
     *Lista as Diaris 
     *
     * @return void
     */
    public function index()
    {
        $diaristas = Diarista::get();
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    /**
     * Mostra oo formulário de criação
     * 
     * @return void 
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Cria uma diarista no DB
     * 
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $dados = $request->except('_token');

        //Remove caracteres das mascaras
        $dados['cpf'] = $this->removeMask($dados['cpf']);
        $dados['cep'] = $this->removeMask($dados['cep']);
        $dados['telefone'] = $this->removeMask($dados['telefone']);

        //Metodo para fazer upload e salvar a foto
        if ($request->hasFile('foto_usuario')) {
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        Diarista::create($dados);

        return redirect()->route('diaristas.index');
    }

    /**
     * Mostra o formulário de edição populado
     * 
     * @param Integer $id
     * @return void
     */
    public function edit(int $id)
    {
        //findOrFail retorno 404 caso não encontre
        $diarista = Diarista::findOrFail($id);

        return view('edit', [
            'diarista' => $diarista
        ]);
    }

    /**
     * Atualiza uma diarista no DB
     * 
     * @param Integer $id
     * @param Request $request
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //findOrFail retorno 404 caso não encontre
        $diarista = Diarista::findOrFail($id);

        $dados = $request->except(['_token', '_method']);
        
        //Remove caracteres das mascaras
        $dados['cpf'] = $this->removeMask($dados['cpf']);
        $dados['cep'] = $this->removeMask($dados['cep']);
        $dados['telefone'] = $this->removeMask($dados['telefone']);

        //Verifica se tem imagem
        if ($request->hasFile('foto_usuario')) {
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $diarista->update($dados);

        return redirect()->route('diaristas.index');
    }

    /**
     * Apaga uma diarista do DB
     * 
     * @param Integer $id
     * @return void
     */
    public function destroy(int $id)
    {
        $diarista = Diarista::findOrFail($id);

        $diarista->delete();

        return redirect()->route('diaristas.index');
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
