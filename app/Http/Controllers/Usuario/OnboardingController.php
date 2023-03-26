<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Repository\UsuarioRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Auth\Guard;

class OnboardingController extends Controller
{

    private $repository;
    private $guard;

    public function __construct(
        UsuarioRepository $repository
    ) {
        $this->repository = $repository;
        $this->guard = auth('usuario');
    }

    public function login(Request $request)
    {
        $valida = $this->repository->findBy('usu_email', $request->input('email'));
        if ($valida) {
            if (Hash::check($request->input('senha'), $valida->usu_senha)) {
                $valida->token = JWTAuth::fromUser($valida);
                return response()->json([
                    'valido' => true,
                    'data' => $valida
                ]);
            }
        }
        return response()->json([
            'valido' => false
        ], 400);     
    }

    public function index(Request $request)
    {
        $result = $this->repository->list($request->all(), $request->input('per_page', 20));
        return response()->json($result);
    }

    public function show(Request $request, $id)
    {
        $result = $this->repository->findBy('usu_id', $id);
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
            'usu_senha' => bcrypt($request->input('usu_senha')),
            'usu_dthrcadastro' => date("Y-m-d H:i:s")
        ]);
        $result = $this->repository->create($request->only([
            'usu_nome',
            'usu_email',
            'usu_celular',
            'usu_senha',
            'usu_ativo',
            'usu_dthrcadastro'
        ]));
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível realizar o cadastro do usuário!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('usu_senha')) {
            $request->merge([
                'usu_senha' => bcrypt($request->input('usu_senha')),
            ]);
        }
        $result = $this->repository->update($request->only([
            'usu_nome',
            'usu_email',
            'usu_celular',
            'usu_senha',
            'usu_ativo',
            'usu_dthrcadastro'
        ]), $id, 'usu_id');
        if (!$result) {
            return response()->json([
                'erro' => true,
                'mensagem' => 'Não foi possível alterar o cadastro do usuário!'
            ], 400);
        }
        return response()->json([
            'erro' => false,
            'data' => $result
        ]);
    }

}
