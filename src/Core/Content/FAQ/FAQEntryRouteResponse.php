<?php declare(strict_types=1);

namespace EmzFAQ\Core\Content\FAQ;

use Shopware\Core\Framework\DataAbstractionLayer\Search\EntitySearchResult;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

/**
 * Class ExampleRouteResponse
 * @property EntitySearchResult $object
 */
class FAQEntryRouteResponse extends StoreApiResponse
{
    public function getFAQEntries(): FAQEntryCollection
    {
        /** @var FAQEntryCollection $collection */
        $collection = $this->object->getEntities();

        return $collection;
    }
}