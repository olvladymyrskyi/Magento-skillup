<?php

declare(strict_types=1);

namespace Skillup\Parts\Api;

/**
 * Interface PartManagementInterface
 *
 * Skillup\Parts\Api
 */
interface PartManagementInterface
{
    /**
     * @param Data\PartManagementDataInterface $partData
     * @return array
     */
    public function createPart(Data\PartManagementDataInterface $partData): array;

    /**
     * @param Data\PartManagementDataInterface $partData
     * @return array
     */
    public function updatePart(Data\PartManagementDataInterface $partData): array;

    /**
     * @param string $code
     * @return array
     */
    public function deletePart(string $code): array;

    /**
     * @param string $code
     * @return array
     */
    public function getPart(string $code): array;
}
