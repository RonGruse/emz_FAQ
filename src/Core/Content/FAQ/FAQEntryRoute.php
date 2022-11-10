<?php declare(strict_types=1);

namespace EmzFAQ\Core\Content\FAQ;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Plugin\Exception\DecorationPatternException;
use Shopware\Core\Framework\Routing\Annotation\Entity;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\NoContentResponse;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(defaults={"_routeScope"={"store-api"}})
 */
class FAQEntryRoute extends AbstractFAQEntryRoute
{
    protected EntityRepositoryInterface $faqEntryRepository;

    public function __construct(EntityRepositoryInterface $faqEntryRepository)
    {
        $this->faqEntryRepository = $faqEntryRepository;
    }

    public function getDecorated(): AbstractFAQEntryRoute
    {
        throw new DecorationPatternException(self::class);
    }

    /**
     * @Entity("emz_faq_entry")
     * @Route("/store-api/emz_faq_entry", name="store-api.emz_faq_entry.search", methods={"GET"})
     */
    public function load(Criteria $criteria, SalesChannelContext $context): FAQEntryRouteResponse
    {
        return new FAQEntryRouteResponse($this->faqEntryRepository->search($criteria, $context->getContext()));
    }

    /**
     * @Route("/store-api/product/{productId}/faq", name="store-api.emz_faq_entry.save", methods={"POST"})
     */
    public function save(string $productId, RequestDataBag $data ,SalesChannelContext $context): NoContentResponse
    {
        $faq = [
            "question" => $data->get('question'),
            "productId" => $productId,
            "answer" => null
        ];
        $this->faqEntryRepository->upsert([$faq], $context->getContext());

        return new NoContentResponse();
    }
}