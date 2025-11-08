<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class PerfilRepository
 * @package App\Repositories
 * @author Caroline Santos <26/03/2023 16:27>
 */
class PerfilRepository
{
    /**
     * @var string
     */
    private string $path;

    /**
     * PerfilRepository constructor.
     */
    public function __construct()
    {
        $this->path = 'app/public/logos/';
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getDados($user_id)
    {
        return User::findOrFail($user_id);
    }


    /**
     * @param $dados
     * @param $user_id
     * @return Application|ResponseFactory|Response
     * @throws BindingResolutionException
     */
    public function gravar($dados, $user_id)
    {
        if (empty($dados)) {
            return response(['message' => 'Sem dados para gravar'], 422);
        }

        $user = User::findOrFail($user_id);
        $user->fill($dados);
        if (isset($user['cep']) && !empty($user['cep'])) {
            $user['cep'] = onlyNumbers($user['cep']);
        }if (isset($user['cep_comercial']) && !empty($user['cep_comercial'])) {
            $user['cep_comercial'] = onlyNumbers($user['cep_comercial']);
        }

        if (!$user->save()) {
            return response(['status' => 'error', 'message' => 'Erro ao gravar os dados', 'erros' => $user->getErrors()->all()], 422);
        }

        return response(['status' => 'success', 'message' => 'Dados gravado com sucesso', 'dados' => $user->toArray()], 200);
    }

    /**
     * @param $dados
     * @return Application|ResponseFactory|Response
     * @throws BindingResolutionException
     */
    public function changePassword($dados)
    {
        if (!(Hash::check($dados['current-password'], Auth::user()->password))) {
            return response(['status' => 'error', 'message' => 'Sua senha atual não corresponde à senha.'], 422);
        }

        if (strcmp($dados['current-password'], $dados['new-password']) === 0) {
            return response(['status' => 'error', 'message' => 'A nova senha não pode ser igual à sua senha atual.'], 422);
        }


        if (empty($dados['new-password']) || empty($dados['current-password'])) {
            return response(['status' => 'error', 'message' => 'Todos os campos obrigatórios.'], 422);
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($dados['new-password']);
        $user->save();

        return response(['status' => 'success', 'message' => 'Senha alterada com sucesso'], 200);
    }

    /**
     * @param $arquivo
     * @param $user_id
     * @return false|Application|ResponseFactory|Response
     * @throws BindingResolutionException
     */
    public function upload($arquivo, $user_id)
    {
        //VERIFICA SE EXISTE A LOGO, EXCLUI E ANEXA DENOVO
        $dados = $this->getDados($user_id);
        if (!empty($dados->logo)) {
            $this->deleteLogo($user_id, $dados->logo);
        }


        $ext = $arquivo->getClientOriginalExtension();
        $name = uniqid(date('HisYmd'), false);
        $nameFile = "{$name}.{$ext}";

        $upload = $arquivo->storeAs('logos', $nameFile);
        if (!$upload) {
            return false;
        }
        return $this->gravar(array('logo' => $nameFile), $user_id);
    }

    /**
     * @param $user_id
     * @param $file
     * @return bool
     * @throws BindingResolutionException
     */
    public function deleteLogo($user_id, $file): bool
    {
        if (!empty($file)) {
            $filename = storage_path($this->path . $file);

            if (!empty($filename)) {
                $retorno = deleteArquivoStorageTmp($filename);
                if ($retorno) {
                    $this->gravar(array('logo' => ''), $user_id);
                    return true;
                }
            }
        }
        return false;
    }

}
