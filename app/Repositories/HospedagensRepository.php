<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Hospedagens;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Throwable;

class HospedagensRepository
{
    public const TYPE_RECOMENDADOS = 1;
    public const TYPE_RECENTES = 2;

    /**
     * @var string
     */
    private string $path;

    public function __construct()
    {
        $this->path = 'app/public/logos/';
    }

    public function tabela(): array
    {
        return Hospedagens::query()->get()->toArray();
    }

    public function show(string $hospedagem_id)
    {
        return Hospedagens::findOrFail($hospedagem_id)->first()->toArray();
    }

    /**
     * @param array|null $dados
     * @param string|null $id
     * @throws Throwable
     */
    public function gravar(?array $dados, ?string $id = null)
    {
        throw_if(empty($dados), 'Sem dados para gravar.');

        $hospedagem = new Hospedagens;

        $hospedagem->fill($dados);

        return tap($hospedagem)->save();
    }

    public function hospedagens(?string $status, ?int $type, $limit = 5): array
    {
        if ($type === self::TYPE_RECOMENDADOS) {
            $hospedagens = Hospedagens::query()
                ->where('status', $status)
                ->where('recomendado', 1)
                ->where('permite_afiliacao', 1)
                ->limit($limit)
                ->get()
                ->toArray();
        }
        if ($type === self::TYPE_RECENTES) {
            $hospedagens = Hospedagens::query()
                ->where('status', $status)
                ->where('permite_afiliacao', 1)
                ->latest('created_at')
                ->limit($limit)
                ->get()
                ->toArray();
        }

        return $hospedagens ?? [];
    }

}
