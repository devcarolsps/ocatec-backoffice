<?php


namespace App\Http\Controllers;

use App\Repositories\UserDocumentsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Exception;
use Throwable;


/**
 * Class UserDocumentsController
 * @package App\Http\Controllers
 * @author Caroline Santos <24/12/2022 14:33>
 */
class UserDocumentsController extends Controller
{
    /**
     * @var UserDocumentsRepository
     */
    protected UserDocumentsRepository $userDocumentsRepository;

    /**
     * UserDocumentsController constructor.
     * @param UserDocumentsRepository $userDocumentsRepository
     */
    public function __construct(UserDocumentsRepository $userDocumentsRepository)
    {
        $this->middleware('auth');
        $this->userDocumentsRepository = $userDocumentsRepository;
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response|Redirector
     * @throws Throwable
     */
    public function upload(Request $request)
    {
        try {
            $dados = $request->all();
            $arquivo = $request->file('file');

            throw_if(empty($arquivo), 'Necessário anexar o arquivo');
            throw_if($arquivo->getError(), 'Erro ao anexar o arquivo, tente novamente');

            $retorno =  $this->userDocumentsRepository->upload($dados, $arquivo, Auth::user()->id);
            $mensagem = json_decode($retorno->getContent(), false, 512, JSON_THROW_ON_ERROR)->message;

            notify()->success($mensagem, 'Sucesso');

        } catch (Exception $exception) {
            notify()->error($exception->getMessage(), 'Erro');
        }

        return redirect('/perfil');

    }

    /**
     * @param $id
     * @return bool|Application|ResponseFactory|RedirectResponse|Response|Redirector
     * @throws BindingResolutionException
     */
    public function delete(?string $id)
    {
        try {
            $retorno = $this->userDocumentsRepository->delete($id);
            $retorno ? notify()->success('Arquivo deletado com sucesso', 'Sucesso') : notify()->error('Erro ao deletar arquivo', 'Erro');

        } catch (Exception $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()], 422);
        }

        return redirect('/perfil');
    }
}
