 @extends('app')

 @section('titulo', 'Nova Diarista')

 @section('conteudo')
  <h3>Nova Diarista</h3>
  <form method="POST" action="{{route('diaristas.store')}}" enctype="multipart/form-data">
     
    @include('_form')
  
  </form>
 @endsection