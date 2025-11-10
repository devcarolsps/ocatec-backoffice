<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Repositories\FormulariosRepository;
use App\Repositories\HospedagensRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    protected FormulariosRepository $formulariosRepository;

    public function __construct(FormulariosRepository $formulariosRepository)
    {
        $this->middleware('auth');
        $this->formulariosRepository = $formulariosRepository;
    }

    public function view(): View
    {
        return view('painel.formularios.index');
    }

    public function list(): JsonResponse
    {
        $dados = $this->formulariosRepository->tabela();

        $resultado = array_map(function ($item) {
            $fields = json_decode($item->fields ?? '{}', true);

            // Cria um mapa nomeado pra evitar depender do número do ID
            $map = [];
            foreach ($fields as $field) {
                $map[$field['name']] = $field['value'] ?? null;
            }

            return [
                'nome'     => $map['NomCompleto'] ?? '',     // Nome do campo no WPForms
                'telefone' => $map['Telefone'] ?? '',
                'email'    => $map['E-mail'] ?? '',
                'categoria'=> $map['ESCOLHA SUA CATEGORIA:'] ?? '',
                'endereco' => $map['Endereço'] ?? '',
                'metragem' => $map['Metragem Quadrada'] ?? '',
                'observacoes' => $map['Observações'] ?? '',
                'oca_id'   => $item->terreno_id ?? '',
                'data'     => $item->date ?? '',
            ];
        }, $dados);

        return response()->json($resultado);
    }

    public function acao(Request $request, HospedagensRepository $hospedagensRepository)
    {
        $ocaId = $request->input('oca_id');
        $acao = $request->input('acao');

        try {
            if ($acao === 'aprovar') {
                // grava uma nova hospedagem na base Ocatec
                $dados = [
                    'codigo' => $ocaId,
                    'status' => StatusEnum::DESENVOLVIMENTO_ID,
                ];

                $hospedagensRepository->gravar($dados);
            }

            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
