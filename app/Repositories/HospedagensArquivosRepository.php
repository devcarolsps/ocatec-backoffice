<?php

namespace App\Repositories;

use App\Models\HospedagensArquivos;


/**
 * Class HospedagensArquivosRepository
 * @package App\Repositories
 * @author Caroline Santos <26/03/2023 16:51>
 */
class HospedagensArquivosRepository
{
    /**
     * @param $hospedagem_id
     * @param int $limit
     * @return array
     */
    public function getArquivosByHospedagemId($hospedagem_id, $limit = 0): array
    {
        return HospedagensArquivos::query()
            ->where('hospedagem_id', $hospedagem_id)
            ->when(($limit !== 0), function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->get()
            ->toArray();
    }


    /**
     * @param $arquivo
     * @param $user_id
     * @param $hospedagem_id
     * @return false|Application|ResponseFactory|Response
     */
    public function upload($arquivo, $user_id, $hospedagem_id)
    {
        $ext = $arquivo->getClientOriginalExtension();
        $name = uniqid(date('HisYmd'), false);
        $nameFile = "{$name}.{$ext}";

        $upload = $arquivo->storeAs('hospedagens_arquivos', $nameFile);
        if (!$upload) {
            return false;
        }

        $documentos = array(
            'user_id' => $user_id,
            'hospedagem_id' => $hospedagem_id,
            'filename' => $nameFile,
            'extension' => $ext,
            'size' => $arquivo->getSize(),
        );

        return $this->gravar($documentos);
    }

    /**
     * @param $dados
     */
    public function gravar($dados)
    {
        if (empty($dados)) {
            return response(['message' => 'Sem dados para gravar'], 422);
        }

        $hospedagensArquivos = new HospedagensArquivos();
        $hospedagensArquivos->fill($dados);

        if (!$hospedagensArquivos->save()) {
            return response(['status' => 'error', 'message' => 'Erro ao gravar os dados', 'erros' => $hospedagensArquivos->getErrors()->all()], 422);
        }

        return response(['status' => 'success', 'message' => 'Dados gravado com sucesso', 'dados' => $hospedagensArquivos->toArray()], 200);
    }


    /**
     * @param $id
     * @return bool
     */
    public function delete(?string $id): bool
    {
        $arquivo = HospedagensArquivos::find($id);
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
