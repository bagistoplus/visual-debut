<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\ClearCompareList;
use BagistoPlus\Visual\Actions\GetCompareItems;
use BagistoPlus\Visual\Actions\RemoveItemFromCompareList;
use BagistoPlus\Visual\Blocks\LivewireSection;

use function BagistoPlus\VisualDebut\_t;

class Compare extends LivewireSection
{
    protected static string $type = '@visual-debut/compare';

    protected static array $enabledOn = [
        'templates' => ['compare'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.compare';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h3"/><path d="M16 3h3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-3"/><path d="M12 20v2"/><path d="M12 14v2"/><path d="M12 8v2"/><path d="M12 2v2"/></svg>';

    protected static string $category = 'Commerce';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/compare.png';

    public $productIds = [];

    public static function name(): string
    {
        return _t('sections.compare.name');
    }

    public static function description(): string
    {
        return _t('sections.compare.description');
    }

    public function loadItems($productIds)
    {
        $this->productIds = $productIds;
    }

    public function removeAllItems()
    {
        $this->productIds = [];
        $response = app(ClearCompareList::class)->execute();

        if (isset($response['message'])) {
            session()->flash('success', $response['message']);
        }
    }

    public function removeItem($id)
    {
        $this->productIds = array_diff($this->productIds, [$id]);
        $response = app(RemoveItemFromCompareList::class)->execute($id);

        if (isset($response['message'])) {
            session()->flash('success', $response['message']);
        }
    }

    public function getViewData(): array
    {
        return [
            'items' => app(GetCompareItems::class)->execute($this->productIds),
        ];
    }
}
