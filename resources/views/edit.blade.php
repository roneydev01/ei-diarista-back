 @extends('app')

 @section('titulo', 'Editar Diarista')

 @section('conteudo')
  <h3>Editar Diarista</h3>
  <form method="POST" action="{{route('diaristas.update', $diarista) }}" enctype="multipart/form-data">
    @method('PUT')
    
    @include('_form')

  </form>
 @endsection