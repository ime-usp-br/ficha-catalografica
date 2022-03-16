@extends('main')

@section('content')

<div class="container">
    <p><b>Cabeçalho e rodapé: </b> <a href="/configs/edit" class="btn btn-outline-dark">Editar</a></p>
    

    <p><b>Número de fichas criadas: </b>{{$config->num_fichas ? $config->num_fichas : 0}}</p>

</div>

@endsection