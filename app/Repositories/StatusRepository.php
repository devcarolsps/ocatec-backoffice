<?php


namespace App\Repositories;

use App\Enums\StatusEnum;

/**
 * Class StatusRepository
 * @package App\Repositories
 * @author Caroline Santos <22/03/2023 20:35>
 */
class StatusRepository
{
    /**
     * @param int $statusId
     * @return string
     */
    public function statusName(int $statusId): string
    {
        $statusName = [
            '1' => StatusEnum::PROPOSTA,
            '2' => StatusEnum::ANALISE,
            '3' => StatusEnum::VENDIDO,
            '4' => StatusEnum::RECUSADO,
            '5' => StatusEnum::APROVADO,
            '6' => StatusEnum::PENDENTE,
            '7' => StatusEnum::DESENVOLVIMENTO,
        ];

        return $statusName[$statusId];
    }


    /**
     * @param int $statusId
     * @return string
     */
    public function statusNameBadge(int $statusId): string
    {
        switch ($statusId) {
            case 1:
            case 6:
                $badgeStatus = '<span class="badge" style="background-color: yellow;color: black;font-size: 1em;">' . strtoupper($this->statusName($statusId)) . '</span>';
                break;
            case 2:
                $badgeStatus = '<span class="badge" style="background-color: blue;color: white;font-size: 1em;">' . strtoupper($this->statusName($statusId)) . '</span>';
                break;
            case 3:
            case 5:
                $badgeStatus = '<span class="badge" style="background-color: green;color: white;font-size: 1em;">' . strtoupper($this->statusName($statusId)) . '</span>';
                break;
            case 4:
                $badgeStatus = '<span class="badge" style="background-color: red;color: white;font-size: 1em;">' . strtoupper($this->statusName($statusId)) . '</span>';
                break;
            case 7:
                $badgeStatus = '<span class="badge" style="background-color: purple;color: white;font-size: 1em;">' . strtoupper($this->statusName($statusId)) . '</span>';
                break;
            default:
                $badgeStatus = '';
        }


        return $badgeStatus;
    }
}
