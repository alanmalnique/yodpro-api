<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Interfaces\MensageriaInterface;
use App\Http\Service\Mensageria\MensageriaService;
use App\Http\Service\Mensageria\Adapter\EmailAdapter;

class ContatoController extends Controller
{
    private $mensageriaService;

    public function __construct(){
        $this->mensageriaService = new MensageriaService(new EmailAdapter);
    }

    public function faleconosco(Request $request)
    {
        $data = array(
            "template" => "fale_conosco",
            "para" => \Config::get('contato.email_para'),
            "dados" => array(
                "nome" => $request->input('nome'),
                "condominio" => $request->input('condominio'),
                "whatsapp" => $request->input('whatsapp'),
                "mensagem" => $request->input('mensagem')
            )
        );
        $send = $this->mensageriaService->send($data);
        return response()->json([
            "erro" => false
        ]);
    }
}
