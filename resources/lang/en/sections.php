<?php

return [
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

    'hero-banner' => [
        'name' => 'Hero Banner',
        'description' => 'A full-width banner with text and call-to-action buttons.',

        'settings' => [
            'scheme_label'           => 'Color Scheme',
            'background_label'       => 'Background Image',
            'overlay_label'          => 'Show Overlay',
            'overlay_opacity_label'  => 'Overlay Opacity (%)',
            'height_label'           => 'Banner Height',
            'scheme_note' => 'This overrides the global theme color scheme. Changes to the main theme scheme will not affect this section.'
        ],

        'blocks' => [
            'heading' => [
                'name'          => 'Heading',
                'text_label'    => 'Heading Text',
                'default_text'  => 'Welcome to our store',
            ],
            'subtext' => [
                'name'          => 'Subtext',
                'text_label'    => 'Subtext',
                'default_text'  => 'Discover our best products and offers.',
            ],
            'button' => [
                'name'          => 'Button',
                'text_label'    => 'Button Text',
                'default_text'  => 'View collections',
                'link_label'    => 'Button Link',
                'color_label'   => 'Variant'
            ],
        ],
    ],

    'header' => [
        'name' => 'Header',
        'description' => '',
        'blocks' => [
            'logo' => [
                'name' => 'Name/Logo',
                'settings' => [
                    'logo_image_label' => 'Upload Logo',
                    'logo_text_label' => 'Logo Text',
                    'mobile_logo_image_label' => 'Mobile logo',
                    'logo_text_placeholder' => 'Displayed when no logo image is set',
                    'push_to_left' => 'Push this element to the start',
                    'push_to_right' => 'Push this element to the end'
                ],
            ],
            'nav' => [
                'name' => 'Navigation',
                'settings' => [
                    'push_to_left' => 'Push this element to the start',
                    'push_to_right' => 'Push this element to the end'
                ]
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
        'description' => 'The bottom section of your website with links and branding.',

        'settings' => [
            'heading_label' => 'Heading',
            'heading_default' => 'My Store',

            'description_label' => 'Description',
            'description_default' => 'Add a description of your store here',

            'show_social_links_label' => 'Show social links',
            'show_social_links_info' => 'You can configure links in theme settings',
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
        'description' => 'Display a grid of selected categories with images and links.',
        'settings' => [
            'heading_label'         => 'Heading',
            'heading_default'       => 'Shop by Category',

            'heading_size_label'    => 'Heading Size',
            'size_small_label'      => 'Small',
            'size_medium_label'     => 'Medium',
            'size_large_label'      => 'Large',

            'columns_desktop_label' => 'Columns (Desktop)',
            'columns_mobile_label'  => 'Columns (Mobile)',
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

    'featured-products' => [
        'name' => 'Featured Products',
        'description' => 'Show handpicked or automatically loaded products like featured or new.',

        'settings' => [
            'heading_label' => 'Heading',
            'heading_default' => 'Featured Products',

            'subheading_label' => 'Subheading',
            'subheading_default' => 'Check out our latest products',

            'nb_products_label' => 'Number of Products to show',
            'nb_products_info' => 'Only used when no product block is added',
            'product_type_label' => 'Product Type',
            'product_type_info' => 'Only used when no product block is added',

            'new_label'             => 'New Products',
            'featured_label'        => 'Featured Products',
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

    'product-details' => [
        'name' => 'Product Details',
        'description' => 'Displays product info using individual blocks: title, price, description, cart.',

        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right',
            'position_under_gallery' => 'Under images gallery',
        ],

        'blocks' => [
            'text' => [
                'name' => 'Text',
                'settings' => [
                    'text_label' => 'Text',
                ],
            ],
            'title' => [
                'name' => 'Title',
                'settings' => [
                    'title_tag_label' => 'Title tag',
                    'title_size' => 'Title size'
                ]
            ],
            'price' => [
                'name' => 'Price',
            ],
            'rating' => [
                'name' => 'Rating',
            ],
            'short-description' => [
                'name' => 'Short description',
            ],
            'quantity-selector' => [
                'name' => 'Quantity selector',
            ],
            'buy-buttons' => [
                'name' => 'Buy buttons',
                'settings' => [
                    'enable_buy_now_label' => 'Show buy now button',
                    'enable_buy_now_info' => 'Enable this option to display a \'Buy Now\' button, allowing customers to proceed directly to checkout for a faster purchasing experience.',
                ],
            ],
            'description' => [
                'name' => 'Product description',
                'settings' => [
                    'show_in_panel_label' => 'Show in collapsible panel',
                    'should_open_panel_label' => 'Open the panel by default'
                ]
            ],
            'collapsible' => [
                'name' => 'Collapsible panel',
                'settings' => [
                    'icon_label' => 'Icon',
                    'heading_label' => 'Heading',
                    'content_label' => 'Content of the panel',
                    'should_open_panel_label' => 'Open the panel by default'
                ]
            ],
            'separator' => [
                'name' => 'Separator',
            ],
            'variant-picker' => [
                'name' => 'Variant Picker',
            ],
            'grouped-options' => [
                'name' => 'Grouped product options',
            ],
            'bundle-options' => [
                'name' => 'Product bundle options',
            ],
            'downloadable-options' => [
                'name' => 'Downloadable products options',
            ],
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

    'text-with-image' => [
        'name'        => 'Text with Image',
        'description' => 'Show text content alongside an image with configurable layout.',

        'settings' => [
            'image_label'           => 'Image',
            'image_position_label'  => 'Image Position',
            'left_label'            => 'Image first',
            'right_label'           => 'Image second',

            'image_height_label'    => 'Image Height',
            'image_height_auto'     => 'Adapt to Image',
            'image_height_sm'       => 'Small',
            'image_height_md'       => 'Medium',
            'image_height_lg'       => 'Large',

            'image_width_label'     => 'Image Width (Desktop)',
            'width_sm'              => 'Small',
            'width_md'              => 'Medium',
            'width_lg'              => 'Large',

            'content_position_label'    => 'Content Position (Vertical)',
            'position_top'              => 'Top',
            'position_middle'           => 'Middle',
            'position_bottom'           => 'Bottom',

            'content_align_label'       => 'Content Alignment (Desktop)',
            'content_align_mobile_label' => 'Content Alignment (Mobile)',
            'align_start'               => 'Start',
            'align_center'              => 'Center',
            'align_end'                 => 'End',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'Heading',
                'settings' => [
                    'text_label' => 'Heading Text',
                    'text_default' => 'Image with text'
                ],
            ],
            'body' => [
                'label' => 'Body Text',
                'settings' => [
                    'content_label' => 'Paragraph Text',
                    'content_default' => 'Pair text with an image to focus on your chosen product, collection, or blog post. Add details on availability, style, or even provide a review'
                ],
            ],
            'button' => [
                'label' => 'Button',
                'settings' => [
                    'text_label' => 'Button Text',
                    'url_label'  => 'Button URL',
                    'text_default' => 'Button Text',
                    'variant_label'        => 'Button Variant',

                    'variant_primary'      => 'Primary',
                    'variant_secondary'    => 'Secondary',
                    'variant_accent'       => 'Accent',
                    'variant_neutral'      => 'Neutral',

                    'style_label'          => 'Button Style',
                    'style_solid'          => 'Solid',
                    'style_soft'           => 'Soft',
                    'style_outline'        => 'Outline',
                    'style_ghost'          => 'Ghost',
                ],
            ],
        ],
    ],

    'collage' => [
        'name'        => 'Collage',
        'description' => 'Flexible layout to mix images, products, and categories.',

        'settings' => [
            'heading_label'        => 'Heading',
            'heading_size_label'   => 'Heading Size (px)',
        ],

        'blocks' => [
            'image' => [
                'label' => 'Image',
                'settings' => [
                    'image_label' => 'Image',
                ],
            ],
            'product' => [
                'label' => 'Product',
                'settings' => [
                    'product_label' => 'Product',
                ],
            ],
            'custom' => [
                'label' => 'Custom Content',
                'settings' => [
                    'image_label' => 'Image',
                    'title_label' => 'Title',
                    'text_label'  => 'Description',
                    'link_label'  => 'Link',
                    'link_text_label' => 'Link text'
                ],
            ],
            'category' => [
                'label' => 'Category',
                'settings' => [
                    'category_label' => 'Select Category',
                ],
            ],
        ],
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
        'description' => 'Displays a summary of the customer’s cart, including products, quantities, prices, and actions like updating or removing items.',
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
        'description' => 'Displays products or content matching the user’s search query, with support for filtering and pagination.',
    ],

    'cms-page' => [
        'name' => 'CMS Page',
        'description' => 'Renders the content of a CMS page, allowing static or dynamic text and media to be displayed within a section layout.',
    ],

    'error-page' => [
        'name' => 'Error Page',
        'description' => 'Displays a styled error message (e.g. 404 or 500) with optional navigation links or search to help users recover.',
    ],

    'feature-icons' => [
        'name' => 'Feature Icons',
        'description' => 'Display a row of icons with titles and short descriptions.',

        'settings' => [
            'heading_label'     => 'Section Heading',
            'description_label' => 'Section Description',
            'icon_size_label'   => 'Icon Size (px)',
            'columns_label'     => 'Columns on Desktop',
            'layout_label'      => 'Layout',
            'layout_horizontal' => 'Icon Left, Text Right',
            'layout_vertical'   => 'Icon Top, Text Below',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'Feature',
                'settings' => [
                    'icon_label'  => 'Icon',
                    'title_label' => 'Title',
                    'text_label'  => 'Description',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'Heading',
            'text'  => 'Some followup text to build on the feature',
        ],
    ],

];
