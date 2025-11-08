<?php

namespace App\Repositories;

use App\Models\UserDocuments;

/**
 * Class UserDocumentsRepository
 * @package App\Repositories
 * @author Caroline Santos <24/12/2022 14:28>
 */
class UserDocumentsRepository
{
    /**
     * @param $id
     * @return Builder[]|Collection
     */
    public function getDados($id)
    {
        return UserDocuments::query()
            ->where('user_id', $id)
            ->get();
    }


    /**
     * @param $dados
     * @param $arquivo
     * @param $user_id
     * @return false|Application|ResponseFactory|Response
     * @throws BindingResolutionException
     */
    public function upload($dados, $arquivo, $user_id)
    {
        $ext = $arquivo->getClientOriginalExtension();
        $name = uniqid(date('HisYmd'), false);
        $nameFile = "{$name}.{$ext}";

        $upload = $arquivo->storeAs('documentos', $nameFile);
        if (!$upload) {
            return false;
        }

        $documentos = array(
            'user_id' => $user_id,
            'filename' => $nameFile,
            'extension' => $ext,
            'size' => $arquivo->getSize(),
            'tipo' => $dados['tipo'],
        );

        return $this->gravar($documentos);
    }

    /**
     * @param $dados
     * @return Application|ResponseFactory|Response
     * @throws BindingResolutionException
     */
    public function gravar($dados)
    {
        if (empty($dados)) {
            return response(['message' => 'Sem dados para gravar'], 422);
        }

        $userDocuments = new UserDocuments();
        $userDocuments->fill($dados);


        if (!$userDocuments->save()) {
            return response(['status' => 'error', 'message' => 'Erro ao gravar os dados', 'erros' => $userDocuments->getErrors()->all()], 422);
        }

        return response(['status' => 'success', 'message' => 'Dados gravado com sucesso', 'dados' => $userDocuments->toArray()], 200);
    }


    /**
     * @param $id
     * @return bool
     */
    public function delete(?string $id): bool
    {
        $arquivo = UserDocuments::find($id);
        if(!empty($arquivo)){
            $filename = storage_path('app/public/documentos/'.$arquivo->filename);

            if(!empty($filename)){
                $retorno = deleteArquivoStorageTmp($filename);
                if($retorno){
                    $arquivo->delete();
                    return true;
                }
            }
        }
        return false;
    }
}
