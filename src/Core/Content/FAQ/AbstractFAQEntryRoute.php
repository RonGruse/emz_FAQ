<?php declare(strict_types=1);

namespace EmzFAQ\Core\Content\FAQ;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

abstract class AbstractFAQEntryRoute
{
    abstract public function getDecorated(): AbstractFAQEntryRoute;

    abstract public function load(Criteria $criteria, SalesChannelContext $context): FAQEntryRouteResponse;
}