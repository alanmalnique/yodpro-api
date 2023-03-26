<?php

namespace App\Http\Controllers\Locais;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Repository\LocaisRepository;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Auth\Guard;

class LocaisController extends Controller
{

    private $repository;
    private $guard;

    public function __construct(
        LocaisRepository $repository
    ) {
        $this->repository = $repository;
        $this->guard = auth('usuario');
    }

    public function index(Request $request)
    {
        $result = $this->repository->list($request->all(), $request->input('per_page', 20));
        return response()->json($result);
    }

    public function show(Request $request, $id)
    {
        $result = $this->repository->findBy('loc_id', $id);
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
            'loc_dthrcadastro' => date("Y-m-d H:i:s")
        ]);
        $result = $this->repository->create($request->only([
            'loc_descricao',
            'loc_endereco',
            'loc_latitude',
            'loc_longitude',
            'loc_ativo',
            'loc_dthrcadastro',
        ]));
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível realizar o cadastro do local!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

    public function update(Request $request, $id)
    {
        $result = $this->repository->update($request->only([
            'loc_descricao',
            'loc_endereco',
            'loc_latitude',
            'loc_longitude',
            'loc_ativo',
        ]), $id, 'loc_id');
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível alterar o cadastro do local!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

}
