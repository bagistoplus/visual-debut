<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\CategoryList;
use BagistoPlus\Visual\Settings\Range;
use Webkul\Category\Repositories\CategoryRepository;

use function BagistoPlus\VisualDebut\_t;

class Nav extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.header.nav';

    protected static string $type = '@visual-debut/header-nav';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>';

    protected static string $category = 'Header';

    public static function name(): string
    {
        return _t('blocks.header-nav.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-nav.description');
    }

    public static function settings(): array
    {
        return [
            CategoryList::make('categories', _t('blocks.header-nav.settings.categories_label'))
                ->info(_t('blocks.header-nav.settings.categories_info')),

            Range::make('category_limit', _t('blocks.header-nav.settings.category_limit_label'))
                ->min(1)
                ->max(12)
                ->step(1)
                ->default(6)
                ->info(_t('blocks.header-nav.settings.category_limit_info')),
        ];
    }

    public function getCategories()
    {
        $selectedCategories = collect($this->block->settings->categories ?? []);
        $categories = $selectedCategories->isNotEmpty()
            ? $selectedCategories
            : $this->getRootCategories();

        $limit = max(1, (int) ($this->block->settings->category_limit ?? 6));

        return $categories
            ->filter(fn ($category) => (bool) $category->slug)
            ->take($limit);
    }

    protected function getRootCategories()
    {
        // @phpstan-ignore-next-line
        $rootCategoryId = core()->getCurrentChannel()->root_category_id;

        return app(CategoryRepository::class)->getVisibleCategoryTree($rootCategoryId);
    }

    protected function getViewData(): array
    {
        return [
            'categoryList' => $this->getCategories(),
        ];
    }
}
