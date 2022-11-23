<?php

declare(strict_types=1);

namespace Skillup\Parts\Model;

use Skillup\Parts\Api\PartManagementInterface;
use Skillup\Parts\Api\Data\PartInterfaceFactory;
use Skillup\Parts\Api\Data\PartManagementDataInterface;
use Skillup\Parts\Api\Data\PartManagementDataInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;

class PartManagement implements PartManagementInterface
{
    /**
     * Constant COUNT_START
     */
    private const COUNT_START = 0;

    /**
     * @var PartManagementDataInterfaceFactory
     */
    private $partManagementData;

    /**
     * @var PartInterfaceFactory
     */
    private $partData;

    /**
     * @var Part
     */
    private $partModel;

    /**
     * @var PartRepository
     */
    private $partRepository;

    /**

     * @param PartManagementDataInterfaceFactory $partManagementData
     * @param PartInterfaceFactory $partData
     * @param Part $partModel
     * @param PartRepository $partRepository
     */
    public function __construct(
        PartManagementDataInterfaceFactory $partManagementData,
        PartInterfaceFactory $partData,
        Part $partModel,
        PartRepository $partRepository
    ) {
        $this->partManagementData = $partManagementData;
        $this->partData = $partData;
        $this->partModel = $partModel;
        $this->partRepository = $partRepository;
    }


    public function createPart(PartManagementDataInterface $partData): array
    {
        $response = [];
        $items = $partData->getItems();
        $successCount = self::COUNT_START;
        $errorCount = self::COUNT_START;
        foreach ($items as $item) {
            try {
                $output = ['Part' => $item->getName()];
                $partDetails = $this->partModel->getPartDetails($item->getCode());
                if (empty($partDetails['part_id'])) {
                    $partDataModel = $this->partData->create();
                    $partDataModel->setPartId(null);
                    $partDataModel->setName($item->getName());
                    $partDataModel->setCode($item->getCode());
                    $this->partRepository->save($partDataModel);
                    $successCount++;
                    $output['success'] = true;
                    $output['message'] = __('Part - %1 created', $item->getName());
                    $response[0]['create'][] = $output;
                    continue;
                } else {
                    throw new LocalizedException(__('Part with %1 already exists', $item->getName()));
                }
            } catch (\Exception $exception) {
                $errorCount++;
                $output['success'] = false;
                $output['message'] = [
                    'msg' => 'Error in creating part data. ' . $exception->getMessage(),
                    'data' => ['Part Name' => $item->getName()]
                ];
                $response[0]['create'][] = $output;
                continue;
            }
        }
        $response[0]['part_items'] = [
            'total' => count($items),
            'created' => $successCount,
            'errors' => $errorCount
        ];
        return $response;
    }


    public function updatePart(PartManagementDataInterface $partData): array
    {
        $response = [];
        $createParts = [];
        $items = $partData->getItems();
        $successCount = self::COUNT_START;
        $errorCount = self::COUNT_START;
        foreach ($items as $item) {
            try {
                $output = ['Part' => $item->getName()];
                $partDetails = $this->partModel->getPartDetails($item->getCode());
                if (isset($partDetails['part_id'])) {
                    $partDataModel = $this->partData->create();
                    $partDataModel->setPartId((int)$partDetails['part_id']);
                    $partDataModel->setName($item->getName());
                    $partDataModel->setCode($item->getCode());
                    $this->partRepository->save($partDataModel);
                    $successCount++;
                    $output['success'] = true;
                    $output['message'] = __('Part - %1 updated', $item->getName());
                    $response[0]['create'][] = $output;
                    continue;
                } else {
                    $createParts[] = $item;
                }
            } catch (\Exception $exception) {
                $errorCount++;
                $output['success'] = false;
                $output['message'] = [
                    'msg' => 'Error in updating part data. ' . $exception->getMessage(),
                    'data' => ['Part Name' => $item->getName()]
                ];
                $response[0]['update_part'][] = $output;
                continue;
            }
        }

        $response[0]['part_items'] = [
            'updated' => $successCount,
            'total' => count($items),
            'errors' => $errorCount
        ];

        if (isset($createParts) && !empty($createParts)) {
            $partItems = $this->partManagementData->create()->setItems($createParts);
            $response[0]['create_part'] = $this->createPart($partItems);
        }
        return $response;
    }

    public function deletePart(string $code): array
    {
        $output = [];
        try {
            $partDetails = $this->partModel->getPartDetails($code);
            if (isset($partDetails['part_id'])) {
                $this->partRepository->deleteById((int)$partDetails['part_id']);
                $output['success'] = true;
                $output['message'] = __('Part - %1 deleted', $partDetails['name']);
            } else {
                throw new LocalizedException(__('Part %1 does not exists', $code));
            }
        } catch (\Exception $exception) {
            $output['success'] = false;
            $output['message'] = [
                'msg' => 'Error:' . $exception->getMessage(),
                'data' => ['Part' => $code]
            ];
        }
        return $output;
    }


    public function getPart(string $code): array
    {
        $output = [];
        try {
            $partDetails = $this->partModel->getPartDetails($code);
            if (isset($partDetails['part_id'])) {
                $entity = $this->partRepository->getById((int)$partDetails['part_id']);
                $output[] = $entity->getData();
            } else {
                throw new LocalizedException(__('Part %1 does not exists', $code));
            }
        } catch (\Exception $exception) {
            $output['success'] = false;
            $output['message'] = [
                'msg' => 'Error: ' . $exception->getMessage(),
                'data' => ['Part' => $code]
            ];
        }
        return $output;
    }
}
