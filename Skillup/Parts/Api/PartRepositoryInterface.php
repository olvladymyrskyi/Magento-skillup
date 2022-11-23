<?php
declare(strict_types=1);

namespace Skillup\Parts\Api;

use Skillup\Parts\Api\Data\PartInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Skillup\Parts\Api\Data\PartSearchResultsInterface;

/**
 * Interface PartRepositoryInterface
 * Skillup\Parts\Api
 */
interface PartRepositoryInterface
{
    /**
     * @param PartInterface $part
     * @return \Skillup\Parts\Api\Data\PartInterface
     */
    public function save(\Skillup\Parts\Api\Data\PartInterface $part): PartInterface;

    /**
     * Get part by id
     *
     * @param int $partId
     * @return \Skillup\Parts\Api\Data\PartInterface
     */
    public function getById(int $partId): PartInterface;

    /**
     * Delete object
     *
     * @param PartInterface $part
     * @return bool
     */
    public function delete(PartInterface $part): bool;

    /**
     * Delete part object by id
     *
     * @param int $partId
     * @return bool
     */
    public function deleteById(int $partId): bool;

    /**
     * Get partsObject
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Skillup\Parts\Api\Data\PartSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PartSearchResultsInterface;
}
