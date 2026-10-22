<?php

return [
    'code' => 'visual-debut',
    'name' => 'Visual Debut',
    'version' => '2.0.0-alpha',
    'author' => 'Bagisto Plus',
    'description' => 'The reference theme for Bagisto Visual. A fast, responsive storefront you customize section by section in the visual editor.',
    'assets_path' => 'public/themes/shop/visual-debut',
    'views_path' => 'resources/themes/visual-debut/views',
    'preview_image' => 'themes/shop/visual-debut/images/theme-preview.png',
    'documentation_url' => 'https://visual.bagistoplus.com',

    'vite' => [
        'hot_file' => 'themes/shop/visual-debut/visual-debut-vite.hot',
        'build_directory' => 'themes/shop/visual-debut',
        'package_assets_directory' => 'resources/assets',
    ],
];
