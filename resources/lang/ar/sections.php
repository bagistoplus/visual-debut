<?php

return [
    'announcement-bar' => [
        'name' => 'شريط الإعلان',
        'description' => 'شريط إعلان بسيط لعرض معلومات مهمة لعملائك.',
        'settings' => [
            'text_label' => 'نص الإعلان',
            'default_text' => 'شحن مجاني للطلبات التي تزيد عن 50 دولارًا',
            'link_label' => 'الرابط',
            'variant_label' => 'نوع الخلفية',

            'scheme_label' => 'نظام الألوان',
            'scheme_note' => 'يتجاوز هذا إعداد نظام ألوان القالب العام. التغييرات في نظام القالب الرئيسي لن تؤثر على هذا القسم.',
        ],
    ],

    'hero-banner' => [
        'name' => 'لافتة البطل',
        'description' => 'لافتة بعرض كامل تحتوي على نص وأزرار للدعوة إلى اتخاذ إجراء.',

        'settings' => [
            'scheme_label' => 'نظام الألوان',
            'background_label' => 'صورة الخلفية',
            'overlay_label' => 'عرض التراكب',
            'overlay_opacity_label' => 'شفافية التراكب (%)',
            'height_label' => 'ارتفاع البانر',
            'scheme_note' => 'يتجاوز هذا إعداد نظام ألوان القالب العام. التغييرات في نظام القالب الرئيسي لن تؤثر على هذا القسم.',
        ],

        'blocks' => [
            'heading' => [
                'name' => 'العنوان',
                'text_label' => 'نص العنوان',
                'default_text' => 'مرحبًا بك في متجرنا',
            ],
            'subtext' => [
                'name' => 'النص الفرعي',
                'text_label' => 'النص الفرعي',
                'default_text' => 'اكتشف أفضل منتجاتنا وعروضنا.',
            ],
            'button' => [
                'name' => 'زر',
                'text_label' => 'نص الزر',
                'default_text' => 'عرض المجموعات',
                'link_label' => 'رابط الزر',
                'color_label' => 'النوع',
            ],
        ],
    ],

    'header' => [
        'name' => 'رأس الصفحة',
        'description' => '',
        'blocks' => [
            'logo' => [
                'name' => 'الاسم/الشعار',
                'settings' => [
                    'logo_image_label' => 'تحميل الشعار',
                    'logo_text_label' => 'نص الشعار',
                    'mobile_logo_image_label' => 'شعار الجوال',
                    'logo_text_placeholder' => 'يُعرض عند عدم تعيين صورة الشعار',
                    'push_to_left' => 'ادفع هذا العنصر إلى البداية',
                    'push_to_right' => 'ادفع هذا العنصر إلى النهاية',
                ],
            ],
            'nav' => [
                'name' => 'التنقل',
                'settings' => [
                    'push_to_left' => 'ادفع هذا العنصر إلى البداية',
                    'push_to_right' => 'ادفع هذا العنصر إلى النهاية',
                ],
            ],
            'currency' => [
                'name' => 'محدد العملة',
            ],
            'locale' => [
                'name' => 'محدد اللغة',
                'settings' => [
                    'icon_label' => 'الأيقونة',
                ],
            ],
            'search' => [
                'name' => 'نموذج البحث',
                'placeholder' => 'ابحث عن المنتجات هنا',
                'settings' => [
                    'search_icon_label' => 'أيقونة البحث',
                    'image_search_icon_label' => 'أيقونة البحث بالصور',
                ],
            ],
            'compare' => [
                'name' => 'المقارنة',
                'settings' => [
                    'icon_label' => 'الأيقونة',
                ],
            ],
            'user' => [
                'name' => 'قائمة المستخدم',
                'sign-in' => 'تسجيل الدخول',
                'sign-up' => 'إنشاء حساب',
                'settings' => [
                    'icon_label' => 'الأيقونة',
                    'guest_heading_label' => 'العنوان المعروض للمستخدمين الضيوف',
                    'guest_description_label' => 'الوصف المعروض للمستخدمين الضيوف',
                    'guest_heading_default' => 'مرحبا بالزائر',
                    'guest_description_default' => 'إدارة السلة، الطلبات وقائمة الرغبات',
                ],
            ],
            'cart' => [
                'name' => 'معاينة السلة',
                'settings' => [
                    'heading_label' => 'العنوان',
                    'description_label' => 'الوصف',
                    'description_default' => 'احصل على خصم يصل إلى 30٪ على طلبك الأول',
                ],
            ],
        ],
    ],

    'footer' => [
        'name' => 'تذييل الصفحة',
        'description' => 'الجزء السفلي من موقعك مع الروابط والعلامة التجارية.',

        'settings' => [
            'heading_label' => 'العنوان',
            'heading_default' => 'متجري',

            'description_label' => 'الوصف',
            'description_default' => 'أضف وصفًا لمتجرك هنا',

            'show_social_links_label' => 'عرض روابط التواصل الاجتماعي',
            'show_social_links_info' => 'يمكنك إعداد الروابط من إعدادات القالب',
        ],

        'blocks' => [
            'group' => [
                'name' => 'مجموعة روابط',
                'settings' => [
                    'title_label' => 'اسم المجموعة',
                    'title_default' => 'مجموعة روابط',
                ],
            ],
            'link' => [
                'name' => 'رابط',
                'settings' => [
                    'text_label' => 'نص الرابط',
                    'text_default' => 'رابط',

                    'link_label' => 'الرابط',
                ],
            ],
        ],
    ],

    'hero' => [
        'name' => 'بانر رئيسي',
        'description' => '',
        'settings' => [
            'image_label' => 'الصورة',
            'height_label' => 'الارتفاع',
            'height_small' => 'صغير',
            'height_medium' => 'متوسط',
            'height_large' => 'كبير',
            'header_content' => 'المحتوى',
            'content_position_label' => 'موضع المحتوى',
            'content_position_top' => 'أعلى',
            'content_position_middle' => 'المنتصف',
            'content_position_bottom' => 'أسفل',
            'show_overlay_label' => 'عرض التراكب',
            'overlay_opacity_label' => 'شفافية التراكب',
        ],
        'blocks' => [
            'heading' => [
                'name' => 'العنوان',
                'settings' => [
                    'heading_label' => 'العنوان',
                    'heading_default' => 'عنوان البانر الرئيسي',
                    'heading_size_label' => 'حجم العنوان',
                    'heading_size_small' => 'صغير',
                    'heading_size_medium' => 'متوسط',
                    'heading_size_large' => 'كبير',
                ],
            ],
            'subheading' => [
                'name' => 'العنوان الفرعي',
                'settings' => [
                    'subheading_label' => 'العنوان الفرعي',
                    'subheading_default' => 'العنوان الفرعي للبانر الرئيسي',
                ],
            ],
            'button' => [
                'name' => 'زر الدعوة للإجراء',
                'settings' => [
                    'text_label' => 'نص الزر',
                    'text_default' => 'تسوق الآن',
                    'link_label' => 'رابط الزر',
                ],
            ],
        ],
    ],

    'category-list' => [
        'name' => 'قائمة الفئات',
        'description' => 'عرض الفئات في تخطيط شبكة متجاوبة أو دوّار.',
        'settings' => [
            'heading_default' => 'تسوق حسب الفئة',

            'parent_category_label' => 'الفئة الأصلية',
            'parent_category_info' => 'حدد فئة أصلية لعرض فئاتها الفرعية. اتركه فارغًا لعرض الفئات المضافة يدويًا.',

            'layout_header' => 'التخطيط',
            'layout_type_label' => 'نوع التخطيط',
            'layout_type_options' => [
                'grid' => 'شبكة',
                'carousel' => 'دوّار',
            ],
            'columns_label' => 'الأعمدة',
            'gap_label' => 'المسافة',
            'gap_info' => 'المسافة بين العناصر (0-24، حيث 4 = 1rem)',

            'carousel_nav_header' => 'دوّار',
            'loop_label' => 'تكرار',
            'autoplay_label' => 'تشغيل تلقائي',
            'autoplay_delay_label' => 'تأخير التشغيل التلقائي',
            'autoplay_delay_info' => 'الوقت بين تغييرات الشرائح التلقائية بالمللي ثانية.',
            'nav_style_label' => 'نمط التنقل',
            'nav_style_options' => [
                'arrow' => 'أسهم',
                'dot' => 'نقاط',
                'both' => 'كلاهما',
                'none' => 'بدون',
            ],
            'nav_shape_label' => 'شكل التنقل',
            'nav_shape_options' => [
                'none' => 'بدون',
                'circle' => 'دائرة',
                'square' => 'مربع',
            ],
            'nav_icon_label' => 'أيقونة التنقل',
            'nav_icon_options' => [
                'arrow' => 'سهم',
                'chevron' => 'شيفرون',
            ],

            'appearance_header' => 'المظهر',

            'content_width_label' => 'عرض المحتوى',
            'content_width_options' => [
                'container' => 'حاوية',
                'full' => 'العرض الكامل',
            ],
        ],
        'presets' => [
            'grid' => [
                'name' => 'شبكة الفئات',
                'heading' => 'تسوق حسب الفئة',
            ],
        ],
        'blocks' => [
            'category' => [
                'name' => 'فئة',
                'settings' => [
                    'category_label' => 'الفئة',
                ],
            ],
        ],
    ],

    'featured-products' => [
        'name' => 'منتجات مميزة',
        'description' => 'عرض منتجات مختارة يدويًا أو محملة تلقائيًا مثل المنتجات المميزة أو الجديدة.',

        'settings' => [
            'heading_label' => 'العنوان',
            'heading_default' => 'منتجات مميزة',

            'subheading_label' => 'العنوان الفرعي',
            'subheading_default' => 'اطلع على أحدث منتجاتنا',

            'nb_products_label' => 'عدد المنتجات المعروضة',
            'nb_products_info' => 'يُستخدم فقط عند عدم إضافة أي كتل منتجات',
            'product_type_label' => 'نوع المنتج',
            'product_type_info' => 'يُستخدم فقط عند عدم إضافة أي كتل منتجات',

            'new_label' => 'منتجات جديدة',
            'featured_label' => 'منتجات مميزة',
        ],

        'blocks' => [
            'product' => [
                'name' => 'منتج',
                'settings' => [
                    'product_label' => 'المنتج',
                    'product_info' => 'اختر منتجًا لعرضه',
                ],
            ],
        ],
    ],

    'product-list' => [
        'name' => 'قائمة المنتجات',
        'description' => 'عرض قائمة منتجات من فئة، أو التصفية حسب نوع المنتج.',

        'settings' => [
            'parent_category_label' => 'الفئة الأصلية',
            'parent_category_info' => 'تصفية المنتجات حسب الفئة. اتركه فارغًا لعرض المنتجات من جميع الفئات.',

            'product_type_label' => 'نوع المنتج',
            'product_type_info' => 'يُستخدم فقط عند عدم اختيار فئة أصلية',
            'new_label' => 'منتجات جديدة',
            'featured_label' => 'منتجات مميزة',

            'nb_products_label' => 'عدد المنتجات',
            'nb_products_info' => 'الحد الأقصى لعدد المنتجات المعروضة',

            'layout_header' => 'التخطيط',
            'layout_type_label' => 'نوع التخطيط',
            'layout_type_options' => [
                'grid' => 'شبكة',
                'carousel' => 'دوّار',
            ],

            'columns_label' => 'الأعمدة',
            'gap_label' => 'المسافة',
            'gap_info' => 'المسافة بين المنتجات',

            'content_width_label' => 'عرض المحتوى',
            'content_width_options' => [
                'container' => 'حاوية',
                'full' => 'العرض الكامل',
            ],

            'carousel_nav_header' => 'دوّار',
            'loop_label' => 'تكرار',
            'autoplay_label' => 'تشغيل تلقائي',
            'autoplay_delay_label' => 'تأخير التشغيل التلقائي',
            'autoplay_delay_info' => 'الوقت بين تغييرات الشرائح التلقائية بالمللي ثانية.',
            'nav_style_label' => 'نمط التنقل',
            'nav_style_options' => [
                'arrow' => 'أسهم',
                'dot' => 'نقاط',
                'both' => 'كلاهما',
                'none' => 'بدون',
            ],
            'nav_shape_label' => 'شكل التنقل',
            'nav_shape_options' => [
                'circle' => 'دائرة',
                'square' => 'مربع',
                'none' => 'بدون',
            ],
            'nav_icon_label' => 'أيقونة التنقل',
            'nav_icon_options' => [
                'arrow' => 'سهم',
                'chevron' => 'شيفرون',
            ],

            'appearance_header' => 'المظهر',
            'color_scheme_label' => 'نظام الألوان',
        ],

        'blocks' => [
            'product' => [
                'name' => 'منتج',
                'settings' => [
                    'product_label' => 'المنتج',
                    'product_info' => 'اختر منتجًا لعرضه',
                ],
            ],
        ],
    ],

    'newsletter' => [
        'name' => 'الاشتراك في النشرة البريدية',
        'description' => 'اسمح للعملاء بالاشتراك لتلقي التحديثات والعروض الترويجية.',

        'settings' => [
            'heading_label' => 'العنوان',
            'heading_default' => 'اشترك في نشرتنا البريدية',

            'description_label' => 'الوصف',
            'description_default' => 'استخدم هذا النص لمشاركة معلومات حول علامتك التجارية مع عملائك. صف منتجًا، أو شارك الإعلانات، أو رحب بالعملاء في متجرك.',

            'scheme_label' => 'نظام الألوان',
            'scheme_note' => 'يتجاوز هذا إعداد نظام ألوان القالب العام. التغييرات في نظام القالب الرئيسي لن تؤثر على هذا القسم.',
        ],
    ],

    'category-page' => [
        'name' => 'منتجات الفئة',
        'description' => 'يعرض المنتجات ضمن الفئة الحالية مع خيارات التصفية والفرز.',

        'settings' => [
            'heading_label' => 'عنوان مخصص (اختياري)',
            'columns_label' => 'أعمدة الشبكة (سطح المكتب)',
            'columns_tablet_label' => 'أعمدة الشبكة (الأجهزة اللوحية)',
            'columns_mobile_label' => 'أعمدة الشبكة (الجوال)',
            'filters_label' => 'عرض الفلاتر',
            'sorting_label' => 'عرض خيارات الفرز',
            'banner_label' => 'عرض بانر الفئة',
        ],
    ],

    'product-reviews' => [
        'name' => 'مراجعات المنتج',
        'description' => 'يعرض أحدث مراجعات العملاء للمنتج الحالي.',

        'settings' => [
            'rating_summary_label' => 'عرض ملخص التقييم',
            'reviews_label' => 'عرض المراجعات الفردية',
            'limit_label' => 'عدد المراجعات المعروضة',
        ],

        'average_rating' => 'متوسط التقييم',
        'no_reviews' => 'لا توجد مراجعات بعد.',
    ],

    'text-with-image' => [
        'name' => 'نص مع صورة',
        'description' => 'عرض محتوى نصي بجانب صورة مع تخطيط قابل للتعديل.',

        'settings' => [
            'image_label' => 'الصورة',
            'image_position_label' => 'موضع الصورة',
            'left_label' => 'الصورة أولاً',
            'right_label' => 'الصورة ثانياً',

            'image_height_label' => 'ارتفاع الصورة',
            'image_height_auto' => 'تكيّف مع الصورة',
            'image_height_sm' => 'صغير',
            'image_height_md' => 'متوسط',
            'image_height_lg' => 'كبير',

            'image_width_label' => 'عرض الصورة (سطح المكتب)',
            'width_sm' => 'صغير',
            'width_md' => 'متوسط',
            'width_lg' => 'كبير',

            'content_position_label' => 'موضع المحتوى (عمودي)',
            'position_top' => 'أعلى',
            'position_middle' => 'منتصف',
            'position_bottom' => 'أسفل',

            'content_align_label' => 'محاذاة المحتوى (سطح المكتب)',
            'content_align_mobile_label' => 'محاذاة المحتوى (الجوال)',
            'align_start' => 'بداية',
            'align_center' => 'المنتصف',
            'align_end' => 'النهاية',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'العنوان',
                'settings' => [
                    'text_label' => 'نص العنوان',
                    'text_default' => 'صورة مع نص',
                ],
            ],
            'body' => [
                'label' => 'النص الأساسي',
                'settings' => [
                    'content_label' => 'نص الفقرة',
                    'content_default' => 'ادمج نصًا مع صورة لتسليط الضوء على منتجك أو مجموعتك أو مقالة مدونتك. أضف تفاصيل حول التوفر أو النمط أو حتى مراجعة.',
                ],
            ],
            'button' => [
                'label' => 'زر',
                'settings' => [
                    'text_label' => 'نص الزر',
                    'url_label' => 'رابط الزر',
                    'text_default' => 'نص الزر',
                    'variant_label' => 'نوع الزر',

                    'variant_primary' => 'رئيسي',
                    'variant_secondary' => 'ثانوي',
                    'variant_accent' => 'بارز',
                    'variant_neutral' => 'محايد',

                    'style_label' => 'نمط الزر',
                    'style_solid' => 'صلب',
                    'style_soft' => 'ناعم',
                    'style_outline' => 'مخطط',
                    'style_ghost' => 'شبح',
                ],
            ],
        ],
    ],

    'collage' => [
        'name' => 'كولاج',
        'description' => 'تخطيط مرن لدمج الصور والمنتجات والفئات.',

        'settings' => [
            'heading_label' => 'العنوان',
            'heading_size_label' => 'حجم العنوان',
        ],

        'blocks' => [
            'image' => [
                'label' => 'صورة',
                'settings' => [
                    'image_label' => 'صورة',
                ],
            ],
            'product' => [
                'label' => 'منتج',
                'settings' => [
                    'product_label' => 'منتج',
                ],
            ],
            'custom' => [
                'label' => 'محتوى مخصص',
                'settings' => [
                    'image_label' => 'صورة',
                    'title_label' => 'العنوان',
                    'text_label' => 'الوصف',
                    'link_label' => 'الرابط',
                    'link_text_label' => 'نص الرابط',
                ],
            ],
            'category' => [
                'label' => 'فئة',
                'settings' => [
                    'category_label' => 'اختر الفئة',
                ],
            ],
        ],
    ],

    'contact-form' => [
        'name' => 'نموذج الاتصال',
        'description' => 'قسم بسيط يحتوي على نموذج الاسم، البريد الإلكتروني، والرسالة.',

        'success_message' => 'شكرًا لك! تم إرسال رسالتك.',
    ],

    'breadcrumbs' => [
        'name' => 'مسار التنقل',
        'description' => 'يعرض مسار تنقل للتصفح.',
        'settings' => [
            'separator_label' => 'رمز الفاصل',
        ],
    ],

    'cart-content' => [
        'name' => 'محتوى السلة',
        'description' => 'يعرض ملخصًا لمحتوى سلة العميل، بما في ذلك المنتجات والكميات والأسعار والإجراءات مثل التحديث أو إزالة العناصر.',
    ],

    'checkout' => [
        'name' => 'الدفع',
        'description' => 'تصميم كامل لعملية الدفع يشمل تفاصيل الفواتير، ملخص السلة، إدخال القسيمة، وحساب المجموع.',
    ],

    'checkout-success' => [
        'name' => 'نجاح الدفع',
        'description' => 'يعرض رسالة تأكيد الطلب مع تفاصيل الملخص بعد إتمام عملية الدفع بنجاح.',
    ],

    'search-result' => [
        'name' => 'نتائج البحث',
        'description' => 'يعرض المنتجات أو المحتوى الذي يطابق استعلام بحث المستخدم، مع دعم التصفية والتقسيم إلى صفحات.',
    ],

    'cms-page' => [
        'name' => 'صفحة إدارة المحتوى',
        'description' => 'يعرض محتوى صفحة إدارة المحتوى (CMS)، مما يتيح عرض النصوص أو الوسائط الثابتة أو الديناميكية ضمن تخطيط مقطع.',
    ],

    'error-page' => [
        'name' => 'صفحة الخطأ',
        'description' => 'يعرض رسالة خطأ بتصميم خاص (مثل 404 أو 500) مع روابط تنقل اختيارية أو خيار بحث لمساعدة المستخدمين على المتابعة.',
    ],

    'feature-icons' => [
        'name' => 'رموز الميزات',
        'description' => 'عرض صف من الرموز مع عناوين ووصف قصير.',

        'settings' => [
            'heading_label' => 'عنوان القسم',
            'description_label' => 'وصف القسم',
            'icon_size_label' => 'حجم الرمز (بكسل)',
            'columns_label' => 'عدد الأعمدة على سطح المكتب',
            'layout_label' => 'التخطيط',
            'layout_horizontal' => 'الرمز على اليسار، النص على اليمين',
            'layout_vertical' => 'الرمز في الأعلى، النص في الأسفل',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'ميزة',
                'settings' => [
                    'icon_label' => 'رمز',
                    'title_label' => 'عنوان',
                    'text_label' => 'وصف',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'عنوان',
            'text' => 'نص إضافي لشرح الميزة',
        ],
    ],

];
