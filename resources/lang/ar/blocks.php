<?php

return [
    'common' => [
        'product_label' => 'المنتج',
        'color_scheme_label' => 'نظام الألوان',
        'color_scheme_info' => 'تجاوز نظام ألوان القسم لهذا البلوك',

        // Spacing
        'spacing_header' => 'التباعد',
        'padding_header' => 'الحشوة',
        'padding_label' => 'الحشوة',
        'margin_label' => 'الهامش',
        'hide_on_mobile_label' => 'إخفاء على الجوال',
    ],

    'product' => [
        'name' => 'منتج',
        'settings' => [
            'product_info' => 'اختر منتجاً لعرضه',
        ],
    ],

    'product-card-group' => [
        'name' => 'مجموعة بطاقات المنتج',
    ],

    'category' => [
        'name' => 'فئة',
        'settings' => [
            'category_label' => 'الفئة',
        ],
    ],

    'category-card' => [
        'name' => 'بطاقة الفئة',
        'settings' => [
            'category_label' => 'الفئة',
        ],
        'presets' => [
            'overlay' => [
                'name' => 'بطاقة فئة مع تراكب',
            ],
            'vertical_overlay' => [
                'name' => 'عمودي مع تراكب',
            ],
            'vertical_below' => [
                'name' => 'عمودي مع الاسم أدناه',
            ],
            'simple_hover' => [
                'name' => 'تمرير بسيط',
            ],
        ],
    ],

    'feature' => [
        'icon_label' => 'أيقونة',
        'title_label' => 'العنوان',
        'text_label' => 'الوصف',
    ],

    'featured-product' => [
        'name' => 'منتج مميز',
        'product_label' => 'المنتج',
        'product_info' => 'اختر منتجاً لعرضه',
    ],

    'footer-group' => [
        'name' => 'مجموعة التذييل',
        'title_label' => 'اسم المجموعة',
        'title_default' => 'مجموعة روابط',
    ],

    'footer-link' => [
        'name' => 'رابط التذييل',
        'text_label' => 'نص الرابط',
        'text_default' => 'رابط',
        'link_label' => 'رابط URL',
    ],

    'collage-image' => [
        'image_label' => 'صورة',
    ],

    'collage-product' => [
        'product_label' => 'المنتج',
    ],

    'collage-category' => [
        'category_label' => 'اختر الفئة',
    ],

    'collage-custom' => [
        'image_label' => 'صورة',
        'title_label' => 'العنوان',
        'text_label' => 'الوصف',
        'link_label' => 'رابط URL',
        'link_text_label' => 'نص الرابط',
    ],

    'text-with-image-button' => [
        'text_label' => 'نص الزر',
        'url_label' => 'رابط الزر',
        'text_default' => 'نص الزر',
        'variant_label' => 'نوع الزر',
        'variant_primary' => 'أساسي',
        'variant_secondary' => 'ثانوي',
        'variant_accent' => 'تمييز',
        'variant_neutral' => 'محايد',
        'style_label' => 'نمط الزر',
        'style_solid' => 'صلب',
        'style_soft' => 'ناعم',
        'style_outline' => 'محدد',
        'style_ghost' => 'شفاف',
    ],

    'accordion' => [
        'name' => 'أكورديون',
        'settings' => [
            'icon_label' => 'نمط الأيقونة',
            'icon_options' => [
                'caret' => 'سهم',
                'plus' => 'زائد',
            ],

            'dividers_label' => 'إظهار الفواصل',

            'inherit_color_scheme_label' => 'وراثة نظام الألوان',
            'color_scheme_label' => 'نظام الألوان',

            'borders_header' => 'الحدود',

            'border_label' => 'نمط الحدود',
            'border_options' => [
                'none' => 'بدون',
                'solid' => 'صلب',
            ],

            'border_width_label' => 'سماكة الحدود',
            'border_opacity_label' => 'شفافية الحدود',
            'border_radius_label' => 'نصف قطر الحدود',

            'padding_header' => 'الحشوة',

            'padding_top_label' => 'أعلى',
            'padding_bottom_label' => 'أسفل',
            'padding_left_label' => 'يسار',
            'padding_right_label' => 'يمين',
        ],

        'presets' => [
            'accordion' => [
                'name' => 'أكورديون',
            ],
        ],
    ],

    'accordion-row' => [
        'name' => 'صف الأكورديون',
        'settings' => [
            'heading_label' => 'العنوان',
            'open_by_default_label' => 'فتح افتراضياً',

            'icon_header' => 'أيقونة',

            'icon_label' => 'أيقونة',
            'width_label' => 'عرض الأيقونة',
        ],

        'presets' => [
            'accordion_row' => [
                'name' => 'صف أكورديون',
            ],
        ],
    ],

    'product-media-gallery' => [
        'name' => 'معرض وسائط المنتج',
        'settings' => [
            'presentation_header' => 'العرض',

            'media_presentation_label' => 'عرض الوسائط',
            'media_presentation_options' => [
                'carousel' => 'دوار',
                'grid' => 'شبكة',
            ],
            'media_presentation_info' => 'اختر كيفية عرض صور ومقاطع الفيديو للمنتج',

            'grid_columns_label' => 'أعمدة الشبكة',
            'grid_columns_info' => 'عدد الأعمدة عند استخدام عرض الشبكة',

            'image_gap_label' => 'فجوة الصورة',
            'image_gap_info' => 'المسافة بين الصور في عرض الشبكة',

            'image_settings_header' => 'إعدادات الصورة',

            'aspect_ratio_label' => 'نسبة العرض إلى الارتفاع',
            'aspect_ratio_options' => [
                'adapt' => 'التكيف مع الصورة',
                'square' => 'مربع (1:1)',
                'portrait' => 'عمودي (2:3)',
                'landscape' => 'أفقي (3:2)',
            ],

            'constrain_to_viewport_label' => 'تقييد إلى منفذ العرض',
            'constrain_to_viewport_info' => 'منع الصور من تجاوز ارتفاع الشاشة',

            'media_fit_label' => 'ملاءمة الوسائط',
            'media_fit_options' => [
                'contain' => 'احتواء',
                'cover' => 'تغطية',
            ],

            'media_radius_label' => 'نصف قطر زاوية الوسائط',

            'zoom_label' => 'تمكين التكبير',
            'zoom_info' => 'السماح للمستخدمين بالتكبير في صور المنتج',

            'layout_header' => 'التخطيط',

            'sticky_label' => 'ثابت',
            'sticky_info' => 'الحفاظ على معرض الوسائط مرئياً أثناء التمرير',
        ],
    ],

    'product-details' => [
        'name' => 'تفاصيل المنتج',
        'settings' => [
            'layout_header' => 'التخطيط',
            'gap_label' => 'الفجوة',
            'gap_info' => 'المسافة بين البلوكات الفرعية',

            'sticky_label' => 'ثابت',
            'sticky_info' => 'الحفاظ على تفاصيل المنتج مرئية أثناء التمرير',

            'spacing_header' => 'التباعد',
            'padding_top_label' => 'حشوة أعلى',
            'padding_bottom_label' => 'حشوة أسفل',
            'padding_left_label' => 'حشوة يسار',
            'padding_right_label' => 'حشوة يمين',
        ],
    ],

    'product-price' => [
        'name' => 'سعر المنتج',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-rating' => [
        'name' => 'تقييم المنتج',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-quantity-selector' => [
        'name' => 'محدد الكمية',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-buy-buttons' => [
        'name' => 'أزرار الشراء',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
            'enable_buy_now_label' => 'تمكين زر اشترِ الآن',
            'enable_buy_now_info' => 'إظهار زر "اشترِ الآن" منفصل للدفع السريع',
        ],
    ],

    'product-button' => [
        'name' => 'زر المنتج',
        'settings' => [
            'action_label' => 'الإجراء',
            'action_options' => [
                'cart' => 'أضف إلى السلة',
                'wishlist' => 'أضف إلى المفضلة',
                'compare' => 'أضف للمقارنة',
            ],
            'variant_label' => 'النوع',
            'variant_options' => [
                'solid' => 'صلب',
                'outline' => 'محدد',
                'soft' => 'ناعم',
                'link' => 'رابط',
            ],
            'size_label' => 'الحجم',
            'size_options' => [
                'sm' => 'صغير',
                'md' => 'متوسط',
                'lg' => 'كبير',
                'xl' => 'كبير جداً',
            ],
            'color_label' => 'اللون',
            'color_options' => [
                'primary' => 'أساسي',
                'secondary' => 'ثانوي',
                'success' => 'نجاح',
                'danger' => 'خطر',
                'warning' => 'تحذير',
                'info' => 'معلومات',
            ],
            'icon_label' => 'أيقونة',
            'icon_info' => 'أيقونة اختيارية لعرضها في الزر',
            'circle_label' => 'زر دائري',
            'circle_info' => 'جعل الزر دائرياً (أيقونة فقط)',
            'square_label' => 'زر مربع',
            'square_info' => 'جعل الزر مربعاً (أيقونة فقط)',
            'block_label' => 'عرض كامل',
            'block_info' => 'جعل الزر يمتد على كامل عرض الحاوية',
        ],
        'placeholder' => [
            'cart' => 'أضف إلى السلة',
            'wishlist' => 'أضف إلى المفضلة',
            'compare' => 'أضف للمقارنة',
        ],
        'wishlist_disabled' => 'المفضلة معطلة',
        'compare_disabled' => 'المقارنة معطلة',
    ],

    'product-card' => [
        'name' => 'بطاقة المنتج',
        'presets' => [
            'vertical' => [
                'name' => 'بطاقة عمودية',
            ],
            'horizontal' => [
                'name' => 'بطاقة أفقية',
            ],
            'overlay' => [
                'name' => 'بطاقة مع تراكب عند التمرير',
                'defaults' => [
                    'product_card' => 'بطاقة المنتج',
                    'container' => 'الحاوية',
                    'product_image' => 'صورة المنتج',
                    'buttons' => 'الأزرار',
                    'add_to_cart' => 'أضف إلى السلة',
                    'add_to_wishlist' => 'أضف إلى المفضلة',
                    'add_to_compare' => 'أضف للمقارنة',
                    'information' => 'المعلومات',
                    'product_title' => 'عنوان المنتج',
                    'price_and_labels' => 'السعر والتسميات',
                    'price' => 'السعر',
                    'labels' => 'التسميات',
                ],
            ],
        ],
    ],

    'product-variant-picker' => [
        'name' => 'محدد المتغيرات',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-grouped-options' => [
        'name' => 'خيارات المنتج المجمع',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-bundle-options' => [
        'name' => 'خيارات الحزمة',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-downloadable-options' => [
        'name' => 'خيارات التنزيل',
        'settings' => [
            'position_label' => 'الموضع',
            'position_right' => 'العمود الأيمن',
            'position_under_gallery' => 'تحت المعرض',
        ],
    ],

    'product-customizable-options' => [
        'name' => 'خيارات المنتج القابلة للتخصيص',
        'description' => 'عرض خيارات المنتج القابلة للتخصيص مع تعديلات السعر',
    ],

    'logo' => [
        'name' => 'الشعار',
        'description' => 'شعار الموقع أو الاسم',
        'settings' => [
            'logo_text_label' => 'نص الشعار',
            'logo_text_placeholder' => 'يُعرض عندما لا تكون هناك صورة شعار',
            'logo_text_info' => 'يتم تكوين صور الشعار في إعدادات القالب تحت "الشعار والأيقونة المفضلة"',
        ],
    ],

    'header-nav' => [
        'name' => 'التنقل',
        'description' => 'قائمة التنقل الرئيسية المعروضة في الرأس',
        'settings' => [
            'push_to_left' => 'دفع هذا العنصر إلى البداية',
            'push_to_right' => 'دفع هذا العنصر إلى النهاية',
        ],
    ],

    'header-group' => [
        'name' => 'مجموعة الرأس',
    ],

    'header-currency' => [
        'name' => 'محدد العملة',
        'description' => 'يسمح للعملاء بالتبديل بين العملات المتاحة',
    ],

    'header-locale' => [
        'name' => 'محدد اللغة',
        'description' => 'يسمح للعملاء بالتبديل بين اللغات المتاحة',
        'settings' => [
            'icon_label' => 'أيقونة',
        ],
    ],

    'header-search' => [
        'name' => 'نموذج البحث',
        'description' => 'حقل إدخال البحث عن المنتج مع بحث اختياري بالصورة',
        'settings' => [
            'search_icon_label' => 'أيقونة البحث',
            'image_search_icon_label' => 'أيقونة البحث بالصورة',
        ],
    ],

    'header-compare' => [
        'name' => 'المقارنة',
        'description' => 'رابط إلى صفحة مقارنة المنتجات',
        'settings' => [
            'icon_label' => 'أيقونة',
        ],
    ],

    'header-user' => [
        'name' => 'قائمة المستخدم',
        'description' => 'قائمة حساب المستخدم مع خيارات تسجيل الدخول/التسجيل',
        'settings' => [
            'icon_label' => 'أيقونة',
            'guest_heading_label' => 'عنوان يُعرض للمستخدمين الضيوف',
            'guest_description_label' => 'وصف يُعرض للمستخدمين الضيوف',
            'guest_heading_default' => 'مرحباً بك ضيفنا',
            'guest_description_default' => 'إدارة السلة والطلبات والمفضلة',
        ],
    ],

    'header-cart' => [
        'name' => 'معاينة السلة',
        'description' => 'أيقونة سلة التسوق مع معاينة السلة المصغرة',
        'settings' => [
            'heading_label' => 'العنوان',
            'heading_default' => 'سلة التسوق',
            'description_label' => 'الوصف',
            'description_default' => 'احصل على خصم يصل إلى 30% على طلبك الأول',
        ],
    ],

    'feature-icon' => [
        'name' => 'أيقونة الميزة',
        'defaults' => [
            'title' => 'عنوان الميزة',
            'description' => 'يوضع وصف الميزة هنا',
        ],
    ],

];
