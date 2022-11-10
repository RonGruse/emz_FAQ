<?php

declare(strict_types=1);

namespace EmzFAQ\Storefront\Controller;

use EmzFAQ\Core\Content\FAQ\AbstractFAQEntryRoute;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(defaults={"_routeScope"={"storefront"}})
 */
class FAQEntryController extends StorefrontController
{
    private AbstractFAQEntryRoute $route;

    public function __construct(AbstractFAQEntryRoute $route)
    {
        $this->route = $route;
    }

    /**
     * @Route("/product/{productId}/faq", name="frontend.detail.faq.save", methods={"POST"}, defaults={"XmlHttpRequest"=true, "_loginRequired"=true})
     */
    public function saveQuestion(string $productId, RequestDataBag $data, SalesChannelContext $context): Response
    {
        $this->route->save($productId, $data, $context);

        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('productId', $productId));

        $faqs = $this->route->load($criteria, $context);
        return $this->renderStorefront('storefront/page/product-detail/faq/faq.html.twig', [
            'faqs' => $faqs->getFAQEntries(),
            'page' => ['product' => ['id' => $productId]]
        ]);
    }
}
