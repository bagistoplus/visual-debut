<?php

return [
    'common' => [
        'color_scheme_label' => 'रंग योजना',
        'color_scheme_info' => 'इस सेक्शन के लिए वैश्विक थीम रंग योजना को ओवरराइड करें',
    ],

    'admin-topbar' => [
        'name' => 'एडमिन टॉप बार',
        'description' => 'एडमिन पैनल के लिंक के साथ एक टॉप बार दिखाता है। एडमिन-एक्सेस वाली स्टोरफ्रंट के लिए उपयोगी।',

        'settings' => [
            'text_label' => 'लिंक पाठ',
            'url_label' => 'लिंक URL',
        ],
    ],

    'announcement-bar' => [
        'name' => 'घोषणा पट्टी',
        'description' => 'अपने ग्राहकों को महत्वपूर्ण जानकारी दिखाने के लिए एक सरल घोषणा पट्टी।',
        'settings' => [
            'text_label' => 'घोषणा पाठ',
            'default_text' => '$50 से अधिक के ऑर्डर पर निःशुल्क शिपिंग',
            'link_label' => 'लिंक',
            'variant_label' => 'पृष्ठभूमि प्रकार',
            'variant_options' => [
                'primary' => 'प्राथमिक',
                'secondary' => 'द्वितीयक',
                'accent' => 'उच्चारण',
                'neutral' => 'तटस्थ',
            ],

            'scheme_label' => 'रंग योजना',
            'scheme_note' => 'यह वैश्विक थीम रंग योजना को ओवरराइड करता है। मुख्य थीम योजना में किए गए परिवर्तन इस अनुभाग को प्रभावित नहीं करेंगे।',
        ],
    ],

    'hero-banner' => [
        'name' => 'हीरो बैनर',
        'description' => 'एक पूर्ण-चौड़ाई वाला बैनर जिसमें पाठ और कॉल-टू-एक्शन बटन होते हैं।',

        'settings' => [
            'scheme_label' => 'रंग योजना',
            'background_label' => 'पृष्ठभूमि छवि',
            'overlay_label' => 'ओवरले दिखाएं',
            'overlay_opacity_label' => 'ओवरले अपारदर्शिता (%)',
            'height_label' => 'बैनर ऊंचाई',
            'scheme_note' => 'यह वैश्विक थीम रंग योजना को ओवरराइड करता है। मुख्य थीम योजना में किए गए परिवर्तन इस अनुभाग को प्रभावित नहीं करेंगे।',
        ],

        'blocks' => [
            'heading' => [
                'name' => 'शीर्षक',
                'text_label' => 'शीर्षक पाठ',
                'default_text' => 'हमारे स्टोर में आपका स्वागत है',
            ],
            'subtext' => [
                'name' => 'उप-पाठ',
                'text_label' => 'उप-पाठ',
                'default_text' => 'हमारे सर्वश्रेष्ठ उत्पाद और ऑफ़र खोजें।',
            ],
            'button' => [
                'name' => 'बटन',
                'text_label' => 'बटन पाठ',
                'default_text' => 'कलेक्शन देखें',
                'link_label' => 'बटन लिंक',
                'color_label' => 'प्रकार',
            ],
        ],
    ],

    'header' => [
        'name' => 'हेडर',
        'description' => '',
        'settings' => [
            'content_width_label' => 'सामग्री की चौड़ाई',
            'content_width_container' => 'कंटेनर',
            'content_width_fullwidth' => 'पूर्ण चौड़ाई',
        ],
        'region' => [
            'logo_group' => 'लोगो',
            'actions_group' => 'क्रियाएँ',
        ],
        'presets' => [
            'default' => [
                'name' => 'हेडर',
            ],
        ],
        'blocks' => [
            'logo' => [
                'name' => 'नाम/लोगो',
                'settings' => [
                    'logo_image_label' => 'लोगो अपलोड करें',
                    'logo_text_label' => 'लोगो पाठ',
                    'mobile_logo_image_label' => 'मोबाइल लोगो',
                    'logo_text_placeholder' => 'जब कोई लोगो छवि सेट नहीं हो तब प्रदर्शित होता है',
                    'push_to_left' => 'इस तत्व को प्रारंभ में ले जाएं',
                    'push_to_right' => 'इस तत्व को अंत में ले जाएं',
                ],
            ],
            'nav' => [
                'name' => 'नेविगेशन',
                'settings' => [
                    'push_to_left' => 'इस तत्व को प्रारंभ में ले जाएं',
                    'push_to_right' => 'इस तत्व को अंत में ले जाएं',
                ],
            ],
            'currency' => [
                'name' => 'मुद्रा चयनकर्ता',
            ],
            'locale' => [
                'name' => 'भाषा चयनकर्ता',
                'settings' => [
                    'icon_label' => 'आइकन',
                ],
            ],
            'search' => [
                'name' => 'खोज फ़ॉर्म',
                'placeholder' => 'यहाँ उत्पाद खोजें',
                'settings' => [
                    'search_icon_label' => 'खोज आइकन',
                    'image_search_icon_label' => 'छवि खोज आइकन',
                ],
            ],
            'compare' => [
                'name' => 'तुलना करें',
                'settings' => [
                    'icon_label' => 'आइकन',
                ],
            ],
            'user' => [
                'name' => 'उपयोगकर्ता मेनू',
                'sign-in' => 'साइन इन',
                'sign-up' => 'साइन अप',
                'settings' => [
                    'icon_label' => 'आइकन',
                    'guest_heading_label' => 'अतिथि उपयोगकर्ताओं को दिखाया गया शीर्षक',
                    'guest_description_label' => 'अतिथि उपयोगकर्ताओं को दिखाया गया विवरण',
                    'guest_heading_default' => 'अतिथि का स्वागत है',
                    'guest_description_default' => 'कार्ट, ऑर्डर और विशलिस्ट प्रबंधित करें',
                ],
            ],
            'cart' => [
                'name' => 'कार्ट पूर्वावलोकन',
                'settings' => [
                    'heading_label' => 'शीर्षक',
                    'description_label' => 'विवरण',
                    'description_default' => 'अपने पहले आदेश पर 30% तक की छूट पाएं',
                ],
            ],
        ],
    ],

    'footer' => [
        'name' => 'फुटर',
        'description' => 'आपकी वेबसाइट का निचला भाग, जिसमें लिंक और ब्रांडिंग होती है।',

        'settings' => [
            'layout_header' => 'लेआउट',
            'content_width_label' => 'सामग्री की चौड़ाई',
            'content_width_options' => [
                'full' => 'पूर्ण चौड़ाई',
                'container' => 'कंटेनर',
            ],
            'content_width_info' => 'चुनें कि फुटर सामग्री कंटेनर में सीमित रहे या पूर्ण चौड़ाई में फैले',
            'appearance_header' => 'दिखावट',
            'color_scheme_label' => 'रंग योजना',
            'color_scheme_info' => 'इस सेक्शन के लिए वैश्विक थीम रंग योजना को ओवरराइड करें',
            'heading_label' => 'शीर्षक',
            'heading_default' => 'माई स्टोर',

            'description_label' => 'विवरण',
            'description_default' => 'यहाँ अपने स्टोर का विवरण जोड़ें',

            'show_social_links_label' => 'सोशल लिंक दिखाएं',
            'show_social_links_info' => 'आप थीम सेटिंग्स में लिंक कॉन्फ़िगर कर सकते हैं',
        ],

        'presets' => [
            'classic' => [
                'name' => 'क्लासिक फुटर',
                'brand_title' => 'माई स्टोर',
                'brand_description' => 'यहाँ अपने स्टोर का विवरण जोड़ें। अपने ग्राहकों को अपने मिशन, मूल्यों और उत्पादों की खासियतों के बारे में बताएं।',
                'brand_column' => 'ब्रांड',
                'footer_columns' => 'फुटर कॉलम',
                'company_title' => 'कंपनी',
                'policy_title' => 'नीति',
                'account_title' => 'खाता',
                'bottom_bar' => 'निचला बार',
                'social_icons' => 'सोशल आइकन',
                'copyright' => sprintf('© %s %s. सर्वाधिकार सुरक्षित।', date('Y'), config('app.name')),
                'links' => [
                    'about_us' => 'हमारे बारे में',
                    'contact' => 'संपर्क',
                    'careers' => 'करियर',
                    'privacy_policy' => 'गोपनीयता नीति',
                    'terms_of_service' => 'सेवा की शर्तें',
                    'shipping_policy' => 'शिपिंग नीति',
                    'sign_in' => 'साइन इन',
                    'register' => 'रजिस्टर',
                    'my_account' => 'मेरा खाता',
                ],
            ],

            'minimal' => [
                'name' => 'मिनिमल केंद्रित फुटर',
                'tagline' => 'आपका विश्वसनीय ई-कॉमर्स पार्टनर',
                'centered_content' => 'केंद्रित सामग्री',
                'social_icons' => 'सोशल आइकन',
                'copyright' => sprintf('© %s सर्वाधिकार सुरक्षित।', date('Y')),
            ],

            'newsletter' => [
                'name' => 'न्यूज़लेटर फुटर',
                'heading' => 'जुड़े रहें',
                'description' => 'विशेष ऑफ़र और अपडेट के लिए हमारे न्यूज़लेटर की सदस्यता लें।',
                'copyright' => sprintf('© %s %s', date('Y'), config('app.name')),
                'container' => 'न्यूज़लेटर + लिंक',
                'newsletter' => 'न्यूज़लेटर',
                'links' => 'लिंक',
                'columns' => [
                    'quick_links' => 'त्वरित लिंक',
                    'help' => 'सहायता',
                    'account' => 'खाता',
                ],
                'links_items' => [
                    'shop' => 'दुकान',
                    'about' => 'हमारे बारे में',
                    'contact' => 'संपर्क',
                    'faq' => 'FAQ',
                    'shipping' => 'शिपिंग',
                    'returns' => 'रिटर्न',
                    'sign_in' => 'साइन इन',
                    'register' => 'रजिस्टर',
                ],
            ],
        ],

        'blocks' => [
            'group' => [
                'name' => 'लिंक समूह',
                'settings' => [
                    'title_label' => 'समूह का नाम',
                    'title_default' => 'लिंक समूह',
                ],
            ],
            'link' => [
                'name' => 'लिंक',
                'settings' => [
                    'text_label' => 'लिंक पाठ',
                    'text_default' => 'लिंक',

                    'link_label' => 'लिंक',
                ],
            ],
        ],
    ],

    'hero' => [
        'name' => 'हीरो',
        'description' => '',
        'settings' => [
            'image_label' => 'छवि',
            'height_label' => 'ऊंचाई',
            'height_small' => 'छोटी',
            'height_medium' => 'मध्यम',
            'height_large' => 'बड़ी',
            'header_content' => 'सामग्री',
            'content_position_label' => 'सामग्री की स्थिति',
            'content_position_top' => 'ऊपर',
            'content_position_middle' => 'मध्य',
            'content_position_bottom' => 'नीचे',
            'show_overlay_label' => 'ओवरले दिखाएं',
            'overlay_opacity_label' => 'ओवरले अपारदर्शिता',
        ],
        'blocks' => [
            'heading' => [
                'name' => 'शीर्षक',
                'settings' => [
                    'heading_label' => 'शीर्षक',
                    'heading_default' => 'हीरो शीर्षक',
                    'heading_size_label' => 'शीर्षक का आकार',
                    'heading_size_small' => 'छोटा',
                    'heading_size_medium' => 'मध्यम',
                    'heading_size_large' => 'बड़ा',
                ],
            ],
            'subheading' => [
                'name' => 'उप-शीर्षक',
                'settings' => [
                    'subheading_label' => 'उप-शीर्षक',
                    'subheading_default' => 'हीरो उप-शीर्षक',
                ],
            ],
            'button' => [
                'name' => 'कार्य के लिए बटन',
                'settings' => [
                    'text_label' => 'बटन का पाठ',
                    'text_default' => 'अभी खरीदें',
                    'link_label' => 'बटन लिंक',
                ],
            ],
        ],
    ],

    'category-list' => [
        'name' => 'श्रेणी सूची',
        'description' => 'श्रेणियों को responsive grid या carousel layout में दिखाएं।',
        'settings' => [
            'heading_default' => 'श्रेणी अनुसार खरीदारी करें',

            'parent_category_label' => 'मूल श्रेणी',
            'parent_category_info' => 'इसकी child categories दिखाने के लिए parent category चुनें। मैन्युअल रूप से जोड़ी गई categories दिखाने के लिए खाली छोड़ें।',

            'layout_header' => 'लेआउट',
            'layout_type_label' => 'लेआउट प्रकार',
            'layout_type_options' => [
                'grid' => 'ग्रिड',
                'carousel' => 'कैरोसेल',
            ],
            'columns_label' => 'कॉलम',
            'gap_label' => 'अंतर',
            'gap_info' => 'items के बीच की जगह (0-24, जहाँ 4 = 1rem)',

            'carousel_nav_header' => 'कैरोसेल',
            'loop_label' => 'लूप',
            'autoplay_label' => 'ऑटोप्ले',
            'autoplay_delay_label' => 'ऑटोप्ले विलंब',
            'autoplay_delay_info' => 'स्वचालित स्लाइड बदलावों के बीच का समय मिलीसेकंड में।',
            'nav_style_label' => 'नेविगेशन शैली',
            'nav_style_options' => [
                'arrow' => 'तीर',
                'dot' => 'डॉट्स',
                'both' => 'दोनों',
                'none' => 'कोई नहीं',
            ],
            'nav_shape_label' => 'नेविगेशन आकार',
            'nav_shape_options' => [
                'none' => 'कोई नहीं',
                'circle' => 'वृत्त',
                'square' => 'वर्ग',
            ],
            'nav_icon_label' => 'नेविगेशन आइकन',
            'nav_icon_options' => [
                'arrow' => 'तीर',
                'chevron' => 'शेवरॉन',
            ],

            'appearance_header' => 'रूप',

            'content_width_label' => 'सामग्री की चौड़ाई',
            'content_width_options' => [
                'container' => 'कंटेनर',
                'full' => 'पूर्ण चौड़ाई',
            ],
        ],
        'presets' => [
            'grid' => [
                'name' => 'श्रेणी ग्रिड',
                'heading' => 'श्रेणी अनुसार खरीदारी करें',
                'category_card' => 'श्रेणी कार्ड',
            ],
        ],
        'blocks' => [
            'category' => [
                'name' => 'श्रेणी',
                'settings' => [
                    'category_label' => 'श्रेणी',
                ],
            ],
        ],
        'placeholder' => [
            'category' => 'श्रेणी :index',
        ],
    ],

    'featured-products' => [
        'name' => 'विशेष उत्पाद',
        'description' => 'विशेष रूप से चुने गए या स्वचालित रूप से लोड किए गए उत्पादों को दिखाएं, जैसे कि विशेष या नए उत्पाद।',

        'settings' => [
            'heading_label' => 'शीर्षक',
            'heading_default' => 'विशेष उत्पाद',

            'subheading_label' => 'उप-शीर्षक',
            'subheading_default' => 'हमारे नवीनतम उत्पाद देखें',

            'nb_products_label' => 'दिखाने के लिए उत्पादों की संख्या',
            'nb_products_info' => 'केवल तब उपयोग किया जाता है जब कोई उत्पाद ब्लॉक जोड़ा नहीं गया हो',
            'product_type_label' => 'उत्पाद प्रकार',
            'product_type_info' => 'केवल तब उपयोग किया जाता है जब कोई उत्पाद ब्लॉक जोड़ा नहीं गया हो',

            'new_label' => 'नए उत्पाद',
            'featured_label' => 'विशेष उत्पाद',
        ],

        'blocks' => [
            'product' => [
                'name' => 'उत्पाद',
                'settings' => [
                    'product_label' => 'उत्पाद',
                    'product_info' => 'प्रदर्शित करने के लिए एक उत्पाद चुनें',
                ],
            ],
        ],
    ],

    'product-list' => [
        'name' => 'उत्पाद सूची',
        'description' => 'किसी श्रेणी से उत्पादों की सूची दिखाएं, या उत्पाद प्रकार के अनुसार फ़िल्टर करें।',

        'settings' => [
            'parent_category_label' => 'मूल श्रेणी',
            'parent_category_info' => 'उत्पादों को श्रेणी के अनुसार फ़िल्टर करें। सभी श्रेणियों के उत्पाद दिखाने के लिए खाली छोड़ें।',

            'product_type_label' => 'उत्पाद प्रकार',
            'product_type_info' => 'केवल तब उपयोग किया जाता है जब कोई मूल श्रेणी चयनित न हो',
            'new_label' => 'नए उत्पाद',
            'featured_label' => 'विशेष उत्पाद',

            'nb_products_label' => 'उत्पादों की संख्या',
            'nb_products_info' => 'दिखाने के लिए उत्पादों की अधिकतम संख्या',

            'layout_header' => 'लेआउट',
            'layout_type_label' => 'लेआउट प्रकार',
            'layout_type_options' => [
                'grid' => 'ग्रिड',
                'carousel' => 'कैरोसेल',
            ],

            'columns_label' => 'कॉलम',
            'gap_label' => 'अंतर',
            'gap_info' => 'उत्पादों के बीच की जगह',

            'content_width_label' => 'सामग्री की चौड़ाई',
            'content_width_options' => [
                'container' => 'कंटेनर',
                'full' => 'पूर्ण चौड़ाई',
            ],

            'carousel_nav_header' => 'कैरोसेल',
            'loop_label' => 'लूप',
            'autoplay_label' => 'ऑटोप्ले',
            'autoplay_delay_label' => 'ऑटोप्ले विलंब',
            'autoplay_delay_info' => 'स्वचालित स्लाइड बदलावों के बीच का समय मिलीसेकंड में।',
            'nav_style_label' => 'नेविगेशन शैली',
            'nav_style_options' => [
                'arrow' => 'तीर',
                'dot' => 'डॉट्स',
                'both' => 'दोनों',
                'none' => 'कोई नहीं',
            ],
            'nav_shape_label' => 'नेविगेशन आकार',
            'nav_shape_options' => [
                'circle' => 'वृत्त',
                'square' => 'वर्ग',
                'none' => 'कोई नहीं',
            ],
            'nav_icon_label' => 'नेविगेशन आइकन',
            'nav_icon_options' => [
                'arrow' => 'तीर',
                'chevron' => 'शेवरॉन',
            ],

            'appearance_header' => 'रूप',
            'color_scheme_label' => 'रंग योजना',
        ],

        'blocks' => [
            'product' => [
                'name' => 'उत्पाद',
                'settings' => [
                    'product_label' => 'उत्पाद',
                    'product_info' => 'दिखाने के लिए एक उत्पाद चुनें',
                ],
            ],
        ],
        'placeholder' => [
            'product' => 'उत्पाद :index',
        ],

        'presets' => [
            'featured' => [
                'name' => 'फ़ीचर्ड उत्पाद',
            ],
            'new' => [
                'name' => 'नए आगमन',
            ],
        ],
    ],

    'newsletter' => [
        'name' => 'न्यूज़लेटर साइनअप',
        'description' => 'ग्राहकों को अपडेट और प्रमोशन के लिए सदस्यता लेने की अनुमति दें।',

        'settings' => [
            'heading_label' => 'शीर्षक',
            'heading_default' => 'हमारे न्यूज़लेटर के लिए साइन अप करें',

            'description_label' => 'विवरण',
            'description_default' => 'अपने ब्रांड के बारे में जानकारी साझा करने के लिए इस पाठ का उपयोग करें। किसी उत्पाद का वर्णन करें, घोषणाएँ साझा करें, या ग्राहकों का अपने स्टोर में स्वागत करें।',

            'scheme_label' => 'रंग योजना',
            'scheme_note' => 'यह वैश्विक थीम रंग योजना को ओवरराइड करता है। मुख्य थीम योजना में किए गए परिवर्तन इस अनुभाग को प्रभावित नहीं करेंगे।',
        ],
    ],

    'product-information' => [
        'name' => 'उत्पाद जानकारी',
        'description' => 'उत्पाद मीडिया गैलरी और विवरण को लचीले ग्रिड लेआउट में प्रदर्शित करता है।',

        'settings' => [
            'section_width_label' => 'सेक्शन की चौड़ाई',
            'section_width_options' => [
                'container' => 'कंटेनर',
                'full_width' => 'पूर्ण चौड़ाई',
            ],

            'layout_header' => 'लेआउट',
            'media_position_label' => 'मीडिया की स्थिति',
            'media_position_options' => [
                'left' => 'बाएं',
                'right' => 'दाएं',
            ],
            'equal_columns_label' => 'समान कॉलम',
            'equal_columns_info' => 'मीडिया और विवरण कॉलम को समान चौड़ाई दें (2:1 अनुपात की जगह 50/50)',
            'gap_label' => 'अंतर',
            'gap_info' => 'मीडिया और विवरण कॉलम के बीच की दूरी',

            'appearance_header' => 'दिखावट',
        ],
    ],

    'category-page' => [
        'name' => 'श्रेणी उत्पाद',
        'description' => 'वर्तमान श्रेणी के उत्पादों को फ़िल्टरिंग और सॉर्टिंग के साथ प्रदर्शित करता है।',

        'settings' => [
            'heading_label' => 'कस्टम शीर्षक (वैकल्पिक)',
            'columns_label' => 'ग्रिड कॉलम (डेस्कटॉप)',
            'columns_tablet_label' => 'ग्रिड कॉलम (टैबलेट)',
            'columns_mobile_label' => 'ग्रिड कॉलम (मोबाइल)',
            'filters_label' => 'फ़िल्टर दिखाएं',
            'sorting_label' => 'सॉर्टिंग दिखाएं',
            'banner_label' => 'श्रेणी बैनर दिखाएं',
        ],
    ],

    'product-reviews' => [
        'name' => 'उत्पाद समीक्षाएँ',
        'description' => 'वर्तमान उत्पाद के लिए हाल की ग्राहक समीक्षाएँ दिखाता है।',

        'settings' => [
            'rating_summary_label' => 'रेटिंग सारांश दिखाएं',
            'reviews_label' => 'व्यक्तिगत समीक्षाएँ दिखाएं',
            'limit_label' => 'दिखाने के लिए समीक्षाओं की संख्या',
        ],

        'average_rating' => 'औसत रेटिंग',
        'no_reviews' => 'अभी तक कोई समीक्षा नहीं है।',
    ],

    'text-with-image' => [
        'name' => 'चित्र के साथ पाठ',
        'description' => 'कॉन्फ़िगर करने योग्य लेआउट के साथ एक छवि के साथ पाठ सामग्री दिखाएँ।',

        'settings' => [
            'image_label' => 'चित्र',
            'image_position_label' => 'चित्र की स्थिति',
            'left_label' => 'पहले चित्र',
            'right_label' => 'दूसरे चित्र',

            'image_height_label' => 'चित्र की ऊँचाई',
            'image_height_auto' => 'चित्र के अनुसार समायोजित करें',
            'image_height_sm' => 'छोटा',
            'image_height_md' => 'मध्यम',
            'image_height_lg' => 'बड़ा',

            'image_width_label' => 'चित्र की चौड़ाई (डेस्कटॉप)',
            'width_sm' => 'छोटा',
            'width_md' => 'मध्यम',
            'width_lg' => 'बड़ा',

            'content_position_label' => 'सामग्री की स्थिति (ऊर्ध्वाधर)',
            'position_top' => 'ऊपर',
            'position_middle' => 'मध्य',
            'position_bottom' => 'नीचे',

            'content_align_label' => 'सामग्री संरेखण (डेस्कटॉप)',
            'content_align_mobile_label' => 'सामग्री संरेखण (मोबाइल)',
            'align_start' => 'प्रारंभ',
            'align_center' => 'मध्य',
            'align_end' => 'अंत',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'शीर्षक',
                'settings' => [
                    'text_label' => 'शीर्षक पाठ',
                    'text_default' => 'चित्र के साथ पाठ',
                ],
            ],
            'body' => [
                'label' => 'मुख्य पाठ',
                'settings' => [
                    'content_label' => 'पैरा का पाठ',
                    'content_default' => 'अपने चुने हुए उत्पाद, संग्रह, या ब्लॉग पोस्ट पर ध्यान केंद्रित करने के लिए पाठ को एक चित्र के साथ जोड़ें। उपलब्धता, शैली, या यहां तक कि समीक्षा जैसी जानकारी जोड़ें।',
                ],
            ],
            'button' => [
                'label' => 'बटन',
                'settings' => [
                    'text_label' => 'बटन का पाठ',
                    'url_label' => 'बटन का URL',
                    'text_default' => 'बटन का पाठ',
                    'variant_label' => 'बटन का प्रकार',

                    'variant_primary' => 'प्राथमिक',
                    'variant_secondary' => 'माध्यमिक',
                    'variant_accent' => 'प्रभावशाली',
                    'variant_neutral' => 'तटस्थ',

                    'style_label' => 'बटन की शैली',
                    'style_solid' => 'ठोस',
                    'style_soft' => 'मुलायम',
                    'style_outline' => 'आउटलाइन',
                    'style_ghost' => 'घोस्ट',
                ],
            ],
        ],
    ],

    'collage' => [
        'name' => 'कोलाज',
        'description' => 'छवियों, उत्पादों और श्रेणियों को मिलाने के लिए लचीला लेआउट।',

        'settings' => [
            'heading_label' => 'शीर्षक',
            'heading_size_label' => 'शीर्षक का आकार',
        ],

        'blocks' => [
            'image' => [
                'label' => 'छवि',
                'settings' => [
                    'image_label' => 'छवि',
                ],
            ],
            'product' => [
                'label' => 'उत्पाद',
                'settings' => [
                    'product_label' => 'उत्पाद',
                ],
            ],
            'custom' => [
                'label' => 'कस्टम सामग्री',
                'settings' => [
                    'image_label' => 'छवि',
                    'title_label' => 'शीर्षक',
                    'text_label' => 'विवरण',
                    'link_label' => 'लिंक',
                    'link_text_label' => 'लिंक पाठ',
                ],
            ],
            'category' => [
                'label' => 'श्रेणी',
                'settings' => [
                    'category_label' => 'श्रेणी चुनें',
                ],
            ],
        ],
    ],

    'contact-form' => [
        'name' => 'संपर्क फ़ॉर्म',
        'description' => 'नाम, ईमेल, और संदेश फ़ॉर्म के साथ एक सरल अनुभाग।',

        'success_message' => 'धन्यवाद! आपका संदेश भेज दिया गया है।',
    ],

    'breadcrumbs' => [
        'name' => 'ब्रेडक्रम्ब्स',
        'description' => 'नेविगेशन के लिए एक ब्रेडक्रम्ब ट्रेल दिखाता है।',
        'settings' => [
            'separator_label' => 'सेपरेटर कैरेक्टर',
        ],
    ],

    'cart-content' => [
        'name' => 'कार्ट सामग्री',
        'description' => 'ग्राहक की कार्ट की सामग्री का सारांश दिखाता है, जिसमें उत्पाद, मात्राएँ, मूल्य और आइटम अपडेट या हटाने जैसी क्रियाएँ शामिल हैं।',
    ],

    'checkout' => [
        'name' => 'चेकआउट',
        'description' => 'बिलिंग विवरण, कार्ट सारांश, कूपन इनपुट और कुल गणना सहित एक पूर्ण चेकआउट लेआउट।',
    ],

    'checkout-success' => [
        'name' => 'चेकआउट सफल',
        'description' => 'सफल चेकआउट के बाद आदेश की पुष्टि संदेश को सारांश विवरण के साथ प्रदर्शित करता है।',
    ],

    'search-result' => [
        'name' => 'खोज परिणाम',
        'description' => 'उपयोगकर्ता की खोज क्वेरी से मेल खाने वाले उत्पाद या सामग्री को फ़िल्टरिंग और पेजिनेशन के समर्थन के साथ प्रदर्शित करता है।',
    ],

    'compare' => [
        'name' => 'उत्पादों की तुलना',
        'description' => 'चुने गए उत्पादों की विशेषताओं और गुणों के साथ तुलना तालिका प्रदर्शित करता है।',
    ],

    'wishlist' => [
        'name' => 'विशलिस्ट',
        'description' => 'ग्राहक के सहेजे गए विशलिस्ट आइटम को कार्ट में जोड़ने या हटाने के विकल्पों के साथ प्रदर्शित करता है।',
    ],

    'customer-edit-address' => [
        'name' => 'पता संपादित करें',
    ],

    'customer-add-address' => [
        'name' => 'पता जोड़ें',
    ],

    'customer-addresses' => [
        'name' => 'पते',
    ],

    'customer-orders' => [
        'name' => 'ऑर्डर',
    ],

    'customer-order-details' => [
        'name' => 'ऑर्डर विवरण',
    ],

    'customer-reviews' => [
        'name' => 'समीक्षाएँ',
    ],

    'downloadables' => [
        'name' => 'डाउनलोड',
    ],

    'login-form' => [
        'name' => 'लॉगिन फॉर्म',
    ],

    'register-form' => [
        'name' => 'रजिस्ट्रेशन फॉर्म',
    ],

    'profile' => [
        'name' => 'प्रोफ़ाइल',
    ],

    'profile-form' => [
        'name' => 'प्रोफ़ाइल फॉर्म',
    ],

    'cms-page' => [
        'name' => 'CMS पेज',
        'description' => 'CMS पेज की सामग्री को प्रस्तुत करता है, जिससे स्थैतिक या गतिशील पाठ और मीडिया को सेक्शन लेआउट में प्रदर्शित किया जा सकता है।',
    ],

    'error-page' => [
        'name' => 'त्रुटि पृष्ठ',
        'description' => 'एक स्टाइल की गई त्रुटि संदेश (जैसे 404 या 500) को वैकल्पिक नेविगेशन लिंक या खोज विकल्प के साथ प्रदर्शित करता है ताकि उपयोगकर्ताओं को पुनः मार्गदर्शन मिल सके।',
    ],

    'flex-section' => [
        'name' => 'लचीला सेक्शन',
        'description' => 'एक सार्वभौमिक सेक्शन जो व्यापक लेआउट, आकार और शैली नियंत्रणों के साथ किसी भी ब्लॉक प्रकार को स्वीकार करता है।',

        'empty_state' => 'शुरू करने के लिए ब्लॉक जोड़ें',

        'presets' => [
            'custom_section' => [
                'name' => 'कस्टम सेक्शन',
            ],
            'rich_text' => [
                'name' => 'रिच टेक्स्ट सेक्शन',
                'heading' => 'नए आगमन',
                'description' => 'हम ऐसी चीज़ें बनाते हैं जो बेहतर काम करती हैं और लंबे समय तक चलती हैं। हमारे उत्पाद साफ़ डिज़ाइन और ईमानदार सामग्री से वास्तविक समस्याओं को हल करते हैं।',
                'cta' => 'अभी खरीदें',
            ],
            'faq' => [
                'name' => 'FAQ सेक्शन',
                'heading' => 'अक्सर पूछे जाने वाले प्रश्न',
                'items' => [
                    'return_policy' => [
                        'question' => 'रिटर्न नीति क्या है?',
                        'answer' => 'हमारा लक्ष्य है कि हर ग्राहक अपनी खरीदारी से पूरी तरह संतुष्ट हो। यदि ऐसा नहीं है, तो हमें बताएं और हम इसे सही करने के लिए आपके साथ काम करने की पूरी कोशिश करेंगे।',
                    ],
                    'final_sale' => [
                        'question' => 'क्या कोई खरीदारी अंतिम बिक्री है?',
                        'answer' => 'हम कुछ वस्तुओं पर रिटर्न स्वीकार नहीं कर सकते। खरीदारी से पहले इन्हें सावधानी से चिह्नित किया जाएगा।',
                    ],
                    'order_delivery' => [
                        'question' => 'मुझे अपना ऑर्डर कब मिलेगा?',
                        'answer' => 'हम आपके ऑर्डर को जल्द से जल्द भेजने के लिए तेजी से काम करेंगे। ऑर्डर भेजे जाने के बाद, आपको अधिक जानकारी वाला ईमेल मिलेगा। डिलीवरी समय आपके स्थान के अनुसार अलग-अलग हो सकता है।',
                    ],
                    'manufacturing' => [
                        'question' => 'आपके उत्पाद कहाँ बनाए जाते हैं?',
                        'answer' => 'हमारे उत्पाद स्थानीय और वैश्विक दोनों स्तरों पर बनाए जाते हैं। हम अपने निर्माण भागीदारों को सावधानी से चुनते हैं ताकि हमारे उत्पाद उच्च गुणवत्ता और उचित मूल्य के हों।',
                    ],
                    'shipping_cost' => [
                        'question' => 'शिपिंग की लागत कितनी है?',
                        'answer' => 'शिपिंग आपकी लोकेशन और ऑर्डर की वस्तुओं के आधार पर गणना की जाती है। खरीदारी करने से पहले आपको हमेशा शिपिंग मूल्य पता होगा।',
                    ],
                ],
            ],
            'image_with_text' => [
                'name' => 'छवि के साथ पाठ',
                'content' => 'सामग्री',
                'heading' => 'चित्र के साथ पाठ',
                'description' => 'अपने चुने हुए उत्पाद, संग्रह, या ब्लॉग पोस्ट पर ध्यान केंद्रित करने के लिए पाठ को एक चित्र के साथ जोड़ें। उपलब्धता, शैली, या यहां तक कि समीक्षा जैसी जानकारी जोड़ें।',
                'cta' => 'अभी खरीदें',
            ],
            'hero_banner' => [
                'name' => 'हीरो बैनर',
                'heading' => 'हमारे स्टोर में आपका स्वागत है',
                'description' => 'हमारे सर्वश्रेष्ठ उत्पाद और ऑफ़र खोजें।',
                'buttons' => 'बटन',
                'cta' => 'कलेक्शन देखें',
            ],
            'feature_icons' => [
                'name' => 'फ़ीचर आइकॉन्स',
                'heading' => 'हमसे खरीदारी क्यों करें?',
                'description' => 'हमारी ग्राहक-केंद्रित सुविधाएँ देखें',
                'grid' => 'फ़ीचर ग्रिड',
                'feature' => 'फ़ीचर',
                'items' => [
                    'free_shipping' => [
                        'title' => 'मुफ़्त शिपिंग',
                        'description' => '$50 से अधिक के ऑर्डर पर मुफ़्त शिपिंग',
                    ],
                    'support' => [
                        'title' => '24/7 सहायता',
                        'description' => 'कभी भी, कहीं से भी हमसे संपर्क करें',
                    ],
                    'secure_payment' => [
                        'title' => 'सुरक्षित भुगतान',
                        'description' => '100% सुरक्षित भुगतान की गारंटी',
                    ],
                    'easy_returns' => [
                        'title' => 'आसान रिटर्न',
                        'description' => '30-दिन की रिटर्न नीति',
                    ],
                ],
            ],
        ],

        'settings' => [
            'layout_header' => 'लेआउट',

            'direction_label' => 'दिशा',
            'direction_options' => [
                'horizontal' => 'क्षैतिज',
                'vertical' => 'ऊर्ध्वाधर',
            ],
            'gap_label' => 'आइटमों के बीच अंतर',
            'gap_info' => 'चाइल्ड ब्लॉकों के बीच की दूरी',

            'size_header' => 'आकार',

            'section_width_label' => 'सामग्री की चौड़ाई',
            'section_width_options' => [
                'full' => 'पूर्ण चौड़ाई',
                'container' => 'कंटेनर',
            ],
            'section_width_info' => 'कंटेनर अधिकतम चौड़ाई सीमित करता है और सामग्री को केंद्र में रखता है',

            'section_height_label' => 'सेक्शन की ऊंचाई',
            'section_height_options' => [
                'auto' => 'स्वचालित',
                'xs' => 'बहुत छोटा',
                'sm' => 'छोटा',
                'md' => 'मध्यम',
                'lg' => 'बड़ा',
                'screen' => 'पूर्ण स्क्रीन',
                'custom' => 'कस्टम',
            ],

            'section_height_custom_label' => 'कस्टम ऊंचाई',

            'appearance_header' => 'दिखावट',

            'color_scheme_label' => 'रंग योजना',

            'background_type_label' => 'पृष्ठभूमि प्रकार',
            'background_type_options' => [
                'none' => 'कोई नहीं',
                'color' => 'रंग',
                'gradient' => 'ग्रेडिएंट',
                'image' => 'छवि',
            ],

            'background_color_label' => 'पृष्ठभूमि रंग',
            'background_gradient_label' => 'पृष्ठभूमि ग्रेडिएंट',
            'background_image_label' => 'पृष्ठभूमि छवि',

            'background_position_label' => 'पृष्ठभूमि स्थिति',
            'background_position_options' => [
                'center' => 'केंद्र',
                'top' => 'ऊपर',
                'bottom' => 'नीचे',
                'left' => 'बाएं',
                'right' => 'दाएं',
            ],

            'background_size_label' => 'पृष्ठभूमि आकार',
            'background_size_options' => [
                'cover' => 'कवर',
                'contain' => 'कंटेन',
                'auto' => 'स्वचालित',
            ],

            'background_repeat_label' => 'पृष्ठभूमि दोहराव',
            'background_repeat_options' => [
                'no_repeat' => 'दोहराएं नहीं',
                'repeat' => 'दोहराएं',
                'repeat_x' => 'क्षैतिज रूप से दोहराएं',
                'repeat_y' => 'ऊर्ध्वाधर रूप से दोहराएं',
            ],

            'border_label' => 'बॉर्डर दिखाएं',
            'border_width_label' => 'बॉर्डर की चौड़ाई',
            'border_opacity_label' => 'बॉर्डर अपारदर्शिता',
            'border_radius_label' => 'बॉर्डर रेडियस',
            'border_radius_options' => [
                'none' => 'कोई नहीं',
                'sm' => 'छोटा',
                'md' => 'मध्यम',
                'lg' => 'बड़ा',
                'xl' => 'बहुत बड़ा',
                'full' => 'पूर्ण',
            ],

            'toggle_overlay_label' => 'ओवरले दिखाएं',
            'toggle_overlay_info' => 'पृष्ठभूमि मीडिया के ऊपर ओवरले जोड़ें',

            'overlay_color_label' => 'ओवरले रंग',
            'overlay_color_options' => [
                'black' => 'काला',
                'white' => 'सफेद',
            ],

            'overlay_style_label' => 'ओवरले शैली',
            'overlay_style_options' => [
                'solid' => 'ठोस',
                'gradient' => 'ग्रेडिएंट',
            ],

            'overlay_gradient_label' => 'ओवरले ग्रेडिएंट',
        ],
    ],

    'feature-icons' => [
        'name' => 'फ़ीचर आइकॉन्स',
        'description' => 'शीर्षकों और छोटे विवरणों के साथ आइकॉन्स की एक पंक्ति प्रदर्शित करें।',

        'settings' => [
            'heading_label' => 'सेक्शन शीर्षक',
            'description_label' => 'सेक्शन विवरण',
            'icon_size_label' => 'आइकन का आकार (पिक्सेल)',
            'columns_label' => 'डेस्कटॉप पर कॉलम्स',
            'layout_label' => 'लेआउट',
            'layout_horizontal' => 'आइकन बाएँ, टेक्स्ट दाएँ',
            'layout_vertical' => 'आइकन ऊपर, टेक्स्ट नीचे',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'फ़ीचर',
                'settings' => [
                    'icon_label' => 'आइकन',
                    'title_label' => 'शीर्षक',
                    'text_label' => 'विवरण',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'शीर्षक',
            'text' => 'फ़ीचर को विस्तार से समझाने के लिए अतिरिक्त टेक्स्ट',
        ],
    ],

];
