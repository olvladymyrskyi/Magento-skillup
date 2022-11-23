<?php

declare(strict_types=1);

namespace Skillup\Parts\Model;

use Skillup\Parts\Api\Data\PartSearchResultsInterface;
use Magento\Framework\Api\SearchResults as ApiSearchResultsAlias;


class SearchResults extends ApiSearchResultsAlias implements PartSearchResultsInterface
{

}
