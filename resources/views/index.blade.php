 @extends('app')

 @section('titulo', 'Página Inicial')

 @section('conteudo')
  <h3>Lista de Profissionais</h3>
  <table class="table table-striped table-hover">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Telefone</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($diaristas as $diarista)
        <tr>
          <th scope="row">{{$diarista->id}}</th>
          <td>{{$diarista->nome_completo}}</td>
          <td>{{$diarista->telefone}}</td>
          <td>
            <a href="#">Aditar</a>
            <a href="#">Excluir</a>
          </td>
        </tr>
        @empty
          <tr>
            <th ></th>
            <td>Nenhum registro cadastrado</td>
            <td></td>
            <td></td>
          </tr>
      @endforelse
    </tbody>
  </table>
  <a href="{{route('diaristas.create')}}" class="btn btn-primary" role="button">Nova Diarista</a>
 @endsection