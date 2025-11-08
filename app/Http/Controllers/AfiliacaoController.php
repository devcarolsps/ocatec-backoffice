<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Repositories\AfiliacaoRepository;
use App\Repositories\HospedagensArquivosRepository;
use App\Repositories\HospedagensRepository;
use App\Repositories\StatusRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class AfiliacaoController
 * @package App\Http\Controllers
 * @author Caroline Santos <24/03/2023 15:18>
 */
class AfiliacaoController extends Controller
{
    /**
     * @var HospedagensRepository
     */
    protected HospedagensRepository $hospedagensRepository;
    /**
     * @var StatusRepository
     */
    protected StatusRepository $statusRepository;
    /**
     * @var AfiliacaoRepository
     */
    protected AfiliacaoRepository $afiliacaoRepository;
    /**
     * @var HospedagensArquivosRepository
     */
    private HospedagensArquivosRepository $hospedagensArquivosRepository;

    /**
     * HospedagensController constructor.
     * @param HospedagensRepository $hospedagensRepository
     * @param StatusRepository $statusRepository
     * @param AfiliacaoRepository $afiliacaoRepository
     * @param HospedagensArquivosRepository $hospedagensArquivosRepository
     */
    public function __construct(HospedagensRepository $hospedagensRepository, StatusRepository $statusRepository, AfiliacaoRepository $afiliacaoRepository, HospedagensArquivosRepository $hospedagensArquivosRepository)
    {
        $this->middleware('auth');
        $this->hospedagensRepository = $hospedagensRepository;
        $this->statusRepository = $statusRepository;
        $this->afiliacaoRepository = $afiliacaoRepository;
        $this->hospedagensArquivosRepository = $hospedagensArquivosRepository;
    }


    /**
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('painel.mercado.afiliacoes.index');
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function store(Request $request)
    {
        $postData = $request->all();
        if (empty($postData['hospedagem_id']) || empty(Auth::user()->id)) {
            return $this->responseErrorJson('Sem dados para gravar', 422);
        }

        if ($this->validaAfiliacao($postData['hospedagem_id'], Auth::user()->id)) {
            return $this->responseErrorJson('Você já afiliou-se a esse empreendimento', 422);
        }

        $hospedagem_id = $postData['hospedagem_id'];
        return $this->afiliacaoRepository->store($hospedagem_id, Auth::user()->id);
    }

    /**
     * @param null $type
     * @return string
     */
    public function tabela($type = null): string
    {
        $tabelaData = $this->hospedagensRepository->hospedagens(StatusEnum::PROPOSTA_ID, $type);

        $html = '';
        foreach ($tabelaData as $key => $data) {
            $html .= $this->renderizaInformacoes($data);
        }

        return $html;
    }

    /**
     * @return Application|Factory|View
     */
    public function viewMinhasAfiliacoes()
    {
        return view('painel.empreendimentos.afiliacoes.index');
    }

    /**
     * @param null $status
     * @return array
     */
    public function tabelaMinhasAfiliacoes($status = null): array
    {
        $resultDados = $this->afiliacaoRepository->afiliacoesByUser($status, Auth::user()->id);

        $resultado = [];
        foreach ($resultDados as $key => $data) {
            $resultado[$key]['id'] = $data['id'];
            $resultado[$key]['nome_empreendimento'] = $data['nome_empreendimento'];
            $resultado[$key]['preco_max'] = 'R$ ' . number_format($data['preco_max'], 2, ",", ".");
            $resultado[$key]['status'] = $this->statusRepository->statusNameBadge($data['status']);
            $resultado[$key]['link'] = '';
            $resultado[$key]['foto'] = '<img src="https://coderthemes.com/hyper/saas/assets/images/users/avatar-6.jpg" alt="table-user" class="me-2">';
            $resultado[$key]['acao'] = '<a class="action-icon btnView" title="Detalhes" style="cursor:pointer"><i style="color:blue !important" class="mdi mdi-24px mdi-eye"></i></a>
                                        <a class="action-icon btnCancelarAfiliacao" id="'.$data['id'].'" title="Cancelar Afiliação" style="cursor:pointer"> <i style="color:red !important" class="mdi mdi-24px mdi-close"></i></a>';
        }

        return $resultado;
    }

    /**
     * @param $data
     * @return string
     */
    public function renderizaInformacoes($data): string
    {

        $imageData = $this->hospedagensArquivosRepository->getArquivosByHospedagemId($data['id'], 1);
        $imagens = !empty($imageData[0]['filename']) ? asset('storage/hospedagens_arquivos/'.$imageData[0]['filename']) : asset('img/logos/sua-foto.png');

        return '<div class="col-sm-3 col-lg-3 btnView" style="cursor:pointer;" data-id="' . $data['id'] . '">
                    <div class="card d-block">
                        <img class="card-img-top rounded me-1 img-fluid mb-3" src="'. $imagens .'" alt="Imagem das Hospedagens" style="height: 13rem">
                        <div class="card-body">
                            <h5 class="card-title">
                                <p class="mb-0">
                                    <button type="button" class="btn btn-outline-warning btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-star text-muted"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-fire text-muted"></i></button>
                                    <button type="button" class="btn btn-outline-info btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-file-word text-muted"></i></button> 
                                </p>
                            </h5>
                            <p class="card-text">' . $data['nome_empreendimento'] . '</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Comissão de até:                                         
                                <p class="mb-0"> <span class="font-20 text-success stretched-link fw-bold">R$ ' . number_format($data['comissao_total'], 2, ",", ".") . '</span></p>
                            </li>
                        </ul>
                    </div> 
                </div>';
    }

    public function validaAfiliacao($hospedagem_id, $user_id): bool
    {
        $verifica = $this->afiliacaoRepository->check($hospedagem_id, $user_id);
        if (!empty($verifica['id'])) {
            $existe = true;
        }

        return $existe ?? false;
    }

}
