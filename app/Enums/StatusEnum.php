<?php


namespace App\Enums;


/**
 * Class StatusEnum
 * @package App\Enums
 * @author Caroline Santos <22/03/2023 23:42>
 */
class StatusEnum
{
    /**
     *
     */
    public const PROPOSTA = 'em proposta';
    /**
     *
     */
    public const ANALISE = 'em analise';

    /**
     *
     */
    public const DESENVOLVIMENTO = 'em desenvolvimento';
    /**
     *
     */
    public const VENDIDO = 'vendido';
    /**
     *
     */
    public const RECUSADO = 'recusado';
    /**
     *
     */
    public const PROPOSTA_ID = 1; // 'em proposta';
    public const ANALISE_ID = 2; //'em analise';
    public const DESENVOLVIMENTO_ID = 7; //'em desenvolvimento';
    public const APROVADO_HOSPEDAGEM = 4; //'aprovado para o usuario conseguir buscar pelo codigo e preencher o restante dos dados da hospedagem';


    public const APROVADO = 'aprovado';
    public const PENDENTE = 'pendente';

    public const APROVADO_ID = 5;
    public const PENDENTE_ID = 6;

}