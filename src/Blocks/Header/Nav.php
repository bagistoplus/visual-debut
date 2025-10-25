<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;
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
        return [];
    }

    public function getCategories()
    {
        // @phpstan-ignore-next-line
        $rootCategoryId = core()->getCurrentChannel()->root_category_id;

        $categories = app(CategoryRepository::class)->getVisibleCategoryTree($rootCategoryId);

        return $categories->filter(fn($c) => (bool) $c->slug);
    }

    protected function getViewData(): array
    {
        return [
            'categories' => $this->getCategories()
        ];
    }
}
