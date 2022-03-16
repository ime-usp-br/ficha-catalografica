<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{

    public function mostrarConfigs(){
        $this->authorize('admin');
        $config = Config::orderByDesc('created_at')->first();
        if(!$config) $config =  new Config;
        return view('config.configs', [
            'config' => $config
        ]);
    }

    public function edit()
    {
        $this->authorize('admin');
        $config = Config::orderByDesc('created_at')->first();
        if(!$config) $config =  new Config;
        return view('config.edit', [
            'config' => $config
        ]);
    }

    public function save(Request $request)
    {
        $this->authorize('admin');
        $config = [];
        $config['cabecalho'] = $request->cabecalho;
        $config['rodape'] = $request->rodape;

        //verifica se já existe uma configuração no banco para apenas atualizá-la,
        //e não criar uma a cada nova atualização
        $oldConfig = Config::orderByDesc('created_at')->first();
        if(!$oldConfig) Config::create($config);
        else{
            $config['num_fichas'] = $oldConfig->num_fichas;
            $oldConfig->update($config);
        }
        
        request()->session()->flash('alert-info', 'Configurações salvas com sucesso!');
        return redirect('/configs');
    }
}
