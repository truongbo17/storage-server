<?php

declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateMyIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::dropIfExists('documents');
        Index::dropIfExists('keywords');

        Index::create('documents', function (Mapping $mapping, Settings $settings) {
            $mapping->text('title');
            $mapping->text('content');
        });
        Index::create('keywords', function (Mapping $mapping, Settings $settings) {
            $mapping->text('content');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        //
    }
}
