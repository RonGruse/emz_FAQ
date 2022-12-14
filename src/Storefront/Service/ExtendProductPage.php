<?php

declare(strict_types=1);

namespace EmzFAQ\Storefront\Service;

use EmzFAQ\Core\Content\FAQ\FAQEntryRoute;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExtendProductPage implements EventSubscriberInterface
{
    private FAQEntryRoute $faqEntryRoute;

    public function __construct(FAQEntryRoute $faqEntryRoute)
    {
        $this->faqEntryRoute = $faqEntryRoute;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ProductPageLoadedEvent::class => 'addFAQ'
        ];
    }

    public function addFAQ(ProductPageLoadedEvent $event): void
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('productId', $event->getPage()->getProduct()->getId()));
        $criteria->addFilter(new NotFilter(NotFilter::CONNECTION_OR, [new EqualsFilter('answer', null)]));
        $faqResponse = $this->faqEntryRoute->load($criteria, $event->getSalesChannelContext());

        $event->getPage()->addExtension('faq', $faqResponse->getFAQEntries());
    }
}
