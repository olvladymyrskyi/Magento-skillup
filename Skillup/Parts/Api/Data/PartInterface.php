<?php

declare(strict_types=1);

namespace Skillup\Parts\Api\Data;

use Skillup\Parts\Api\Data\PartExtensionInterface;
use Magento\Framework\Api\ExtensibleDataInterface;


interface PartInterface extends ExtensibleDataInterface
{
    public const PART_ID = 'part_id';
    public const NAME = 'name';
    public const CODE = 'code';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get Part ID
     *
     * @return int|null
     */
    public function getPartId(): ?int;

    /**
     * Set Part ID
     *
     * @param int|null $partId
     * @return void
     */
    public function setPartId(?int $partId): void;

    /**
     * Get Part Name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set Part Name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Get Part Code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Set Part Code
     *
     * @param string $code
     * @return void
     */
    public function setCode(string $code): void;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt): void;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void;

    /**
     * @return \Skillup\Parts\Api\Data\PartExtensionInterface|null
     */
    public function getExtensionAttributes(): ?PartExtensionInterface;

    /**
     * @param \Skillup\Parts\Api\Data\PartExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(PartExtensionInterface $extensionAttributes): void;
}
