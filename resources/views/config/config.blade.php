@extends('main')

@section('content')
<form action="/configs/save" method="POST">
    @csrf

    <div class="forms-container">
        <div class="form-group">
            <label for="cabecalho"><b>Cabecalho</b></label>
            <textarea class="form-control" name="cabecalho" id="cabecalho" cols="30" rows="10">{{old('cabecalho', $config->cabecalho)}}</textarea>
        </div>

        <div class="form-group">
            <label for="rodape"><b>Rodape</b></label>
            <textarea class="form-control" name="rodape" id="rodape" cols="30" rows="10">{{old('rodape', $config->rodape)}}</textarea>
        </div>

        <button type="submit" class="btn btn-outline-dark">Salvar</button>
    </div>
</form>
@endsection
