<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{

    public function edit()
    {
        $config = Config::orderByDesc('created_at')->first();
        if(!$config) $config =  new Config;
        return view('config.config', [
            'config' => $config
        ]);
    }

    public function save(Request $request)
    {
        $config = [];
        $config['cabecalho'] = $request->cabecalho;
        $config['rodape'] = $request->rodape;
        Config::create($config);
        request()->session()->flash('alert-info', 'Configurações salvas com sucesso!');
        return back();
    }
}
