<?php

namespace App\Http\Controllers\Geral;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Repository\ArquivoRepository;

use File;
use Response;

class ArquivoController extends Controller
{

    private $repository;

    public function __construct(
        ArquivoRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function show(Request $request, $id)
    {
        $arquivo = $this->repository->find($id, "arq_id");

        if (!$arquivo) {
            return response([
                "erro" => true, 
                "mensagem" => "Arquivo não encontrado"
            ], 400);
        }

        $arquivo->filepath = storage_path('app') . "/public/" . $arquivo->arq_pasta . "/" .str_replace("-", "/", $arquivo->arq_data). "/" . $arquivo->arq_id . "." . $arquivo->arq_extensao;

        if (!File::exists($arquivo->filepath)) {
            abort(404);
        }

        $file = File::get($arquivo->filepath);
        $type = File::mimeType($arquivo->filepath);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


}
