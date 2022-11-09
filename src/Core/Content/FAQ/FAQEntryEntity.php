<?php declare(strict_types=1);

namespace EmzFAQ\Core\Content\FAQ;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class FAQEntryEntity extends Entity
{
    use EntityIdTrait;

    protected ?string $question;

    protected ?string $answer;

    protected ?ProductEntity $product;

    /**
     * Get the value of question
     *
     * @return ?string
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * Set the value of question
     *
     * @param ?string $question
     *
     * @return self
     */
    public function setQuestion(?string $question): void
    {
        $this->question = $question;
    }

    /**
     * Get the value of answer
     *
     * @return ?string
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * Set the value of answer
     *
     * @param ?string $answer
     *
     * @return self
     */
    public function setAnswer(?string $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * Get the value of product
     *
     * @return ProductEntity
     */
    public function getProduct(): ?ProductEntity
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @param ProductEntity $product
     *
     * @return self
     */
    public function setProduct(?ProductEntity $product): void
    {
        $this->product = $product;
    }
}