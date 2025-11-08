<?php

namespace App\Http\Controllers;

use App\Repositories\PerfilRepository;
use App\Repositories\UserDocumentsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Exception;
use JsonException;
use Throwable;

/**
 * Class PerfilController
 * @package App\Http\Controllers
 * @author Caroline Santos <15/12/2022 11:59>
 */
class PerfilController extends Controller
{
    /**
     * @var PerfilRepository
     */
    protected PerfilRepository $perfilRepository;
    /**
     * @var UserDocumentsRepository
     */
    protected UserDocumentsRepository $userDocumentsRepository;

    /**
     * PerfilController constructor.
     * @param PerfilRepository $perfilRepository
     * @param UserDocumentsRepository $userDocumentsRepository
     */
    public function __construct(PerfilRepository $perfilRepository, UserDocumentsRepository $userDocumentsRepository)
    {
        $this->middleware('auth');
        $this->perfilRepository = $perfilRepository;
        $this->userDocumentsRepository = $userDocumentsRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $dados = $this->perfilRepository->getDados(Auth::user()->id);
        $arquivos = $this->userDocumentsRepository->getDados(Auth::user()->id);

        return view('painel.perfil.index', [
                'dados' => (object)$dados,
                'arquivos' => $arquivos,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Application|JsonResponse|RedirectResponse|Redirector
     * @throws JsonException
     */
    public function update(Request $request)
    {
        $dados = $request->all();
        $retorno = $this->perfilRepository->gravar($dados, Auth::user()->id);
        $mensagem = json_decode($retorno->getContent(), false, 512, JSON_THROW_ON_ERROR)->message;

        $retorno->status() !== 200 ? notify()->error($mensagem, 'Erro') : notify()->success($mensagem, 'Sucesso');

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect('/perfil');

    }

    /**
     * @param Request $request
     */
    public function changePassword(Request $request)
    {
        try {
            $dados = $request->all();
            return $this->perfilRepository->changePassword($dados);

        } catch (Exception $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()], 422);
        }
    }


    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|RedirectResponse|Response|Redirector
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function upload(Request $request)
    {
        try {
            $arquivo = $request->file('file');

            throw_if(empty($arquivo), 'Necessário anexar a Logo');
            throw_if($arquivo->getError() === 1, $arquivo->getErrorMessage());

            $retorno = $this->perfilRepository->upload($arquivo, Auth::user()->id);
            $mensagem = json_decode($retorno->getContent(), false, 512, JSON_THROW_ON_ERROR)->message;

            notify()->success($mensagem, 'Sucesso');
        } catch (Exception $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage(), 'erros' => $exception->getMessage()], 422);
        }

        return redirect('/perfil');
    }
}
