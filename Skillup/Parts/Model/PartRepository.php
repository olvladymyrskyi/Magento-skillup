<?php

declare(strict_types=1);

namespace Skillup\Parts\Model;

use Skillup\Parts\Api\Data\PartInterface;
use Skillup\Parts\Api\Data\PartSearchResultsInterface;
use Skillup\Parts\Model\PartFactory;
use Skillup\Parts\Model\ResourceModel\Part as ResourcePart;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Skillup\Parts\Api\Data\PartSearchResultsInterfaceFactory;
use Skillup\Parts\Model\ResourceModel\Part\CollectionFactory as PartCollectionFactory;
use Psr\Log\LoggerInterface;


class PartRepository implements \Skillup\Parts\Api\PartRepositoryInterface
{
    /**
     * @var PartFactory
     */
    private $partFactory;

    /**
     * @var ResourcePart
     */
    private $resourcePart;

    /**
     * @var JoinProcessorInterface
     */
    private $joinProcessor;

    /**
     * @var PartCollectionFactory
     */
    private $partCollectionFactory;

    /**
     * @var ExtensibleDataObjectConverter
     */
    private $extensibleDataObjectConverter;

    /**
     * @var PartSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param \Skillup\Parts\Model\PartFactory $partFactory
     * @param ResourcePart $resourcePart
     * @param JoinProcessorInterface $joinProcessor
     * @param PartCollectionFactory $partCollectionFactory
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     * @param PartSearchResultsInterfaceFactory $searchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        PartFactory $partFactory,
        ResourcePart $resourcePart,
        JoinProcessorInterface $joinProcessor,
        PartCollectionFactory $partCollectionFactory,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        PartSearchResultsInterfaceFactory $searchResultFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    ) {
        $this->partFactory = $partFactory;
        $this->resourcePart = $resourcePart;
        $this->joinProcessor = $joinProcessor;
        $this->partCollectionFactory = $partCollectionFactory;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function save(PartInterface $part): PartInterface
    {
        $partData = $this->extensibleDataObjectConverter->toNestedArray(
            $part,
            [],
            PartInterface::class
        );
        $partModel = $this->partFactory->create()->setData($partData);
        try {
            $this->resourcePart->save($partModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Part Index : %1',
                $exception->getMessage()
            ));
        }
        return $partModel->getDataModel();
    }

    public function getById(int $partId): PartInterface
    {
        $part = $this->partFactory->create();
        $this->resourcePart->load($part, $partId);
        return $part->getDataModel();
    }

    public function deleteById(int $partId): bool
    {
        try {
            $part = $this->getById($partId);
            return $this->delete($part);
        } catch (\Exception $exception) {
            $this->logger->critical($exception);
        }

        return false;
    }

    public function delete(PartInterface $part): bool
    {
        try {
            $partModel = $this->partFactory->create();
            $this->resourcePart->load($partModel, $part->getPartId());
            $this->resourcePart->delete($partModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Part Index option row : %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): PartSearchResultsInterface
    {
        /** @var \Skillup\Parts\Model\ResourceModel\Part\Collection $collection */
        $collection = $this->partCollectionFactory->create();
        $this->joinProcessor->process(
            $collection,
            PartInterface::class
        );
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
