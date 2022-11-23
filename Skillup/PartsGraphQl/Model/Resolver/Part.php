<?php

declare(strict_types=1);

namespace Skillup\PartsGraphQl\Model\Resolver;

use Skillup\PartsGraphQl\Model\Resolver\DataProvider\Part as PartDataProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;


class Part implements ResolverInterface
{
    /**
     * @var PartDataProvider
     */
    private PartDataProvider $partDataProvider;

    /**
     *
     * @param PartDataProvider $partDataProvider
     */
    public function __construct(
        PartDataProvider $partDataProvider
    ) {
        $this->partDataProvider = $partDataProvider;
    }

    /**
     * Fetch data from models and format it according to the GraphQL schema.
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws GraphQlInputException
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        if (!isset($args['code'])) {
            throw new GraphQlInputException(__('"Part code should be specified'));
        }

        $partsData = [];

        try {
            if (isset($args['code'])) {
                $partsData = $this->partDataProvider->getPartDataByCode((string)$args['code']);
            }
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $partsData;
    }
}
