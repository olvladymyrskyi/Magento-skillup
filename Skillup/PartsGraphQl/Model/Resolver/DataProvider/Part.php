<?php

declare(strict_types=1);

namespace Skillup\PartsGraphQl\Model\Resolver\DataProvider;

use Skillup\Parts\Api\Data\PartInterface;
use Skillup\Parts\Model\PartFactory;
use Skillup\Parts\Model\ResourceModel\Part as PartResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Part data provider
 */
class Part
{
    /**
     * @var PartFactory
     */
    private PartFactory $partFactory;

    /**
     * @var PartResourceModel
     */
    private PartResourceModel $partResourceModel;

    /**
     * Part constructor.
     *
     * @param PartFactory $partFactory
     * @param PartResourceModel $partResourceModel
     */
    public function __construct(
        PartFactory $partFactory,
        PartResourceModel $partResourceModel
    ) {
        $this->partFactory = $partFactory;
        $this->partResourceModel = $partResourceModel;
    }

    /**
     * Returns part data by code
     *
     * @param string $code
     * @return array
     * @throws NoSuchEntityException
     */
    public function getPartDataByCode(string $code): array
    {
        $part = $this->partFactory->create();
        $this->partResourceModel->load($part, $code, PartInterface::CODE);

        if (!$part->getId()) {
            throw new NoSuchEntityException(__('The Part with "%1" ID doesn\'t exist.', $code));
        }

        return $this->convertPartData($part->getDataModel());
    }

    /**
     * Convert data
     *
     * @param PartInterface $part
     * @return array
     */
    private function convertPartData(PartInterface $part): array
    {
        return [
            PartInterface::PART_ID => $part->getPartId(),
            PartInterface::CODE => $part->getCode(),
            PartInterface::NAME => $part->getName(),
            PartInterface::CREATED_AT => $part->getCreatedAt(),
            PartInterface::UPDATED_AT => $part->getUpdatedAt()
        ];
    }

    public function getParts(): array
    {
        $partModel =$this->partFactory->create();
        $collection = $partModel->getCollection(); //Get Collection of module data
        return $collection->getData();
    }
}
