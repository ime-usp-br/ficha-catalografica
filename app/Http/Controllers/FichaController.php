<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cezpdf;
use Dompdf\Dompdf;


class FichaController extends Controller
{
    public function montarFicha(Request $request){
        $orientadora = $request['sou_orientadora'] ? 'a' : ''; //se for do gênero feminino

        $coorientadora = $request['sou_coorientadora'] ? 'a' : ''; //se for do gênero feminino

		$codigo1 = substr($request['pessoa_ultimonome'],0,1);
		// separa o título por espaços em branco e verifica a primeira palavra
		// se a primeira palavra for uma stopword, o $codigo2 será a primeira letra da segunda palavra do título
		
		$vetitulo = explode (" ",$request['titulo_trabalho']);
		
		$stopwords = array ("o", "a", "os", "as", "um", "uns", "uma", "umas", "de", "do", "da", "dos", "das", "no", "na", "nos", "nas", "ao", "aos", "à", "às", "pelo", "pela", "pelos", "pelas", "duma", "dumas", "dum", "duns", "num", "numa", "nuns", "numas", "com", "por", "em");
	
		if (in_array (strtolower($vetitulo[0]), $stopwords))
			$codigo2 = strtolower(substr($vetitulo[1],0,1));
		else
            $codigo2 = strtolower(substr($vetitulo[0],0,1));

        // Se tem Subtítulo 
        if ($request['subtitulo_trabalho'] != '')
            $titulo_subtitulo = $request['titulo_trabalho'] . ': ' . $request['subtitulo_trabalho'];
        else
            $titulo_subtitulo = $request['titulo_trabalho'];
	
		// monta o Código Cutter
        // $codigo = $codigo1.$request['cod_cutter'].$codigo2;
        //$codigo = $request['cod_cutter'];
		$aux_orientador = "; orientador$orientadora, ".$request['orientador_nome']." ".$request['orientador_ultimonome'];
        $aux_coorientador = "; coorientador$coorientadora, ".$request['coorientador_nome']." ".$request['coorientador_ultimonome'];
        $orientador_texto = isset($request['orientador_nome']) && strlen($request['orientador_nome']) > 0 && isset($request['orientador_ultimonome']) && strlen($request['orientador_ultimonome']) > 0  ? $aux_orientador : "";
        $coorientador_texto = isset($request['coorientador_nome']) && strlen($request['coorientador_nome']) > 0 && isset($request['coorientador_ultimonome']) && strlen($request['coorientador_ultimonome']) > 0  ? $aux_coorientador : "";
        // monta informações da ficha catalográfica
        
        // Ilustrações e Complemento 
        if ($request['ilustracoes'] == 'Sim') 
            $ilustracoes = ': il.';
        else
            $ilustracoes = '';

        // if ($request['complemento'] != '')
        //     $complemento = " + ".$request['complemento'].".";
        // else
        //     $complemento = '';
        
        $request['cidade'] = "São Paulo";
        $request['ano'] = "2022";
		$texto = $request['pessoa_ultimonome'].", ".$request['pessoa_nome']."\n   ".$titulo_subtitulo." / ".$request['pessoa_nome']." ".$request['pessoa_ultimonome'].$orientador_texto.$coorientador_texto.". - ".$request['cidade'].", ".$request['ano'].".\n   ".$request['no_paginas']." p.".$ilustracoes."\n\n\n   ".$request['grau']; 
		

		$departamento_texto = isset($request['departamento']) && strlen($request['departamento']) > 0 ? "".$request['departamento'] : " ";  
		$area_texto = isset($request['area_concentracao']) && strlen($request['area_concentracao']) > 0 ? "".$request['area_concentracao'] : "";  
        $texto .= " - ";

        // if ($departamento_texto == 'Departamento de . ');
        //     $departamento_texto = '';

        // if ($area_texto == 'Programa de Pós-Graduação em ')
        //     $area_texto = '';
        
        $texto .= $departamento_texto.$area_texto."/ "."Instituto de Matemática e Estatística / Universidade de São Paulo"."."."\n  Bibliografia\n"."  ".$request['versao_trabalho']."\n\n\n   1. ".$request['assunto1'].". "; 

		if (!empty ($request['assunto2'])) 
			$texto .= "2. ".$request['assunto2'].". "; 
	
		if (!empty ($request['assunto3'])) 
			$texto .= "3. ".$request['assunto3'].". "; 
	
		if (!empty ($request['assunto4'])) 
			$texto .= "4. ".$request['assunto4'].". "; 
	
		if (!empty ($request['assunto5'])) 
			$texto .= "5. ".$request['assunto5'].". ";
		
		if (isset($request['orientador_nome']) && strlen($request['orientador_nome']) > 0 && isset($request['orientador_ultimonome']) && strlen($request['orientador_ultimonome']) > 0)
			$texto .= "I. ".$request['orientador_ultimonome'].", ".$request['orientador_nome'].". II. Título."; 
	
        //$texto .= "\n\n                                         CDD 21.ed. - ".$codigo;

        $cabecalho = "Autorizo a reprodução e divulgação total ou parcial deste trabalho, por qualquer meio convencional ou eletrônico, para fins de estudo e pesquisa, desde que citada a fonte.\n\n\n
        Ficha catalográfica elaborada com dados inseridos pelo(a) autor(a)\n
        Biblioteca Carlos Benjamin de Lyra\n
        Instituto de Matemática e Estatística\n
        Universidade de São Paulo\n
        ";
        $ficha = array(array('cod' => '', 'ficha' => $texto));
            
        //Gera a ficha em pdf
        $pdf = new Cezpdf('a4','portrait','color',[255,255,255]);

        $pdf->selectFont('Times-Roman');
        
        $pdf->ezText (str_replace('\n', PHP_EOL, $cabecalho) . "\n", 10, array('justification' => 'center'));

        //$pdf->ezText (str_replace('\n', PHP_EOL,$request['descricao_ficha']) . "\n\n", 10, array('justification' => 'center'));
        
        $pdf->selectFont('Courier');

        $pdf->ezText ("________________________________________________________________________________\n", 10, array('justification' => 'center')); 

        $pdf->ezTable ($ficha,'','', array ('fontSize' => 9,'showHeadings'=>0, 'showLines'=>0, 'width'=>345, 'cols' =>array('cod'=>array('width'=>0))));

        $pdf->ezText ("________________________________________________________________________________\n", 10, array('justification' => 'center')); 

        $pdf->selectFont('Courier'); 
        
        $pdf->ezText ('Bibliotecárias do Serviço de Informação e Biblioteca Carlos Benjamin de Lyra do IME-USP, responsáveis pela estrutura de catalogação da publicação de acordo com a AACR2: Maria Lúcia Ribeiro CRB-8/2766; Stela do Nascimento Madruga CRB 8/7534.', 9, array('justification' => 'center'));

        
        return response($pdf->ezStream(), 200)
                  ->header('Content-Type', 'application/pdf'); 

        // return view('sucesso', [
        //     'texto' => $texto
        // ]);
    }

    // public function visualizarPdf($texto){
    //     $cabecalho = "Autorizo a reprodução e divulgação total ou parcial deste trabalho, por qualquer meio convencional ou eletrônico, para fins de estudo e pesquisa, desde que citada a fonte.\n\n\n
    //     Ficha catalográfica elaborada com dados inseridos pelo(a) autor(a)\n
    //     Biblioteca Carlos Benjamin de Lyra\n
    //     Instituto de Matemática e Estatística\n
    //     Universidade de São Paulo\n
    //     ";
    //     $ficha = array(array('cod' => '', 'ficha' => $texto));
            
    //     //Gera a ficha em pdf
    //     $pdf = new Cezpdf('a4','portrait','color',[255,255,255]);

    //     $pdf->selectFont('Times-Roman');
        
    //     $pdf->ezText (str_replace('\n', PHP_EOL, $cabecalho) . "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", 10, array('justification' => 'center'));

    //     //$pdf->ezText (str_replace('\n', PHP_EOL,$request['descricao_ficha']) . "\n\n", 10, array('justification' => 'center'));
        
    //     $pdf->selectFont('Courier');

    //     $pdf->ezText ("________________________________________________________________________________\n", 10, array('justification' => 'center')); 

    //     $pdf->ezTable ($ficha,'','', array ('fontSize' => 9,'showHeadings'=>0, 'showLines'=>0, 'width'=>345, 'cols' =>array('cod'=>array('width'=>0))));

    //     $pdf->ezText ("________________________________________________________________________________\n", 10, array('justification' => 'center')); 

    //     $pdf->selectFont('Courier'); 
        
    //     $pdf->ezText ('Bibliotecárias do Serviço de Informação e Biblioteca Carlos Benjamin de Lyra do IME-USP, responsáveis pela estrutura de catalogação da publicação de acordo com a AACR2: Maria Lúcia Ribeiro CRB-8/2766; Stela do Nascimento Madruga CRB 8/7534.', 9, array('justification' => 'center'));

        
    //     return response($pdf->ezStream(), 200)
    //               ->header('Content-Type', 'application/pdf'); 
    // }
}
