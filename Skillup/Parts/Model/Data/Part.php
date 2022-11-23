<?php

declare(strict_types=1);

namespace Skillup\Parts\Model\Data;

use Magento\Framework\Model\AbstractExtensibleModel;
use Skillup\Parts\Api\Data\PartExtensionInterface;

class Part extends AbstractExtensibleModel implements \Skillup\Parts\Api\Data\PartInterface
{

    /**
     * @return int|null
     */

    public function getPartId(): ?int
    {
        return (int)$this->getData(self::PART_ID);
    }

    public function setPartId(?int $partId): void
    {
        $this->setData(self::PART_ID, $partId);
    }

    public function getName(): string
    {
        return (string) $this->getData(self::NAME);
    }

    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    public function getCode(): string
    {
        return (string) $this->getData(self::CODE);
    }

    public function setCode(string $code): void
    {
        $this->setData(self::CODE, $code);
    }

    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function getExtensionAttributes(): ?PartExtensionInterface
    {
        return $this->_getExtensionAttributes();
    }

    public function setExtensionAttributes(PartExtensionInterface $extensionAttributes): void
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
