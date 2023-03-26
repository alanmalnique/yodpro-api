<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Repository\InstitucionalRepository;
use App\Http\Service\Arquivo\ArquivoService;

class InstitucionalController extends Controller
{

    private $repository;
    private $arquivoService;

    public function __construct(
        InstitucionalRepository $repository,
        ArquivoService $arquivoService
    ) {
        $this->repository = $repository;
        $this->arquivoService = $arquivoService;
    }

    public function index(Request $request)
    {
        return response()->json($this->repository->list());
    }

    public function show(Request $request, $id)
    {
        $result = $this->repository->findBy('inst_id', $id);
        if (!$result) {
            return response()->json([
                'vazio' => true
            ], 400);
        }
        return response()->json([
            'vazio' => false,
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('arquivo')) {
            $arquivo = $this->arquivoService->uploadFiles($request->file('arquivo'), 'institucional.png', 'institucional');
            if (!$arquivo) {
                return response()->json([
                    'erro' => true,
                    'mensagem' => 'Não foi possível salvar a imagem'
                ], 400);
            }
            $request->merge(['arq_id' => $arquivo->arq_id]);
        }
        $result = $this->repository->create($request->only([
            'inst_titulo',
            'inst_texto',
            'inst_ativo',
            'inst_tipo',
            'arq_id',
        ]));
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível realizar o cadastro do institucional!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('arquivo')) {
            $arquivo = $this->arquivoService->uploadFiles($request->file('arquivo'), 'institucional.png', 'institucional');
            if (!$arquivo) {
                return response()->json([
                    'erro' => true,
                    'mensagem' => 'Não foi possível salvar a imagem'
                ], 400);
            }
            $request->merge(['arq_id' => $arquivo->arq_id]);
        }
        $result = $this->repository->update($request->only([
            'inst_titulo',
            'inst_texto',
            'inst_ativo',
            'inst_tipo',
            'arq_id',
        ]), $id, 'inst_id');
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível atualizar o cadastro do institucional!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }
}
