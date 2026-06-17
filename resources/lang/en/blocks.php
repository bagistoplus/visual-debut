<?php

return [
    'common' => [
        'product_label' => 'Product',
        'color_scheme_label' => 'Color Scheme',
        'color_scheme_info' => 'Override section color scheme for this block',

        // Spacing
        'spacing_header' => 'Spacing',
        'padding_header' => 'Padding',
        'padding_label' => 'Padding',
        'margin_label' => 'Margin',
        'hide_on_mobile_label' => 'Hide on mobile',
    ],

    'product' => [
        'name' => 'Product',
        'settings' => [
            'product_info' => 'Select a product to display',
        ],
    ],

    'product-card-group' => [
        'name' => 'Product Card Group',
    ],

    'category' => [
        'name' => 'Category',
        'settings' => [
            'category_label' => 'Category',
        ],
    ],

    'category-card' => [
        'name' => 'Category Card',
        'settings' => [
            'category_label' => 'Category',
        ],
        'presets' => [
            'overlay' => [
                'name' => 'Category Card with Overlay',
            ],
            'vertical_overlay' => [
                'name' => 'Vertical with Overlay',
            ],
            'vertical_below' => [
                'name' => 'Vertical with Name Below',
            ],
            'simple_hover' => [
                'name' => 'Simple Hover',
            ],
        ],
    ],

    'feature' => [
        'icon_label' => 'Icon',
        'title_label' => 'Title',
        'text_label' => 'Description',
    ],

    'featured-product' => [
        'name' => 'Featured Product',
        'product_label' => 'Product',
        'product_info' => 'Select a product to display',
    ],

    'footer-group' => [
        'name' => 'Footer Group',
        'title_label' => 'Group Name',
        'title_default' => 'Links Group',
    ],

    'footer-link' => [
        'name' => 'Footer Link',
        'text_label' => 'Link Text',
        'text_default' => 'Link',
        'link_label' => 'Link URL',
    ],

    'collage-image' => [
        'image_label' => 'Image',
    ],

    'collage-product' => [
        'product_label' => 'Product',
    ],

    'collage-category' => [
        'category_label' => 'Select Category',
    ],

    'collage-custom' => [
        'image_label' => 'Image',
        'title_label' => 'Title',
        'text_label' => 'Description',
        'link_label' => 'Link URL',
        'link_text_label' => 'Link Text',
    ],

    'text-with-image-button' => [
        'text_label' => 'Button Text',
        'url_label' => 'Button URL',
        'text_default' => 'Button Text',
        'variant_label' => 'Button Variant',
        'variant_primary' => 'Primary',
        'variant_secondary' => 'Secondary',
        'variant_accent' => 'Accent',
        'variant_neutral' => 'Neutral',
        'style_label' => 'Button Style',
        'style_solid' => 'Solid',
        'style_soft' => 'Soft',
        'style_outline' => 'Outline',
        'style_ghost' => 'Ghost',
    ],

    'accordion' => [
        'name' => 'Accordion',
        'settings' => [
            'icon_label' => 'Icon Style',
            'icon_options' => [
                'caret' => 'Caret',
                'plus' => 'Plus',
            ],

            'dividers_label' => 'Show Dividers',

            'inherit_color_scheme_label' => 'Inherit Color Scheme',
            'color_scheme_label' => 'Color Scheme',

            'borders_header' => 'Borders',

            'border_label' => 'Border Style',
            'border_options' => [
                'none' => 'None',
                'solid' => 'Solid',
            ],

            'border_width_label' => 'Border Thickness',
            'border_opacity_label' => 'Border Opacity',
            'border_radius_label' => 'Border Radius',
        ],

        'presets' => [
            'accordion' => [
                'name' => 'Accordion',
            ],
        ],
    ],

    'accordion-row' => [
        'name' => 'Accordion Row',
        'settings' => [
            'heading_label' => 'Heading',
            'open_by_default_label' => 'Open by Default',

            'icon_header' => 'Icon',

            'icon_label' => 'Icon',
            'width_label' => 'Icon Width',
        ],

        'presets' => [
            'accordion_row' => [
                'name' => 'Accordion Row',
            ],
        ],
    ],

    'product-media-gallery' => [
        'name' => 'Product Media Gallery',
        'settings' => [
            'presentation_header' => 'Presentation',

            'media_presentation_label' => 'Media Presentation',
            'media_presentation_options' => [
                'carousel' => 'Carousel',
                'grid' => 'Grid',
            ],
            'media_presentation_info' => 'Choose how to display product images and videos',

            'grid_columns_label' => 'Grid Columns',
            'grid_columns_info' => 'Number of columns when using grid presentation',

            'image_gap_label' => 'Image Gap',
            'image_gap_info' => 'Space between images in grid view',

            'image_settings_header' => 'Image Settings',

            'aspect_ratio_label' => 'Aspect Ratio',
            'aspect_ratio_options' => [
                'adapt' => 'Adapt to image',
                'square' => 'Square (1:1)',
                'portrait' => 'Portrait (2:3)',
                'landscape' => 'Landscape (3:2)',
            ],

            'constrain_to_viewport_label' => 'Constrain to Viewport',
            'constrain_to_viewport_info' => 'Prevent images from exceeding screen height',

            'media_fit_label' => 'Media Fit',
            'media_fit_options' => [
                'contain' => 'Contain',
                'cover' => 'Cover',
            ],

            'media_radius_label' => 'Media Corner Radius',

            'zoom_label' => 'Enable Zoom',
            'zoom_info' => 'Allow users to zoom into product images',

            'layout_header' => 'Layout',

            'sticky_label' => 'Sticky',
            'sticky_info' => 'Keep media gallery visible while scrolling',
        ],
    ],

    'product-details' => [
        'name' => 'Product Details',
        'settings' => [
            'layout_header' => 'Layout',
            'gap_label' => 'Gap',
            'gap_info' => 'Space between child blocks',

            'sticky_label' => 'Sticky',
            'sticky_info' => 'Keep product details visible while scrolling',
        ],
    ],

    'product-price' => [
        'name' => 'Product Price',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-rating' => [
        'name' => 'Product Rating',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-quantity-selector' => [
        'name' => 'Quantity Selector',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-buy-buttons' => [
        'name' => 'Buy Buttons',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
            'enable_buy_now_label' => 'Enable Buy Now Button',
            'enable_buy_now_info' => 'Show a separate "Buy Now" button for quick checkout',
        ],
    ],

    'product-button' => [
        'name' => 'Product Button',
        'settings' => [
            'action_label' => 'Action',
            'action_options' => [
                'cart' => 'Add to Cart',
                'wishlist' => 'Add to Wishlist',
                'compare' => 'Add to Compare',
            ],
            'variant_label' => 'Variant',
            'variant_options' => [
                'solid' => 'Solid',
                'outline' => 'Outline',
                'soft' => 'Soft',
                'link' => 'Link',
            ],
            'size_label' => 'Size',
            'size_options' => [
                'sm' => 'Small',
                'md' => 'Medium',
                'lg' => 'Large',
                'xl' => 'Extra Large',
            ],
            'color_label' => 'Color',
            'color_options' => [
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'success' => 'Success',
                'danger' => 'Danger',
                'warning' => 'Warning',
                'info' => 'Info',
            ],
            'icon_label' => 'Icon',
            'icon_info' => 'Optional icon to display in the button',
            'circle_label' => 'Circle Button',
            'circle_info' => 'Make the button circular (icon only)',
            'square_label' => 'Square Button',
            'square_info' => 'Make the button square (icon only)',
            'block_label' => 'Full Width',
            'block_info' => 'Make the button span the full width of its parent',
        ],
        'placeholder' => [
            'cart' => 'Add to Cart',
            'wishlist' => 'Add to Wishlist',
            'compare' => 'Add to Compare',
        ],
        'wishlist_disabled' => 'Wishlist disabled',
        'compare_disabled' => 'Compare disabled',
    ],

    'product-card' => [
        'name' => 'Product Card',
        'presets' => [
            'vertical' => [
                'name' => 'Vertical Card',
            ],
            'horizontal' => [
                'name' => 'Horizontal Card',
            ],
            'overlay' => [
                'name' => 'Card with Hover Overlay',
                'defaults' => [
                    'product_card' => 'Product Card',
                    'container' => 'Container',
                    'product_image' => 'Product Image',
                    'buttons' => 'Buttons',
                    'add_to_cart' => 'Add to cart',
                    'add_to_wishlist' => 'Add to wishlist',
                    'add_to_compare' => 'Add to compare',
                    'information' => 'Informations',
                    'product_title' => 'Product Title',
                    'price_and_labels' => 'Price & Labels',
                    'price' => 'Price',
                    'labels' => 'Labels',
                ],
            ],
        ],
    ],

    'product-variant-picker' => [
        'name' => 'Variant Picker',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-grouped-options' => [
        'name' => 'Grouped Options',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-bundle-options' => [
        'name' => 'Bundle Options',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-downloadable-options' => [
        'name' => 'Downloadable Options',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-customizable-options' => [
        'name' => 'Product Customizable Options',
        'description' => 'Display customizable product options with price adjustments',
    ],

    'logo' => [
        'name' => 'Logo',
        'description' => 'Site logo or name',
        'settings' => [
            'logo_text_label' => 'Logo Text',
            'logo_text_placeholder' => 'Displayed when no logo image is set',
            'logo_text_info' => 'Logo images are configured in theme settings under "Logo & Favicon"',
        ],
    ],

    'header-nav' => [
        'name' => 'Navigation',
        'description' => 'Main navigation menu displayed in the header',
        'settings' => [
            'push_to_left' => 'Push this element to the start',
            'push_to_right' => 'Push this element to the end',
            'categories_label' => 'Categories',
            'categories_info' => 'Select categories to show in the header navigation. Leave empty to use root categories.',
            'category_limit_label' => 'Category Limit',
            'category_limit_info' => 'Maximum number of categories to show.',
        ],
    ],

    'header-group' => [
        'name' => 'Header Group',
    ],

    'header-currency' => [
        'name' => 'Currency Selector',
        'description' => 'Allows customers to switch between available currencies',
    ],

    'header-locale' => [
        'name' => 'Language Selector',
        'description' => 'Allows customers to switch between available languages',
        'settings' => [
            'icon_label' => 'Icon',
        ],
    ],

    'header-search' => [
        'name' => 'Search Form',
        'description' => 'Product search input with optional image search',
        'settings' => [
            'search_icon_label' => 'Search Icon',
            'image_search_icon_label' => 'Image Search Icon',
        ],
    ],

    'header-compare' => [
        'name' => 'Compare',
        'description' => 'Link to product comparison page',
        'settings' => [
            'icon_label' => 'Icon',
        ],
    ],

    'header-user' => [
        'name' => 'User Menu',
        'description' => 'User account menu with sign in/sign up options',
        'settings' => [
            'icon_label' => 'Icon',
            'guest_heading_label' => 'Heading shown to guest users',
            'guest_description_label' => 'Description shown to guest users',
            'guest_heading_default' => 'Welcome Guest',
            'guest_description_default' => 'Manage Cart, Orders & Wishlist',
        ],
    ],

    'header-cart' => [
        'name' => 'Cart Preview',
        'description' => 'Shopping cart icon with mini cart preview',
        'settings' => [
            'heading_label' => 'Heading',
            'heading_default' => 'Shopping Cart',
            'description_label' => 'Description',
            'description_default' => 'Get Up To 30% OFF on your 1st order',
        ],
    ],

    'feature-icon' => [
        'name' => 'Feature Icon',
        'defaults' => [
            'title' => 'Feature Title',
            'description' => 'Feature description goes here',
        ],
    ],

];
