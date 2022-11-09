<?php declare(strict_types=1);

namespace EmzFAQ\Core\Content\FAQ;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Plugin\Exception\DecorationPatternException;
use Shopware\Core\Framework\Routing\Annotation\Entity;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(defaults={"_routeScope"={"store-api"}})
 */
class FAQEntryRoute extends AbstractFAQEntryRoute
{
    protected EntityRepositoryInterface $exampleRepository;

    public function __construct(EntityRepositoryInterface $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function getDecorated(): AbstractFAQEntryRoute
    {
        throw new DecorationPatternException(self::class);
    }

    /**
     * @Entity("emz_faq_entry")
     * @Route("/store-api/emz_faq_entry", name="store-api.emz_faq_entry.search", methods={"GET", "POST"})
     */
    public function load(Criteria $criteria, SalesChannelContext $context): FAQEntryRouteResponse
    {
        return new FAQEntryRouteResponse($this->exampleRepository->search($criteria, $context->getContext()));
    }
}