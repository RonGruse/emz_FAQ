<?php

declare(strict_types=1);

namespace EmzFAQ\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1667576045FAQEntry extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1667576045;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
        CREATE TABLE `emz_faq_entry` (
    `id` BINARY(16) NOT NULL,
    `question` VARCHAR(255) NULL,
    `answer` VARCHAR(255) NULL,
    `product_version_id` BINARY(16) NOT NULL,
    `product_id` BINARY(16) NOT NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`),
    KEY `fk.emz_faq_entry.product_id` (`product_id`,`product_version_id`),
    CONSTRAINT `fk.emz_faq_entry.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
