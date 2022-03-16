@extends('main')

@section('content')
<form action="/ficha" method="POST" target="_blank">
    @csrf

    <div class="container">
    <div>
        <p class="header-subtitle"><b>Biblioteca do IME-USP</b></p>
        <p class="header-title"><b>Elaboração de ficha catalográfica</b></p>
    </div>

    <p style="text-align: justify">A ficha catalográfica é um item obrigatório nos trabalhos acadêmicos. Contém um conjunto de elementos de descrição técnica do documento e deve ser impressa no verso da folha de rosto do trabalho. Após o preenchimento do formulário abaixo, a ficha será gerada automaticamente em formato PDF.
Este serviço destina-se exclusivamente aos alunos dos cursos de Graduação e Pós-Graduação do IME-USP.
Em caso de dúvida, entre em contato pelo telefone +55 11 3091-6490/6174 ou e-mail <a href="mailto:bib@ime.usp.br">bib@ime.usp.br</a>.</p>
    <p class="text-danger">* Obrigatório</p>

    <div class="forms-container">
        <p><b>DADOS DO SOLICITANTE</b><span class="text-danger p-3">&#42;</span></p>

        <div class="form-group">
            <label for="nusp"><b>Nº USP</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="nusp" name="nusp" required>
        </div>

        <div class="form-group">
            <label for="email"><b>Email para contato</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="email" name="email" required>
        </div>

        <script type="text/javascript">
        function confirmEmail() {
            var email = document.getElementById("email").value
            var confemail = document.getElementById("email-confirmation").value
            if(email != confemail) {
                alert('Os emails não são iguais!');
            }
        }
        </script>

        <div class="form-group">
            <label for="email-confirmation"><b>Confirmar email</b><span class="text-danger p-3">&#42;</span> </label>
            <input class="form-control" type="text" id="email-confirmation" name="email_confirmation" onblur="confirmEmail()" required>
        </div>

        <div class="form-group">
            <label for="pessoa_nome"><b>Prenome, primeiros sobrenomes, partículas de ligação</b><span class="text-danger p-3">&#42;</span> </label>
            <input class="form-control" type="text" id="pessoa_nome" name="pessoa_nome" required>
            <p style="color:gray">Ex.: José Antônio Costa de</p>
        </div>

        <div class="form-group">
            <label for="pessoa_ultimonome"><b> Último sobrenome e acréscimos de agnomes (Júnior, Filho, Segundo, Neto, Sobrinho, etc.)</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="pessoa_ultimonome" name="pessoa_ultimonome" required>
            <p style="color:gray">Ex.: Oliveira Filho</p>
        </div>
    </div>

    <div class="forms-container">
        <p><b>INFORMAÇÕES DO TRABALHO</b><span class="text-danger p-3">&#42;</span></p>

        <div class="form-group">
            <label for="titulo_trabalho"><b> Título do trabalho</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="titulo_trabalho" name="titulo_trabalho" required>
        </div>

        <div class="form-group">
            <label for="subtitulo_trabalho"><b>Subtítulo do trabalho</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="subtitulo_trabalho" name="subtitulo_trabalho" required>
        </div>

        <script type="text/javascript">

        function clickCheck() {
            if (document.getElementById('graduacao').checked) {
                document.getElementById('graduacao_select').style.display = 'block';
                document.getElementById('pos_select').style.display = 'none';
                document.getElementById('versao').style.display = 'none';

                document.getElementById('departamento').required = true;
                document.getElementById('area_concentracao').required = false;
                document.getElementsByName('versao_trabalho')[0].required = false;
                document.getElementsByName('versao_trabalho')[1].required = false;
            }
            else if(document.getElementById('mestrado').checked || document.getElementById('doutorado').checked){
                document.getElementById('pos_select').style.display = 'block';
                document.getElementById('graduacao_select').style.display = 'none';
                document.getElementById('versao').style.display = 'block';
                
                document.getElementById('departamento').required = false;
                document.getElementById('area_concentracao').required = true;
                document.getElementsByName('versao_trabalho')[0].required = true;
                document.getElementsByName('versao_trabalho')[1].required = true;
            }
            else{
                document.getElementById('pos_select').style.display = 'none';
                document.getElementById('graduacao_select').style.display = 'none';
                document.getElementById('versao').style.display = 'block';

                document.getElementById('departamento').required = false;
                document.getElementById('area_concentracao').required = false;
                document.getElementsByName('versao_trabalho')[0].required = true;
                document.getElementsByName('versao_trabalho')[1].required = true;
            }
        }

        </script>

        <p><b>Grau Acadêmico</b><span class="text-danger p-3">&#42;</span></p>

        <div class="form-group">
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="grau" id="graduacao" value="Trabalho de Conclusão de Curso (Graduação)" onclick="javascript:clickCheck();" required>
            <label class="form-check-label" for="graduacao">
                Trabalho de Conclusão de Curso (Graduação)
            </label>
            </div>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="grau" id="mestrado" value="Dissertação (Mestrado)" onclick="javascript:clickCheck();" required>
            <label class="form-check-label" for="mestrado">
                Dissertação (Mestrado)
            </label>
            </div>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="grau" id="mestrado_prof" value="Dissertação (Mestrado Profissional)" onclick="javascript:clickCheck();" required>
            <label class="form-check-label" for="mestrado_prof">
                Dissertação (Mestrado Profissional)
            </label>
            </div>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="grau" id="doutorado" value="Tese (Doutorado)" onclick="javascript:clickCheck();" required>
            <label class="form-check-label" for="doutorado">
                Tese (Doutorado)
            </label>
            </div>
        </div>

        <div class="form-group" style="display:none" id="graduacao_select">
            <label for="departamento"><b>Departamento de</b><span class="text-danger p-3">&#42;</span></label>
            <select class="form-control" id="departamento" name="departamento"> 
                <option value="" selected=""> - Selecione  -</option>
                <option value="Ciência da Computação">
                    Ciência da Computação
                </option>
                <option value="Estatística">
                    Estatística
                </option>
                <option value="Matemática">
                    Matemática
                </option>
                <option value="Matemática Aplicada">
                    Matemática Aplicada
                </option>
            </select>
        </div>

        <div class="form-group" style="display:none" id="pos_select">
            <label for="area_concentracao"><b> Programa de Pós-Graduação em</b><span class="text-danger p-3">&#42;</span></label>
            <select class="form-control" id="area_concentracao" name="area_concentracao">
                <option value="" selected=""> - Selecione  -</option>
                <option value="Programa Interunidades de Pós-Graduação em Bioinformática">
                Programa Interunidades de Pós-Graduação em Bioinformática
                </option>
                <option value="Programa de Pós-Graduação em Ciência da Computação">
                Programa de Pós-Graduação em Ciência da Computação
                </option>
                <option value="Programa de Pós-Graduação em Estatística">
                Programa de Pós-Graduação em Estatística
                </option>
                <option value="Programa de Pós-Graduação em Matemática">
                Programa de Pós-Graduação em Matemática
                </option>
                <option value="Programa de Pós-Graduação em Matemática Aplicada">
                Programa de Pós-Graduação em Matemática Aplicada
                </option>
            </select>
        </div>

        <div class="form-group" style="display:none" id="versao">
            <label><b>Indicar versão do trabalho</b><span class="text-danger p-3">&#42;</span></label>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="versao_trabalho" id="original" value="Versão original">
            <label class="form-check-label" for="original">
                Versão original
            </label>
            </div>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="versao_trabalho" id="corrigida" value="Versão corrigida">
            <label class="form-check-label" for="corrigida">
                Versão corrigida
            </label>
            </div>
        </div>

        <div class="form-group">
            <label for="orientador_nome"><b>Nome do orientador</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="orientador_nome" name="orientador_nome" required>
        </div>

        <div class="form-group">
            <label for="orientador_ultimonome"><b>Sobrenome do orientador</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="orientador_ultimonome" name="orientador_ultimonome" required>
        </div>

        <div class="form-check form-group">
            <input class="form-check-input" type="checkbox" value="" id="sou_orientadora" name="sou_orientadora">
            <label class="form-check-label" for="sou_orientadora">
                Orientadora?
            </label>
        </div>

        <div class="form-group">
            <label for="coorientador_nome"><b>Nome do coorientador</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="coorientador_nome" name="coorientador_nome" required>
        </div>

        <div class="form-group">
            <label for="coorientador_ultimonome"><b>Sobrenome do coorientador</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="coorientador_ultimonome" name="coorientador_ultimonome" required>
        </div>

        <div class="form-check form-group">
            <input class="form-check-input" type="checkbox" value="" id="sou_coorientadora" name="sou_coorientadora">
            <label class="form-check-label" for="sou_coorientadora">
                Coorientadora?
            </label>
        </div>

        <div class="form-group">
            <label for="ano"><b>Ano</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="ano" name="ano" required>
        </div>

        <div class="form-group">
            <label for="no_paginas"><b>Número de páginas</b><span class="text-danger p-3">&#42;</span></label>
            <input class="form-control" type="text" id="no_paginas" name="no_paginas" required>
        </div>
    
        <div class="form-group">
            <label class="control-label"><b>Contém ilustrações?</b><span class="text-danger p-3">&#42;</span></label>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ilustracoes" id="ilustracao_sim" value="Sim" required>
            <label class="form-check-label" for="ilustracao_sim">
                Sim
            </label>
            </div>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ilustracoes" id="ilustracao_nao" value="Não" required>
            <label class="form-check-label" for="ilustracao_nao">
                Não
            </label>
            </div>
        </div>
        
        <div class="forms-container">
            <div class="form-group">
                <label for="hidden"><b>ASSUNTOS (MÍN. 1, MAX. 5)</b><span class="text-danger p-3">&#42;</span></label>
                <input type="hidden" id="hidden">
                <p style="color:gray">Em caso de dúvida, veja a formatação no <a href="https://vocabusp.aguia.usp.br/Vocab/Sibix652.dll/Assuntos" target="_blank">Sibix</a>.</p>
            </div>

            <div class="form-group">
                <label for="assunto1"><b>Assunto 1</b><span class="text-danger p-3">&#42;</span></label>
                <input class="form-control" type="text" id="assunto1" name="assunto1" required>
            </div>

            <div class="form-group">
                <label for="assunto2"><b>Assunto 2</b></label>
                <input class="form-control" type="text" id="assunto2" name="assunto2">
            </div>

            <div class="form-group">
                <label for="assunto3"><b>Assunto 3</b></label>
                <input class="form-control" type="text" id="assunto3" name="assunto3">
            </div>

            <div class="form-group">
                <label for="assunto4"><b>Assunto 4</b></label>
                <input class="form-control" type="text" id="assunto4" name="assunto4">
            </div>

            <div class="form-group">
                <label for="assunto5"><b>Assunto 5</b></label>
                <input class="form-control" type="text" id="assunto5" name="assunto5">
            </div>
        </div>

        <button type="submit" class="btn btn-outline-dark" onClick="_blank">Enviar</button>
    
    </div>

    <p style="text-align: justify">Desenvolvido pela Seção Técnica de Informática - STI do Instituto de Ciências Matemáticas e de Computação - ICMC, utilizando o módulo <a href="https://github.com/fflch/webform_ficha_catalografica" target="_blank">Webform Ficha Catalográfica</a> desenvolvido pela Faculdade de Filosofia, Letras e Ciências Humanas - FFLCH e adaptado pela Seção de Apoio Institucional do Instituto de Matemática e Estatística - IME.</p>
    </div>
 
</form>
@endsection

