@extends('main')

@section('content')
<form action="/configs/save" method="POST">
    @csrf
    <div class="container">
        <div class="forms-container">
            <div class="form-group">
                <label for="cabecalho"><b>Cabeçalho</b></label>
                <textarea class="form-control" name="cabecalho" id="cabecalho" cols="30" rows="10" required>{{old('cabecalho', $config->cabecalho)}}</textarea>
            </div>

            <div class="form-group">
                <label for="rodape"><b>Rodapé</b></label>
                <textarea class="form-control" name="rodape" id="rodape" cols="30" rows="10" required>{{old('rodape', $config->rodape)}}</textarea>
            </div>

            <button type="submit" class="btn btn-outline-dark">Salvar</button>
        </div>
    </div>

</form>
@endsection
