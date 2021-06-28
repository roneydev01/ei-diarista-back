<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    public function index()
    {
        $diaristas = Diarista::get();
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $dados = $request->except('_token');
        //Metodo para fazer upload e salvar a foto
        $dados['foto_usuario'] = $request->foto_usuario->store('public');

        Diarista::create($dados);

        return redirect()->route('diaristas.index');
    }
}
