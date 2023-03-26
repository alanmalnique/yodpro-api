<?php

namespace App\Http\Controllers\Problema;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Repository\ProblemaRepository;
use App\Http\Repository\ProblemaComentarioRepository;

use App\Http\Exports\ProblemaExport;
use App\Http\Exports\ProblemaDetalheExport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Auth\Guard;

class ProblemaController extends Controller
{

    private $repository;
    private $problemaComentarioRepository;
    private $guard;

    public function __construct(
        ProblemaRepository $repository,
        ProblemaComentarioRepository $problemaComentarioRepository
    ) {
        $this->repository = $repository;
        $this->problemaComentarioRepository = $problemaComentarioRepository;
        $this->guard = auth('usuario');
    }

    public function index(Request $request)
    {
        $result = $this->repository->list($request->all(), $request->input('per_page', 20));
        return response()->json($result);
    }

    public function show(Request $request, $id)
    {
        $result = $this->repository->query()
            ->with(['usuario', 'local','comentarios' => function($query) {
                $query->orderBy('probc_datahora', 'desc')
                    ->with(['usuario']);
            }])
            ->where('prob_id', '=', $id)
            ->first();
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
        $request->merge([
            'usu_id' => $this->guard->user()->usu_id,
            'prob_datahora' => date("Y-m-d H:i:s")
        ]);
        $result = $this->repository->create($request->only([
            'usu_id',
            'loc_id',
            'prob_titulo',
            'prob_descricao',
            'prob_status',
            'prob_datahora'
        ]));
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível realizar o cadastro do problema!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('prob_status') && $request->input('prob_status') === 2) {
            $request->merge(['prob_dthrfinalizado' => date("Y-m-d H:i:s")]);
        }
        $result = $this->repository->update($request->only([
            'loc_id',
            'prob_titulo',
            'prob_descricao',
            'prob_status',
            'prob_dthrfinalizado'
        ]), $id, 'prob_id');
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível alterar o cadastro do problema!'.print_r($request->all(), true)
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

    public function comentario(Request $request)
    {
        $request->merge([
            'usu_id' => $this->guard->user()->usu_id,
            'probc_datahora' => date("Y-m-d H:i:s"),
            'probc_ativo' => 1
        ]);
        $result = $this->problemaComentarioRepository->create($request->only([
            'prob_id',
            'usu_id',
            'probc_comentario',
            'probc_ativo',
            'probc_datahora'
        ]));
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível realizar o cadastro do comentário!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

    public function relatorio(Request $request)
    {
        return Excel::download(new ProblemaExport($this->repository, $request->all()), 'Relatório de problemas.xlsx');
    }

    public function relatorioDetalhe(Request $request, $id)
    {
        return Excel::download(new ProblemaDetalheExport($this->problemaComentarioRepository, $request->all()), 'Relatório do problema '.$id.'.xlsx');
    }

}
