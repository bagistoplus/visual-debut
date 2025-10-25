<?php

return [
    'common' => [
        'product_label' => 'Product',
        'color_scheme_label' => 'Color Scheme',
        'color_scheme_info' => 'Override section color scheme for this block',
    ],

    'product' => [
        'settings' => [
            'product_info' => 'Select a product to display',
        ],
    ],

    'divider' => [
        'settings' => [
            'thickness_label' => 'Thickness',
            'thickness_info' => 'Set the thickness of the divider line',

            'corner_radius_label' => 'Corner Radius',
            'corner_radius_options' => [
                'square' => 'Square',
                'rounded' => 'Rounded',
            ],

            'width_percent_label' => 'Length',
            'width_percent_info' => 'Set the width of the divider as a percentage',

            'alignment_label' => 'Alignment',
            'alignment_info' => 'Horizontal alignment of the divider',
            'alignment_options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],

            'padding_header' => 'Padding',
            'padding_top_label' => 'Top',
            'padding_bottom_label' => 'Bottom',
        ],
    ],

    'richtext' => [
        'settings' => [
            'content_label' => 'Content',

            'layout_header' => 'Layout',

            'width_label' => 'Width',
            'width_options' => [
                'fit' => 'Fit Content',
                'fill' => 'Fill',
            ],

            'max_width_label' => 'Max Width',
            'max_width_options' => [
                'narrow' => 'Narrow (Prose)',
                'normal' => 'Normal',
                'wide' => 'Wide',
                'none' => 'None',
            ],

            'alignment_label' => 'Alignment',
            'alignment_options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],

            'padding_header' => 'Padding',
            'padding_top_label' => 'Top',
            'padding_bottom_label' => 'Bottom',
            'padding_left_label' => 'Left',
            'padding_right_label' => 'Right',
        ],
    ],

    'text' => [
        'settings' => [
            'text_label' => 'Text Content',

            'layout_header' => 'Layout',

            'width_label' => 'Width',
            'width_options' => [
                'fit' => 'Fit Content',
                'fill' => 'Fill',
            ],

            'max_width_label' => 'Max Width',
            'max_width_options' => [
                'narrow' => 'Narrow',
                'normal' => 'Normal',
                'none' => 'None',
            ],

            'alignment_label' => 'Alignment',
            'alignment_options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],

            'typography_header' => 'Typography',

            'type_preset_label' => 'Type Preset',
            'type_preset_info' => 'Apply predefined text styles',
            'type_preset_options' => [
                'paragraph' => 'Paragraph',
                'h1' => 'Heading 1',
                'h2' => 'Heading 2',
                'h3' => 'Heading 3',
                'h4' => 'Heading 4',
                'h5' => 'Heading 5',
                'h6' => 'Heading 6',
                'custom' => 'Custom',
            ],

            'font_label' => 'Font Family',
            'font_options' => [
                'body' => 'Body',
                'subheading' => 'Subheading',
                'heading' => 'Heading',
                'accent' => 'Accent',
            ],

            'font_size_label' => 'Font Size',
            'font_size_options' => [
                'default' => 'Default',
            ],

            'line_height_label' => 'Line Height',
            'line_height_options' => [
                'tight' => 'Tight',
                'normal' => 'Normal',
                'loose' => 'Loose',
            ],

            'letter_spacing_label' => 'Letter Spacing',
            'letter_spacing_options' => [
                'tight' => 'Tight',
                'normal' => 'Normal',
                'loose' => 'Loose',
            ],

            'case_label' => 'Text Case',
            'case_options' => [
                'none' => 'Default',
                'uppercase' => 'Uppercase',
            ],

            'wrap_label' => 'Text Wrap',
            'wrap_options' => [
                'pretty' => 'Pretty',
                'balance' => 'Balance',
                'nowrap' => 'No Wrap',
            ],

            'color_label' => 'Text Color',
            'color_options' => [
                'default' => 'Default',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'accent' => 'Accent',
                'info' => 'Info',
                'success' => 'Success',
                'warning' => 'Warning',
                'danger' => 'Danger',
                'custom' => 'Custom',
            ],

            'text_color_label' => 'Custom Color',

            'appearance_header' => 'Appearance',

            'padding_header' => 'Padding',

            'padding_top_label' => 'Top',
            'padding_bottom_label' => 'Bottom',
            'padding_left_label' => 'Left',
            'padding_right_label' => 'Right',
        ],

        'presets' => [
            'text' => [
                'name' => 'Text',
                'category' => 'Text',
            ],
            'heading' => [
                'name' => 'Heading',
                'category' => 'Text',
            ],
        ],
    ],

    'icon' => [
        'settings' => [
            'icon_label' => 'Icon',

            'size_label' => 'Size',

            'color_label' => 'Color',
            'color_options' => [
                'default' => 'Default',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'accent' => 'Accent',
                'info' => 'Info',
                'success' => 'Success',
                'warning' => 'Warning',
                'danger' => 'Danger',
                'custom' => 'Custom',
            ],

            'custom_color_label' => 'Custom Color',
        ],
    ],

    'button' => [
        'settings' => [
            'label_label' => 'Button Label',
            'label_default' => 'Button',

            'link_label' => 'Link URL',

            'open_in_new_tab_label' => 'Open in New Tab',

            'style_class_label' => 'Button Style',
            'style_class_options' => [
                'button' => 'Solid',
                'outline' => 'Outline',
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
            'icon_info' => 'Add an icon to the button',

            'circle_label' => 'Circle Button',
            'circle_info' => 'Make the button circular (icon-only)',

            'square_label' => 'Square Button',
            'square_info' => 'Make the button square (icon-only)',

            'block_label' => 'Full Width',
            'block_info' => 'Make the button span the full width of its container',

            'width_label' => 'Width (Desktop)',
            'width_options' => [
                'fit_content' => 'Fit Content',
                'custom' => 'Custom',
            ],

            'custom_width_label' => 'Custom Width',

            'width_mobile_label' => 'Width (Mobile)',
            'width_mobile_options' => [
                'fit_content' => 'Fit Content',
                'custom' => 'Custom',
            ],

            'custom_width_mobile_label' => 'Custom Mobile Width',
        ],

        'presets' => [
            'button' => [
                'name' => 'Button',
                'category' => 'Actions',
            ],
        ],
    ],

    'link' => [
        'settings' => [
            'text_label' => 'Link Text',
            'url_label' => 'URL',
            'open_in_new_tab_label' => 'Open in New Tab',

            'typography_header' => 'Typography',

            'type_preset_label' => 'Type Preset',
            'type_preset_info' => 'Apply predefined text styles',
            'type_preset_options' => [
                'paragraph' => 'Paragraph',
                'h1' => 'Heading 1',
                'h2' => 'Heading 2',
                'h3' => 'Heading 3',
                'h4' => 'Heading 4',
                'h5' => 'Heading 5',
                'h6' => 'Heading 6',
                'custom' => 'Custom',
            ],

            'font_size_label' => 'Font Size',
            'font_weight_label' => 'Font Weight',
            'font_weight_options' => [
                'normal' => 'Normal',
                'medium' => 'Medium',
                'semibold' => 'Semi Bold',
                'bold' => 'Bold',
            ],

            'appearance_header' => 'Appearance',

            'underline_label' => 'Underline',
            'underline_options' => [
                'none' => 'None',
                'hover' => 'On Hover',
                'always' => 'Always',
            ],

            'spacing_header' => 'Spacing',

            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',
        ],

        'presets' => [
            'link' => [
                'name' => 'Link',
                'category' => 'Basic',
            ],
        ],
    ],

    'heading' => [
        'text_label' => 'Heading Text',
        'default_text' => 'Welcome to our store',
        'heading_level_label' => 'Heading Level',
    ],

    'category' => [
        'settings' => [
            'category_label' => 'Category',
        ],
    ],

    'category-card' => [
        'settings' => [
            'category_label' => 'Category',
        ],
        'presets' => [
            'overlay' => [
                'name' => 'Category Card with Overlay',
            ],
            'vertical_overlay' => [
                'name' => 'Vertical with Overlay',
                'category' => 'Category',
            ],
            'vertical_below' => [
                'name' => 'Vertical with Name Below',
                'category' => 'Category',
            ],
            'simple_hover' => [
                'name' => 'Simple Hover',
                'category' => 'Category',
            ],
        ],
    ],

    'category-image' => [
        'settings' => [
            'category_label' => 'Category',
            'image_source_label' => 'Image Source',
            'image_source_options' => [
                'banner' => 'Banner Image',
                'logo' => 'Logo Image',
            ],
            'image_source_info' => 'Choose which category image to display',
            'aspect_ratio_label' => 'Aspect Ratio',
            'aspect_ratio_options' => [
                'adapt' => 'Adapt to Image',
                'square' => 'Square (1:1)',
                'portrait' => 'Portrait (3:4)',
                'landscape' => 'Landscape (4:3)',
            ],
            'object_fit_label' => 'Object Fit',
            'object_fit_options' => [
                'cover' => 'Cover',
                'contain' => 'Contain',
            ],
        ],
    ],

    'category-name' => [
        'settings' => [
            'category_label' => 'Category',
            'tag_label' => 'HTML Tag',
            'alignment_label' => 'Alignment',
            'alignment_options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'text_color_label' => 'Text Color',
        ],
    ],

    'feature' => [
        'icon_label' => 'Icon',
        'title_label' => 'Title',
        'text_label' => 'Description',
    ],

    'featured-product' => [
        'product_label' => 'Product',
        'product_info' => 'Select a product to display',
    ],

    'footer-group' => [
        'title_label' => 'Group Name',
        'title_default' => 'Links Group',
    ],

    'footer-link' => [
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
        'settings' => [
            'icon_label' => 'Icon Style',
            'icon_options' => [
                'caret' => 'Caret',
                'plus' => 'Plus',
            ],

            'dividers_label' => 'Show Dividers',

            'type_preset_label' => 'Heading Preset',
            'type_preset_info' => 'Typography preset for accordion headings',
            'type_preset_options' => [
                'default' => 'Default',
                'paragraph' => 'Paragraph',
                'h1' => 'Heading 1',
                'h2' => 'Heading 2',
                'h3' => 'Heading 3',
                'h4' => 'Heading 4',
                'h5' => 'Heading 5',
                'h6' => 'Heading 6',
            ],

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

            'padding_header' => 'Padding',

            'padding_top_label' => 'Top',
            'padding_bottom_label' => 'Bottom',
            'padding_left_label' => 'Left',
            'padding_right_label' => 'Right',
        ],

        'presets' => [
            'accordion' => [
                'name' => 'Accordion',
                'category' => 'Layout',
            ],
        ],
    ],

    'accordion-row' => [
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

    'image' => [
        'settings' => [
            'image_label' => 'Image',
            'link_label' => 'Link',
            'alt_label' => 'Alt Text',
            'alt_info' => 'Descriptive text for accessibility and SEO',

            'size_header' => 'Size',
            'sizing_header' => 'Sizing',

            'image_ratio_label' => 'Image Ratio',
            'image_ratio_options' => [
                'adapt' => 'Adapt to Image',
                'portrait' => 'Portrait (3:4)',
                'square' => 'Square (1:1)',
                'landscape' => 'Landscape (4:3)',
            ],

            'aspect_ratio_label' => 'Aspect Ratio',
            'aspect_ratio_options' => [
                'adapt' => 'Adapt to Image',
                'square' => 'Square (1:1)',
                'portrait' => 'Portrait (3:4)',
                'landscape' => 'Landscape (4:3)',
            ],

            'object_fit_label' => 'Object Fit',
            'object_fit_options' => [
                'cover' => 'Cover',
                'contain' => 'Contain',
                'fill' => 'Fill',
            ],

            'width_label' => 'Width',
            'width_options' => [
                'fit_content' => 'Fit Content',
                'fill' => 'Fill',
                'custom' => 'Custom',
            ],

            'custom_width_label' => 'Custom Width (%)',

            'width_mobile_label' => 'Width (Mobile)',
            'width_mobile_options' => [
                'fit_content' => 'Fit Content',
                'fill' => 'Fill',
                'custom' => 'Custom',
            ],

            'custom_width_mobile_label' => 'Custom Width Mobile (%)',

            'height_label' => 'Height',
            'height_options' => [
                'fit' => 'Fit Content',
                'fill' => 'Fill',
            ],

            'hover_zoom_label' => 'Scale Image on Hover',
            'hover_zoom_info' => 'Zoom in the image when hovering over it',
            'hover_zoom_scale_label' => 'Scale Amount',

            'borders_header' => 'Borders',

            'border_label' => 'Border',
            'border_options' => [
                'none' => 'None',
                'solid' => 'Solid',
            ],
            'border_width_label' => 'Border Width',
            'border_opacity_label' => 'Border Opacity',
            'border_radius_label' => 'Border Radius',
            'border_radius_options' => [
                'none' => 'None',
                'sm' => 'Small',
                'md' => 'Medium',
                'lg' => 'Large',
                'xl' => 'Extra Large',
                '2xl' => '2X Large',
                '3xl' => '3X Large',
                'full' => 'Full',
            ],

            'padding_header' => 'Padding',

            'padding_top_label' => 'Top',
            'padding_bottom_label' => 'Bottom',
            'padding_left_label' => 'Left',
            'padding_right_label' => 'Right',
        ],

        'presets' => [
            'image' => [
                'name' => 'Image',
                'category' => 'Media',
            ],
        ],
    ],

    'group' => [
        'settings' => [
            'layout_header' => 'Layout',

            'content_direction_label' => 'Direction',
            'content_direction_options' => [
                'row' => 'Row',
                'column' => 'Column',
            ],

            'alignment_label' => 'Alignment',
            'alignment_options' => [
                'start' => 'Start',
                'center' => 'Center',
                'end' => 'End',
            ],

            'gap_label' => 'Gap',

            'size_header' => 'Size',

            'width_label' => 'Width',
            'width_options' => [
                'auto' => 'Auto',
                'full' => 'Full',
            ],

            'height_label' => 'Height',
            'height_options' => [
                'auto' => 'Auto',
                'full' => 'Full',
            ],

            'padding_header' => 'Padding',

            'padding_top_label' => 'Top',
            'padding_bottom_label' => 'Bottom',
            'padding_left_label' => 'Left',
            'padding_right_label' => 'Right',
        ],

        'presets' => [
            'empty_group' => [
                'name' => 'Empty Group',
                'category' => 'Layout',
            ],
            'two_columns' => [
                'name' => 'Two Columns',
                'category' => 'Layout',
            ],
        ],
    ],

    'product-media-gallery' => [
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
        'settings' => [
            'layout_header' => 'Layout',
            'gap_label' => 'Gap',
            'gap_info' => 'Space between child blocks',

            'sticky_label' => 'Sticky',
            'sticky_info' => 'Keep product details visible while scrolling',

            'spacing_header' => 'Spacing',
            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',
            'padding_left_label' => 'Padding Left',
            'padding_right_label' => 'Padding Right',
        ],
    ],

    'product-title' => [
        'settings' => [
            'tag_label' => 'Heading Tag',
            'size_label' => 'Title Size',
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-image' => [
        'settings' => [
            'size_label' => 'Image Size',
            'size_options' => [
                'small' => 'Small',
                'medium' => 'Medium',
                'large' => 'Large',
                'original' => 'Original',
            ],
            'size_info' => 'Select the size of the product image to display',

            'aspect_ratio_label' => 'Aspect Ratio',
            'aspect_ratio_options' => [
                'square' => 'Square (1:1)',
                'portrait' => 'Portrait (3:4)',
                'landscape' => 'Landscape (4:3)',
                'auto' => 'Auto',
            ],
            'aspect_ratio_info' => 'Set the aspect ratio of the image container',

            'object_fit_label' => 'Object Fit',
            'object_fit_options' => [
                'cover' => 'Cover',
                'contain' => 'Contain',
                'fill' => 'Fill',
            ],
            'object_fit_info' => 'How the image should fit within its container',
        ],
    ],

    'product-price' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-rating' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-short-description' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-quantity-selector' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-buy-buttons' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
            'enable_buy_now_label' => 'Enable Buy Now Button',
            'enable_buy_now_info' => 'Show a separate "Buy Now" button for quick checkout',
        ],
    ],

    'product-button' => [
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
            'block_info' => 'Make the button span the full width of its container',
        ],
        'placeholder' => [
            'cart' => 'Add to Cart',
            'wishlist' => 'Add to Wishlist',
            'compare' => 'Add to Compare',
        ],
        'wishlist_disabled' => 'Wishlist disabled',
        'compare_disabled' => 'Compare disabled',
    ],

    'product-labels' => [
        'settings' => [
            'layout_label' => 'Layout',
            'layout_options' => [
                'inline' => 'Inline',
                'stack' => 'Stack',
            ],
            'gap_label' => 'Gap',
            'alignment_label' => 'Alignment',
            'alignment_options' => [
                'start' => 'Start',
                'center' => 'Center',
                'end' => 'End',
            ],
            'size_label' => 'Size',
            'size_options' => [
                'xs' => 'Extra Small',
                'sm' => 'Small',
                'md' => 'Medium',
                'lg' => 'Large',
            ],
            'variant_label' => 'Variant',
            'variant_options' => [
                'solid' => 'Solid',
                'outline' => 'Outline',
                'soft' => 'Soft',
            ],
            'corner_radius_label' => 'Corner Radius',
            'corner_radius_options' => [
                'none' => 'None',
                'sm' => 'Small',
                'md' => 'Medium',
                'lg' => 'Large',
                'full' => 'Full',
            ],
        ],
        'placeholder' => 'No labels available',
    ],

    'product-card' => [
        'presets' => [
            'vertical' => [
                'name' => 'Vertical Card',
                'category' => 'Product Cards',
            ],
            'horizontal' => [
                'name' => 'Horizontal Card',
                'category' => 'Product Cards',
            ],
            'overlay' => [
                'name' => 'Card with Hover Overlay',
                'category' => 'Product Cards',
            ],
        ],
    ],

    'product-description' => [
        'settings' => [
            'show_in_panel_label' => 'Show in Accordion Panel',
            'should_open_panel_label' => 'Open Panel by Default',
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-variant-picker' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-grouped-options' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-bundle-options' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
    ],

    'product-downloadable-options' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Right Column',
            'position_under_gallery' => 'Under Gallery',
        ],
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
        ],
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
            'description_label' => 'Description',
            'description_default' => 'Get Up To 30% OFF on your 1st order',
        ],
    ],

    'container' => [
        'name' => 'Container',
        'description' => 'Versatile container for layout composition with flex, grid, spacing, sizing, and borders',
        'settings' => [
            // Layout
            'layout_header' => 'Layout',
            'layout_type_label' => 'Layout Type',
            'layout_type_info' => 'Choose how child blocks are arranged',
            'layout_type_options' => [
                'block' => 'Block',
                'flex' => 'Flexbox',
                'grid' => 'Grid',
            ],

            // Flex Settings
            'flex_direction_label' => 'Flex Direction',
            'flex_direction_options' => [
                'row' => 'Row',
                'row_reverse' => 'Row Reverse',
                'column' => 'Column',
                'column_reverse' => 'Column Reverse',
            ],
            'flex_wrap_label' => 'Flex Wrap',
            'flex_wrap_options' => [
                'nowrap' => 'No Wrap',
                'wrap' => 'Wrap',
                'wrap_reverse' => 'Wrap Reverse',
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

            // Grid Settings
            'grid_columns_label' => 'Grid Columns',
            'grid_rows_label' => 'Grid Rows',
            'grid_rows_options' => [
                'auto' => 'Auto',
            ],
            'gap_label' => 'Gap',

            // Spacing
            'spacing_header' => 'Spacing',
            'padding_top_label' => 'Padding Top',
            'padding_bottom_label' => 'Padding Bottom',
            'padding_left_label' => 'Padding Left',
            'padding_right_label' => 'Padding Right',
            'margin_top_label' => 'Margin Top',
            'margin_bottom_label' => 'Margin Bottom',
            'margin_left_label' => 'Margin Left',
            'margin_right_label' => 'Margin Right',

            // Sizing
            'sizing_header' => 'Sizing',
            'width_label' => 'Width',
            'width_options' => [
                'auto' => 'Auto',
                'full' => 'Full (100%)',
                'fit' => 'Fit Content',
                'screen' => 'Screen Width',
                'custom' => 'Custom',
            ],
            'custom_width_label' => 'Custom Width',
            'min_width_label' => 'Min Width',
            'max_width_label' => 'Max Width',
            'max_width_options' => [
                'none' => 'None',
                'full' => 'Full',
                'screen' => 'Screen',
            ],
            'height_label' => 'Height',
            'height_options' => [
                'auto' => 'Auto',
                'full' => 'Full (100%)',
                'fit' => 'Fit Content',
                'screen' => 'Screen Height',
                'custom' => 'Custom',
            ],
            'custom_height_label' => 'Custom Height',
            'min_height_label' => 'Min Height',

            // Borders
            'borders_header' => 'Borders',
            'border_label' => 'Enable Border',
            'border_width_label' => 'Border Width',
            'border_style_label' => 'Border Style',
            'border_style_options' => [
                'solid' => 'Solid',
                'dashed' => 'Dashed',
                'dotted' => 'Dotted',
            ],
            'border_color_label' => 'Border Color',
            'border_opacity_label' => 'Border Opacity',
            'border_radius_label' => 'Border Radius',
            'border_radius_options' => [
                'none' => 'None',
                'full' => 'Full (Pill)',
            ],

            // Background
            'background_header' => 'Background',
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
                'repeat_x' => 'Repeat X',
                'repeat_y' => 'Repeat Y',
            ],

            // Overlay
            'overlay_header' => 'Overlay',
            'is_overlay_label' => 'Position as Overlay',
            'is_overlay_info' => 'When enabled, this container will be positioned absolutely over its parent container',
            'overlay_visibility_label' => 'Overlay Visibility',
            'overlay_visibility_info' => 'Control when the overlay is visible',
            'overlay_visibility_options' => [
                'always' => 'Always Visible',
                'hover' => 'Show on Parent Hover',
            ],
            'overlay_hover_target_label' => 'Hover Target',
            'overlay_hover_target_info' => 'Choose which element\'s hover triggers the overlay visibility',
            'overlay_hover_target_options' => [
                'parent' => 'Immediate parent',
                'group' => 'Any ancestor',
                'product_card' => 'Product card',
            ],
            'z_index_label' => 'Z-Index',
            'position_label' => 'Position',
            'position_options' => [
                'static' => 'Static',
                'relative' => 'Relative',
                'absolute' => 'Absolute',
                'fixed' => 'Fixed',
            ],
        ],
        'presets' => [
            'basic' => [
                'name' => 'Container',
                'category' => 'Layout',
            ],
            'centered' => [
                'name' => 'Centered Container',
                'category' => 'Layout',
            ],
            'card' => [
                'name' => 'Card',
                'category' => 'Layout',
            ],
            'flex_row' => [
                'name' => 'Flex Row',
                'category' => 'Layout',
            ],
            'grid' => [
                'name' => 'Grid Container',
                'category' => 'Layout',
            ],
            'overlay' => [
                'name' => 'Overlay Container',
                'category' => 'Layout',
            ],
            'feature_icon' => [
                'name' => 'Feature Icon',
            ],
        ],
    ],
];
