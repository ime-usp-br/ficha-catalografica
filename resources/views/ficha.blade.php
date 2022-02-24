@include('main')

<div class="card">
    <div class="card-body">

        <form action="/ficha" method="POST">
            @csrf

            <div class="form-group">
                <label for="nusp">Nº USP</label>
                <input class="form-control" type="text" id="nusp" name="nusp">
            </div>

            <div class="form-group">
                <label for="email-contato">Email para contato</label>
                <input class="form-control" type="text" id="email-contato" name="email-contato">
            </div>

            <div class="form-group">
                <label for="email-confirm">Confirmar email</label>
                <input class="form-control" type="text" id="email-confirm" name="email-confirm">
            </div>

            <div class="form-group">
                <label for="prenome">Prenome, primeiros sobrenomes, partículas de ligação</label>
                <input class="form-control" type="text" id="prenome" name="prenome">
            </div>

            <div class="form-group">
                <label for="pessoa_ultimonome">Último sobrenome e acréscimos de agnomes (Júnior, Filho, Segundo, Neto, Sobrinho, etc.)</label>
                <input class="form-control" type="text" id="pessoa_ultimonome" name="pessoa_ultimonome">
            </div>

            <div class="form-group">
                <label for="titulo_trabalho">Título do trabalho</label>
                <input class="form-control" type="text" id="titulo_trabalho" name="titulo_trabalho">
            </div>

            <div class="form-group">
                <label for="subtitulo_trabalho">Subtítulo do trabalho</label>
                <input class="form-control" type="text" id="subtitulo_trabalho" name="subtitulo_trabalho">
            </div>

            <div class="form-group">
                <label for="orientador_nome">Nome do orientador</label>
                <input class="form-control" type="text" id="orientador_nome" name="orientador_nome">
            </div>

            <div class="form-group">
                <label for="orientador_ultimonome">Sobrenome do orientador</label>
                <input class="form-control" type="text" id="orientador_ultimonome" name="orientador_ultimonome">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="sou_orientadora" name="sou_orientadora">
                <label class="form-check-label" for="sou_orientadora">
                    Orientadora?
                </label>
            </div>

            <div class="form-group">
                <label for="coorientador_nome">Nome do coorientador</label>
                <input class="form-control" type="text" id="coorientador_nome" name="coorientador_nome">
            </div>

            <div class="form-group">
                <label for="coorientador_ultimonome">Sobrenome do coorientador</label>
                <input class="form-control" type="text" id="coorientador_ultimonome" name="coorientador_ultimonome">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="coorientadora">
                <label class="form-check-label" for="coorientadora">
                    Coorientadora?
                </label>
            </div>

            <div class="form-group">
                <label for="ano">Ano</label>
                <input class="form-control" type="text" id="ano" name="ano">
            </div>

            <div class="form-group">
                <label for="no_paginas">Número de páginas</label>
                <input class="form-control" type="text" id="no_paginas" name="no_paginas">
            </div>
        
            <div class="form-group">
                <label class="control-label">Contém ilustração?</label>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ilustracoes" id="ilustracao_sim" value="Sim">
                <label class="form-check-label" for="ilustracoes">
                    Sim
                </label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ilustracoes" id="ilustracao_nao" value="nao">
                <label class="form-check-label" for="ilustracao_nao">
                    Não
                </label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="hidden">Assuntos (MÍN. 1, MAX. 5)</label>
                <input type="hidden" id="hidden">
            </div>

            <div class="form-group">
                <label for="assunto1">Assunto 1</label>
                <input class="form-control" type="text" id="assunto1" name="assunto1">
            </div>

            <div class="form-group">
                <label for="assunto2">Assunto 2</label>
                <input class="form-control" type="text" id="assunto2" name="assunto2">
            </div>

            <div class="form-group">
                <label for="assunto3">Assunto 3</label>
                <input class="form-control" type="text" id="assunto3" name="assunto3">
            </div>

            <div class="form-group">
                <label for="assunto4">Assunto 4</label>
                <input class="form-control" type="text" id="assunto4" name="assunto4">
            </div>

            <div class="form-group">
                <label for="assunto5">Assunto 5</label>
                <input class="form-control" type="text" id="assunto5" name="assunto5">
            </div>
            
            <script type="text/javascript">

            function clickCheck() {
                if (document.getElementById('graduacao').checked) {
                    document.getElementById('graduacao_select').style.display = 'block';
                    document.getElementById('pos_select').style.display = 'none';
                    document.getElementById('versao').style.display = 'none';
                }
                else if(document.getElementById('mestrado').checked || document.getElementById('doutorado').checked){
                    document.getElementById('pos_select').style.display = 'block';
                    document.getElementById('graduacao_select').style.display = 'none';
                    document.getElementById('versao').style.display = 'block';
                }
                else{
                    document.getElementById('pos_select').style.display = 'none';
                    document.getElementById('graduacao_select').style.display = 'none';
                    document.getElementById('versao').style.display = 'none';
                }
            }

            </script>

            <div class="form-group">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="grau" id="graduacao" value="graduacao" onclick="javascript:clickCheck();">
                <label class="form-check-label" for="ilustracoes">
                    Trabalho de Conclusão de Curso (Graduação)
                </label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="grau" id="mestrado" value="mestrado" onclick="javascript:clickCheck();">
                <label class="form-check-label" for="ilustracoes">
                    Dissertação (Mestrado)
                </label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="grau" id="mestrado_prof" value="mestrado_prof" onclick="javascript:clickCheck();">
                <label class="form-check-label" for="ilustracoes">
                    Dissertação (Mestrado Profissional)
                </label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="grau" id="doutorado" value="doutorado" onclick="javascript:clickCheck();">
                <label class="form-check-label" for="ilustracoes">
                    Tese (Doutorado)
                </label>
                </div>
            </div>

            <div class="form-group" style="display:none" id="graduacao_select">
                <label for="departamento">Departamento de</label>
                <select class="form-control" id="departamento" name="departamento">
                    <option value="" selected=""> - Selecione  -</option>
                    <option value="MAC">
                        Ciência da Computação
                    </option>
                    <option value="MAE">
                        Estatística
                    </option>
                    <option value="MAE">
                        Matemática
                    </option>
                    <option value="MAP">
                        Matemática Aplicada
                    </option>
                </select>
            </div>

            <div class="form-group" style="display:none" id="pos_select">
                <label for="programa">Programa de Pós-Graduação em</label>
                <select class="form-control" id="programa" name="programa">
                    <option value="" selected=""> - Selecione  -</option>
                    <option value="POSBIO">
                    Programa Interunidades de Pós-graduação em Bioinformática
                    </option>
                    <option value="POSMAC">
                    Programa de Pós-Graduação em Ciência da Computação
                    </option>
                    <option value="POSMAE">
                    Programa de Pós-Graduação em Estatística
                    </option>
                    <option value="POSMAT">
                    Programa de Pós-graduação em Matemática
                    </option>
                    <option value="POSMAP">
                    Programa de Pós-graduação em Matemática Aplicada
                    </option>
                </select>
            </div>

            <div class="form-group" style="display:none" id="versao">
                <label>Indicar versão do trabalho</label>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="versao" id="original" value="original">
                <label class="form-check-label" for="original">
                    Versão original
                </label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="versao" id="corrigida" value="corrigida">
                <label class="form-check-label" for="corrigida">
                    Versão corrigida
                </label>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-dark">Enviar</button>
        </form>

    </div>
</div>


