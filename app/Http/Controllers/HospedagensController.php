<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Repositories\HospedagensArquivosRepository;
use App\Repositories\HospedagensRepository;
use App\Repositories\StatusRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Exception;

/**
 * Class HospedagensController
 * @package App\Http\Controllers
 * @author Caroline Santos <15/12/2022 11:59>
 */
class HospedagensController extends Controller
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
     * @var HospedagensArquivosRepository
     */
    private HospedagensArquivosRepository $hospedagensArquivosRepository;

    /**
     * HospedagensController constructor.
     * @param HospedagensRepository $hospedagensRepository
     * @param StatusRepository $statusRepository
     * @param HospedagensArquivosRepository $hospedagensArquivosRepository
     */
    public function __construct(HospedagensRepository $hospedagensRepository, StatusRepository $statusRepository, HospedagensArquivosRepository $hospedagensArquivosRepository)
    {
        $this->middleware('auth');
        $this->hospedagensRepository = $hospedagensRepository;
        $this->hospedagensArquivosRepository = $hospedagensArquivosRepository;
        $this->statusRepository = $statusRepository;
    }


    /**
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('painel.empreendimentos.hospedagens.index');
    }

    /**
     * @return Application|Factory|View
     * @throws Throwable
     */
    public function upload(Request $request)
    {
        try {
            $hospedagem_id = $request->get('hospedagem_id');

            throw_if(empty($hospedagem_id), 'Hospedagem ID não encontado');

            throw_if($this->show($hospedagem_id) === null, 'Hospedagem não encontado');

            $arquivos = $request->file('file');
            $hospedagem_id = $request->get('hospedagem_id');

            foreach ($arquivos as $arquivo){
                $this->hospedagensArquivosRepository->upload($arquivo, Auth::user()->id, $hospedagem_id);
            }

            notify()->success('Dados gravado com sucesso', 'Sucesso');
        } catch (Exception $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage(), 'erros' => $exception->getMessage()], 422);
        }
    }

    /**
     * @return array
     */
    public function tabela(): array
    {
        $tabelaData = $this->hospedagensRepository->tabela();

        $resultArray = [];
        foreach ($tabelaData as $key => $data) {
            $resultArray[$key]['informacoes'] = $this->renderizaInformacoes($data);
            $resultArray[$key]['caracteristicas'] = $this->renderizaCaracteristicas($data);
        }

        return $resultArray;
    }


    /**
     * @param Request $request
     * @throws BindingResolutionException
     */
    public function store(Request $request)
    {
        $payload = $request->all();

        try {
            $data = $this->hospedagensRepository->gravar($payload);

            if ($data === false) {
                return response(['error' => true, 'message' => 'Erro ao salvar os dados, atualize a página e tente novamente.'], 422);
            }

            return response(['dados' => $data, 'status' => 'success', 'message' => 'Dados gravados com sucesso.']);

        } catch (Exception|Throwable $e) {
            return response(['error' => true, 'message' => $e->getMessage()], 422);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @throws BindingResolutionException
     */
    public function update(Request $request, $id = null)
    {
        $payload = $request->all();

        try {
            $salvar = $this->hospedagensRepository->gravar($payload, $id);

            if ($salvar === false) {
                return response(['error' => true, 'message' => 'Erro ao salvar os dados, atualize a página e tente novamente.'], 422);
            }

            return response(['status' => 'success', 'message' => 'Dados gravados com sucesso.']);

        } catch (Exception|Throwable $e) {
            return response(['error' => true, 'message' => $e->getMessage()], 422);
        }

    }

    public function show($id)
    {
        try {
            $hospedagem = $this->hospedagensRepository->show($id);

            if (!$hospedagem) {
                return $this->responseErrorJson("Hospedagem não encontrado", 200);
            }

            $hospedagem['status_id'] = $hospedagem['status'];
            $hospedagem['status'] = $this->statusRepository->statusNameBadge($hospedagem['status']);
            $hospedagem['dias_cadastro'] = calculaData($hospedagem['created_at'], date('Y-m-d H:i:s'));
            $hospedagem['preco_max'] = number_format($hospedagem['preco_max'], 2, ",", ".");
            $hospedagem['comissao_total'] = number_format($hospedagem['comissao_total'], 2, ",", ".");
            $imageData = $this->hospedagensArquivosRepository->getArquivosByHospedagemId($id, 1);
            $hospedagem['imagem'] = !empty($imageData[0]['filename']) ? asset('storage/hospedagens_arquivos/'.$imageData[0]['filename']) : asset('img/logos/sua-foto.png');

        } catch (\Exception $exception) {
            return $this->responseExceptionJson($exception);
        }

        return $this->responseSuccessJson($hospedagem);
    }


    /**
     * @param $data
     * @return string
     */
    public function renderizaInformacoes($data): string
    {
        $imageData = $this->hospedagensArquivosRepository->getArquivosByHospedagemId($data['id'], 1);
        $imagens = !empty($imageData[0]['filename']) ? asset('storage/hospedagens_arquivos/'.$imageData[0]['filename']) : asset('img/logos/sua-foto.png');

        $html = '
            <div class="col-lg-9">
                <div class="card">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-3">
                            <img src="'. $imagens .'" class="card-img" alt="">
                        </div>
                        <div class="col-md-9">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <small class="float-end text-muted font-16"><i class="mdi mdi-cards-heart-outline text-muted"></i></small>
                                    <span class="font-16">' . $this->statusRepository->statusNameBadge($data['status']) . '</span>
        
                                    <h5 class="mt-2 mb-2">
                                        <a href="#"  data-id="'.$data['id'].'" data-name="'.$data['nome_empreendimento'].'" class="text-body btnEdit">' . $data['nome_empreendimento'] . '</a>
                                        <p href="#"   class="text-body">ID: '.$data['codigo'] .'</p>
                                    </h5>
        
                                    <p class="mb-0">
                                        <button type="button" class="btn btn-outline-warning btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-star text-muted"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-fire text-muted"></i></button>
                                        <button type="button" class="btn btn-outline-info btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-file-word text-muted"></i></button> 
                                    </p>
        
                                    <p class="mb-0"> 
                                        <span class="align-middle">R$ ' . number_format($data['comissao_total'], 2, ",", ".") . '</span>
                                    </p>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div>';

        return $html;
    }

    public function renderizaCaracteristicas($data): string
    {
        $showDocument = $data['status'] !== StatusEnum::ANALISE_ID ? 'btn-info' : 'btn-secondary';


        $html = '
            <div class="col-lg-12">
                <div class="card">
                    <div class="row g-0 align-items-center"> 
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-body">         
                                    <h5 class="mt-2 mb-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Localização: São Paulo</a>
                                    </h5>       
                                    <h5 class="mt-2 mb-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Potencial para o mercado: 26%</a>
                                    </h5>       
                                    <h5 class="mt-2 mb-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Tempo na plataforma: 41 dias</a>
                                    </h5> 
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-12">
                            <div class="d-grid"> 
                                <button type="button" class="btn ' . $showDocument . ' ">ACESSO AO ESTUDO COMPLETO</button> 
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>';

        return $html;
    }

}
