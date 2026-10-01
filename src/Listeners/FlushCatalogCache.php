<?php

namespace BagistoPlus\VisualDebut\Listeners;

use BagistoPlus\VisualDebut\Support\CatalogCache;

/**
 * Retires everything a listing cached about the catalog.
 */
class FlushCatalogCache
{
    /**
     * The events every supported Bagisto dispatches for a catalog change, from
     * the admin and from an import.
     *
     * @var array<int, string>
     */
    public const EVENTS = [
        'catalog.product.create.after',
        'catalog.product.update.after',
        'catalog.product.delete.after',
        'catalog.category.create.after',
        'catalog.category.update.after',
        'catalog.category.delete.after',
        'catalog.attribute.create.after',
        'catalog.attribute.update.after',
        'catalog.attribute.delete.after',
        'data_transfer.imports.batch.import.after',
        'data_transfer.imports.batch.indexing.after',
    ];

    public function __construct(private readonly CatalogCache $cache) {}

    public function handle(mixed $payload = null): void
    {
        $this->cache->flush();
    }
}
