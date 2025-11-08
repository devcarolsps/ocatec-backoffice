<?php


namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Afiliacao;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class AfiliacaoRepository
 * @package App\Repositories
 * @author Caroline Santos <24/03/2023 15:25>
 */
class AfiliacaoRepository
{
    /**
     * @param $hospedagem_id
     * @param $user_id
     * @return Application|ResponseFactory|Response
     * @throws BindingResolutionException
     */
    public function store($hospedagem_id, $user_id)
    {
        $dados['user_id'] = $user_id;
        $dados['hospedagem_id'] = $hospedagem_id;
        $dados['status'] = StatusEnum::PENDENTE_ID;

        $afiliado = new Afiliacao();
        $afiliado->fill($dados);

        if (!$afiliado->save()) {
            return response(['status' => 'error', 'message' => 'Erro ao gravar os dados', 'erros' => $afiliado->getErrors()->all()], 422);
        }

        return response(['status' => 'success', 'message' => 'Dados gravado com sucesso', 'dados' => $afiliado->toArray()], 200);
    }

    /**
     * @param $hospedagem_id
     * @param $user_id
     * @return Builder|Model|Collection|object
     */
    public function check($hospedagem_id, $user_id)
    {
        return Afiliacao::query()
            ->select(['id'])
            ->where('hospedagem_id', $hospedagem_id)
            ->where('user_id', $user_id)
            ->first();
    }

    /**
     * @param $status
     * @param $user_id
     * @return array
     */
    public function afiliacoesByUser($status, $user_id): array
    {
        if ($status === StatusEnum::APROVADO) {
            $tabela = Afiliacao::query()
                ->select('hospedagens.*')
                ->leftJoin('hospedagens', 'hospedagens.id', '=', 'afiliacao.hospedagem_id')
                ->where('afiliacao.user_id', $user_id)
                ->where('afiliacao.status', StatusEnum::APROVADO_ID)
                ->get()
                ->toArray();
        }

        if ($status === StatusEnum::PENDENTE) {
            $tabela = Afiliacao::query()
                ->select('hospedagens.*')
                ->leftJoin('hospedagens', 'hospedagens.id', '=', 'afiliacao.hospedagem_id')
                ->where('afiliacao.user_id', $user_id)
                ->where('afiliacao.status', StatusEnum::PENDENTE_ID)
                ->get()
                ->toArray();
        }

        return $tabela ?? [];
    }

}
