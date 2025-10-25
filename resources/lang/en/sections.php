<?php

return [
    'common' => [
        'color_scheme_label' => 'Color Scheme',
        'color_scheme_info' => 'Override the global theme color scheme for this section',
    ],

    'admin-topbar' => [
        'name' => 'Admin Top Bar',
        'description' => 'Displays a topbar with a link to the admin panel. Useful for admin-accessible storefronts.',

        'settings' => [
            'text_label' => 'Link Text',
            'url_label'  => 'Link URL',
        ],
    ],

    'announcement-bar' => [
        'name' => 'Announcement Bar',
        'description' => 'A simple announcement bar to display important information to your customers.',
        'settings' => [
            'text_label'      => 'Announcement Text',
            'default_text'    => 'Free shipping on orders over $50',
            'link_label'      => 'Link',
            'variant_label'   => 'Background Variant',

            'scheme_label'    => 'Color Scheme',
            'scheme_note'     => 'This overrides the global theme color scheme. Changes to the main theme scheme will not affect this section.'
        ],
    ],

    'header' => [
        'name' => 'Header',
        'description' => 'Main site header with logo, navigation, and utility elements',
        'settings' => [
            'content_width_label' => 'Content Width',
            'content_width_container' => 'Container',
            'content_width_fullwidth' => 'Full Width',
        ],
        'presets' => [
            'default' => [
                'name' => 'Header',
            ],
        ],
        'blocks' => [
            'logo' => [
                'name' => 'Name/Logo',
                'settings' => [
                    'logo_image_label' => 'Upload Logo',
                    'logo_text_label' => 'Logo Text',
                    'mobile_logo_image_label' => 'Mobile logo',
                    'logo_text_placeholder' => 'Displayed when no logo image is set',
                ],
            ],
            'nav' => [
                'name' => 'Navigation',
                'settings' => []
            ],
            'currency' => [
                'name' => 'Currency selector',
            ],
            'locale' => [
                'name' => 'Language selector',
                'settings' => [
                    'icon_label' => 'Icon'
                ]
            ],
            'search' => [
                'name' => 'Search form',
                'placeholder' => 'Search products here',
                'settings' => [
                    'search_icon_label' => 'Search icon',
                    'image_search_icon_label' => 'Image search icon'
                ]
            ],
            'compare' => [
                'name' => 'Compare',
                'settings' => [
                    'icon_label' => 'Icon'
                ]
            ],
            'user' => [
                'name' => 'User menu',
                'sign-in' => 'Sign In',
                'sign-up' => 'Sign Up',
                'settings' => [
                    'icon_label' => 'Icon',
                    'guest_heading_label' => 'Heading shown to guest users',
                    'guest_description_label' => 'Description shown to guest users',
                    'guest_heading_default' => 'Welcome Guest',
                    'guest_description_default' => 'Manage Cart, Orders & Wishlist',
                ]
            ],
            'cart' => [
                'name' => 'Cart preview',
                'settings' => [
                    'heading_label' => 'Heading',
                    'description_label' => 'Description',
                    'description_default' => 'Get Up To 30% OFF on your 1st order'
                ]
            ],
        ],
    ],

    'footer' => [
        'name' => 'Footer',
        'description' => 'Flexible footer section that accepts any blocks for complete customization.',

        'settings' => [
            'layout_header' => 'Layout',

            'content_width_label' => 'Content Width',
            'content_width_options' => [
                'full' => 'Full Width',
                'container' => 'Container',
            ],
            'content_width_info' => 'Choose whether footer content should be constrained to a container or span full width',

            'spacing_header' => 'Spacing',

            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',

            'appearance_header' => 'Appearance',

            'color_scheme_label' => 'Color Scheme',
            'color_scheme_info' => 'Override the global theme color scheme for this section',
        ],

        'presets' => [
            'classic' => [
                'name' => 'Classic Footer',
                'brand_title' => 'My Store',
                'brand_description' => 'Add a description of your store here. Tell your customers about your mission, values, and what makes your products special.',
                'company_title' => 'Company',
                'policy_title' => 'Policy',
                'account_title' => 'Account',
            ],

            'minimal' => [
                'name' => 'Minimal Centered Footer',
                'tagline' => 'Your trusted e-commerce partner',
            ],

            'newsletter' => [
                'name' => 'Newsletter Footer',
                'heading' => 'Stay in the loop',
                'description' => 'Subscribe to our newsletter for exclusive offers and updates.',
            ],
        ],

        'blocks' => [
            'group' => [
                'name' => 'Links group',
                'settings' => [
                    'title_label' => 'Group name',
                    'title_default' => 'Links group',
                ],
            ],
            'link' => [
                'name' => 'Link',
                'settings' => [
                    'text_label' => 'Link Text ',
                    'text_default' => 'Link',

                    'link_label' => 'Link',
                ],
            ],
        ],
    ],

    'hero' => [
        'name' => 'Hero',
        'description' => '',
        'settings' => [
            'image_label' => 'Image',
            'height_label' => 'Height',
            'height_small' => 'Small',
            'height_medium' => 'Medium',
            'height_large' => 'Large',
            'header_content' => 'Content',
            'content_position_label' => 'Content position',
            'content_position_top' => 'Top',
            'content_position_middle' => 'Middle',
            'content_position_bottom' => 'Bottom',
            'show_overlay_label' => 'Show overlay',
            'overlay_opacity_label' => 'Overlay opacity',
        ],
        'blocks' => [
            'heading' => [
                'name' => 'Heading',
                'settings' => [
                    'heading_label' => 'Heading',
                    'heading_default' => 'Hero heading',
                    'heading_size_label' => 'Heading size',
                    'heading_size_small' => 'Small',
                    'heading_size_medium' => 'Medium',
                    'heading_size_large' => 'Large',
                ],
            ],
            'subheading' => [
                'name' => 'Subheading',
                'settings' => [
                    'subheading_label' => 'Subheading',
                    'subheading_default' => 'Hero Subheading',
                ],
            ],
            'button' => [
                'name' => 'Call to action',
                'settings' => [
                    'text_label' => 'Button text',
                    'text_default' => 'Shop now',
                    'link_label' => 'Button Link',
                ],
            ],
        ],
    ],

    'category-list' => [
        'name' => 'Category List',
        'description' => 'Display categories in a responsive grid or carousel layout.',
        'settings' => [
            'heading_default'       => 'Shop by category',

            'parent_category_label' => 'Parent Category',
            'parent_category_info'  => 'Select a parent category to display its children. Leave empty to show manually added categories.',

            'layout_header'         => 'Layout',
            'layout_type_label'     => 'Layout Type',
            'layout_type_options'   => [
                'grid'     => 'Grid',
                'carousel' => 'Carousel',
            ],
            'columns_label'         => 'Columns',
            'gap_label'             => 'Gap',
            'gap_info'              => 'Space between items (0-24, where 4 = 1rem)',

            'carousel_nav_header'   => 'Carousel Navigation',
            'nav_style_label'       => 'Navigation Style',
            'nav_style_options'     => [
                'arrow'   => 'Arrow',
                'chevron' => 'Chevron',
                'none'    => 'None',
            ],
            'nav_shape_label'       => 'Navigation Shape',
            'nav_shape_options'     => [
                'none'   => 'None',
                'circle' => 'Circle',
                'square' => 'Square',
            ],

            'appearance_header'       => 'Appearance',

            'content_width_label'     => 'Content Width',
            'content_width_options'   => [
                'container' => 'Container',
                'full'      => 'Full Width',
            ],

            'padding_header'          => 'Padding',
            'padding_top_label'     => 'Padding Top',
            'padding_bottom_label'  => 'Padding Bottom',
        ],
        'presets' => [
            'grid' => [
                'name' => 'Category Grid',
                'heading' => 'Shop by Category',
            ],
        ],
        'blocks' => [
            'category' => [
                'name' => 'Category',
                'settings' => [
                    'category_label' => 'Category',
                ],
            ],
        ],
    ],

    'product-list' => [
        'name' => 'Product List',
        'description' => 'Display a list of products from a category, or filter by product type (featured, new).',

        'settings' => [
            'parent_category_label' => 'Parent Category',
            'parent_category_info' => 'Filter products by category. Leave empty to show products from all categories.',

            'product_type_label' => 'Product Type',
            'product_type_info' => 'Only used when no product blocks are added and no parent category is selected',
            'new_label'             => 'New Products',
            'featured_label'        => 'Featured Products',

            'nb_products_label' => 'Number of Products',
            'nb_products_info' => 'Maximum number of products to display',

            'layout_header' => 'Layout',
            'layout_type_label' => 'Layout Type',
            'layout_type_options' => [
                'grid' => 'Grid',
                'carousel' => 'Carousel',
            ],

            'columns_label' => 'Columns',
            'gap_label' => 'Gap',
            'gap_info' => 'Space between products',

            'content_width_label' => 'Content Width',
            'content_width_options' => [
                'container' => 'Container',
                'full' => 'Full Width',
            ],

            'carousel_nav_header' => 'Carousel Navigation',
            'nav_style_label' => 'Navigation Style',
            'nav_style_options' => [
                'arrow' => 'Arrows',
                'dot' => 'Dots',
                'both' => 'Both',
                'none' => 'None',
            ],
            'nav_shape_label' => 'Navigation Shape',
            'nav_shape_options' => [
                'circle' => 'Circle',
                'square' => 'Square',
                'none' => 'None',
            ],

            'spacing_header' => 'Spacing',
            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',

            'appearance_header' => 'Appearance',
            'color_scheme_label' => 'Color Scheme',
        ],

        'blocks' => [
            'product' => [
                'name' => 'Product',
                'settings' => [
                    'product_label' => 'Product',
                    'product_info' => 'Select a product to display',
                ],
            ],
        ],
    ],

    'newsletter' => [
        'name'        => 'Newsletter Signup',
        'description' => 'Let customers subscribe for updates and promotions.',

        'settings' => [
            'heading_label' => 'Heading',
            'heading_default' => 'Sign up for our newsletter',

            'description_label' => 'Description',
            'description_default' => 'Use this text to share information about your brand with your customers. Describe a product, share announcements, or welcome customers to your store.',

            'scheme_label'    => 'Color Scheme',
            'scheme_note'     => 'This overrides the global theme color scheme. Changes to the main theme scheme will not affect this section.'
        ],
    ],

    'product-information' => [
        'name' => 'Product Information',
        'description' => 'Display product media gallery and details in a flexible grid layout.',

        'settings' => [
            'section_width_label' => 'Section Width',
            'section_width_options' => [
                'container' => 'Container',
                'full_width' => 'Full Width',
            ],

            'layout_header' => 'Layout',
            'media_position_label' => 'Media Position',
            'media_position_options' => [
                'left' => 'Left',
                'right' => 'Right',
            ],
            'equal_columns_label' => 'Equal Columns',
            'equal_columns_info' => 'Make media and details columns equal width (50/50 instead of 2:1 ratio)',
            'gap_label' => 'Gap',
            'gap_info' => 'Space between media and details columns',

            'appearance_header' => 'Appearance',

            'padding_header' => 'Padding',
            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',
        ],
    ],

    'category-page' => [
        'name'        => 'Category Products',
        'description' => 'Displays products for the current category with filtering and sorting.',

        'settings' => [
            'heading_label'         => 'Custom Heading (optional)',
            'columns_label'         => 'Grid Columns (Desktop)',
            'columns_tablet_label'  => 'Grid Columns (Tablet)',
            'columns_mobile_label'  => 'Grid Columns (Mobile)',
            'filters_label'         => 'Show Filters',
            'sorting_label'         => 'Show Sorting',
            'banner_label'          => 'Show Category Banner',
        ],
    ],

    'product-reviews' => [
        'name'        => 'Product Reviews',
        'description' => 'Shows recent customer reviews for the current product.',

        'settings' => [
            'rating_summary_label' => 'Show Rating Summary',
            'reviews_label'        => 'Show Individual Reviews',
            'limit_label'          => 'Number of Reviews to Show',
        ],

        'average_rating' => 'Average Rating',
        'no_reviews'     => 'No reviews yet.',
    ],

    'contact-form' => [
        'name'        => 'Contact Form',
        'description' => 'Simple section with name, email, and message form.',

        'success_message' => 'Thank you! Your message has been sent.',
    ],

    'breadcrumbs' => [
        'name' => 'Breadcrumbs',
        'description' => 'Shows a breadcrumb trail for navigation.',
        'settings' => [
            'separator_label' => 'Separator character',
        ],
    ],

    'cart-content' => [
        'name' => 'Cart Content',
        'description' => 'Displays a summary of the customer\'s cart, including products, quantities, prices, and actions like updating or removing items.',
    ],

    'checkout' => [
        'name' => 'Checkout',
        'description' => 'A complete checkout layout including billing details, cart summary, coupon input, and total calculation.',
    ],

    'checkout-success' => [
        'name' => 'Checkout Success',
        'description' => 'Displays an order confirmation message with summary details after a successful checkout.',
    ],

    'search-result' => [
        'name' => 'Search Results',
        'description' => 'Displays products or content matching the user\'s search query, with support for filtering and pagination.',
    ],

    'compare' => [
        'name' => 'Compare Products',
        'description' => 'Displays a comparison table of selected products with their attributes and features.',
    ],

    'wishlist' => [
        'name' => 'Wishlist',
        'description' => 'Displays the customer\'s saved wishlist items with options to add to cart or remove.',
    ],

    'cms-page' => [
        'name' => 'CMS Page',
        'description' => 'Renders the content of a CMS page, allowing static or dynamic text and media to be displayed within a section layout.',
    ],

    'error-page' => [
        'name' => 'Error Page',
        'description' => 'Displays a styled error message (e.g. 404 or 500) with optional navigation links or search to help users recover.',
    ],

    'flex-section' => [
        'name' => 'Flexible Section',
        'description' => 'A universal section that accepts any block type with comprehensive layout, sizing, and styling controls.',

        'empty_state' => 'Add blocks to get started',

        'presets' => [
            'custom_section' => [
                'name' => 'Custom Section',
                'category' => 'Layout',
            ],
            'rich_text' => [
                'name' => 'Rich Text Section',
                'category' => 'Content',
            ],
            'faq' => [
                'name' => 'FAQ Section',
                'category' => 'Content',
            ],
            'image_with_text' => [
                'name' => 'Image with Text',
                'category' => 'Content',
            ],
            'hero_banner' => [
                'name' => 'Hero Banner',
                'category' => 'Content',
            ],
            'feature_icons' => [
                'name' => 'Feature Icons',
            ],
        ],

        'settings' => [
            'layout_header' => 'Layout',

            'flex_direction_label' => 'Flex Direction',
            'flex_direction_info' => 'Direction of the content flow',
            'flex_direction_options' => [
                'row' => 'Horizontal',
                'row_reverse' => 'Horizontal (Reversed)',
                'column' => 'Vertical',
                'column_reverse' => 'Vertical (Reversed)',
            ],

            'justify_content_label' => 'Justify Content',
            'justify_content_options' => [
                'start' => 'Start',
                'center' => 'Center',
                'end' => 'End',
                'between' => 'Space Between',
                'around' => 'Space Around',
                'evenly' => 'Space Evenly',
            ],

            'align_items_label' => 'Align Items',
            'align_items_options' => [
                'start' => 'Start',
                'center' => 'Center',
                'end' => 'End',
                'stretch' => 'Stretch',
                'baseline' => 'Baseline',
            ],

            'gap_label' => 'Gap Between Items',
            'gap_info' => 'Space between child blocks',

            'size_header' => 'Size',

            'section_width_label' => 'Content Width',
            'section_width_options' => [
                'full' => 'Full Width',
                'container' => 'Container',
            ],

            'section_height_label' => 'Section Height',
            'section_height_options' => [
                'auto' => 'Auto',
                'xs' => 'Extra Small (20rem)',
                'sm' => 'Small (25rem)',
                'md' => 'Medium (37.5rem)',
                'lg' => 'Large (50rem)',
                'screen' => 'Full Screen',
                'custom' => 'Custom',
            ],

            'section_height_custom_label' => 'Custom Height',

            'appearance_header' => 'Appearance',

            'color_scheme_label' => 'Color Scheme',

            'background_type_label' => 'Background Type',
            'background_type_options' => [
                'none' => 'None',
                'color' => 'Color',
                'gradient' => 'Gradient',
                'image' => 'Image',
            ],

            'background_color_label' => 'Background Color',

            'background_gradient_label' => 'Background Gradient',

            'background_image_label' => 'Background Image',

            'background_position_label' => 'Background Position',
            'background_position_options' => [
                'center' => 'Center',
                'top' => 'Top',
                'bottom' => 'Bottom',
                'left' => 'Left',
                'right' => 'Right',
            ],

            'background_size_label' => 'Background Size',
            'background_size_options' => [
                'cover' => 'Cover',
                'contain' => 'Contain',
                'auto' => 'Auto',
            ],

            'background_repeat_label' => 'Background Repeat',
            'background_repeat_options' => [
                'no_repeat' => 'No Repeat',
                'repeat' => 'Repeat',
                'repeat_x' => 'Repeat Horizontally',
                'repeat_y' => 'Repeat Vertically',
            ],

            'border_label' => 'Show Border',

            'border_width_label' => 'Border Width',

            'border_opacity_label' => 'Border Opacity',

            'border_radius_label' => 'Border Radius',
            'border_radius_options' => [
                'none' => 'None',
                'sm' => 'Small',
                'md' => 'Medium',
                'lg' => 'Large',
                'xl' => 'Extra Large',
                'full' => 'Full',
            ],

            'toggle_overlay_label' => 'Show Overlay',
            'toggle_overlay_info' => 'Add an overlay on top of background media',

            'overlay_color_label' => 'Overlay Color',
            'overlay_color_options' => [
                'black' => 'Black',
                'white' => 'White',
            ],

            'overlay_style_label' => 'Overlay Style',
            'overlay_style_options' => [
                'solid' => 'Solid',
                'gradient' => 'Gradient',
            ],

            'overlay_gradient_label' => 'Overlay Gradient',

            'spacing_header' => 'Spacing',

            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',
            'padding_left_label' => 'Padding Left',
            'padding_right_label' => 'Padding Right',
        ],
    ],

];
