<?php

declare(strict_types=1);

namespace Skillup\Parts\Model;

use Skillup\Parts\Api\Data\PartInterface;
use Skillup\Parts\Api\Data\PartInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaBuilder;


class Part extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var PartInterfaceFactory
     */
    private PartInterfaceFactory $partDataFactory;

    /**
     * @var DataObjectHelper
     */
    private DataObjectHelper $dataObjectHelper;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var PartRepository
     */
    private PartRepository $partRepository;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PartInterfaceFactory $partDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\Part $resource
     * @param ResourceModel\Part\Collection $resourceCollection
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PartRepository $partRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Skillup\Parts\Api\Data\PartInterfaceFactory $partDataFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Skillup\Parts\Model\ResourceModel\Part $resource,
        \Skillup\Parts\Model\ResourceModel\Part\Collection $resourceCollection,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PartRepository $partRepository,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->partDataFactory = $partDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->partRepository = $partRepository;
    }

    /**
     * @return PartInterface
     */
    public function getDataModel(): PartInterface
    {
        $partData = $this->getData();
        $partDataObject = $this->partDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $partDataObject,
            $partData,
            PartInterface::class
        );
        return $partDataObject;
    }

    /**
     * @param string $code
     * @return string[]
     */
    public function getPartDetails(string $code): array
    {
        $partDetails = [];
        $this->searchCriteriaBuilder
            ->addFilter(PartInterface::CODE, $code)
            ->setPageSize(1);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $items = $this->partRepository->getList($searchCriteria)->getItems();
        foreach ($items as $item) {
            $partDetails = $item->getData();
        }
        return $partDetails;
    }
}
