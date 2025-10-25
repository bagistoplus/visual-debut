<?php

return [
    'announcement-bar' => [
        'name' => 'घोषणा पट्टी',
        'description' => 'अपने ग्राहकों को महत्वपूर्ण जानकारी दिखाने के लिए एक सरल घोषणा पट्टी।',
        'settings' => [
            'text_label'      => 'घोषणा पाठ',
            'default_text'    => '$50 से अधिक के ऑर्डर पर निःशुल्क शिपिंग',
            'link_label'      => 'लिंक',
            'variant_label'   => 'पृष्ठभूमि प्रकार',

            'scheme_label'    => 'रंग योजना',
            'scheme_note'     => 'यह वैश्विक थीम रंग योजना को ओवरराइड करता है। मुख्य थीम योजना में किए गए परिवर्तन इस अनुभाग को प्रभावित नहीं करेंगे।'
        ],
    ],

    'hero-banner' => [
        'name' => 'हीरो बैनर',
        'description' => 'एक पूर्ण-चौड़ाई वाला बैनर जिसमें पाठ और कॉल-टू-एक्शन बटन होते हैं।',

        'settings' => [
            'scheme_label'           => 'रंग योजना',
            'background_label'       => 'पृष्ठभूमि छवि',
            'overlay_label'          => 'ओवरले दिखाएं',
            'overlay_opacity_label'  => 'ओवरले अपारदर्शिता (%)',
            'height_label'           => 'बैनर ऊंचाई',
            'scheme_note' => 'यह वैश्विक थीम रंग योजना को ओवरराइड करता है। मुख्य थीम योजना में किए गए परिवर्तन इस अनुभाग को प्रभावित नहीं करेंगे।'
        ],

        'blocks' => [
            'heading' => [
                'name'          => 'शीर्षक',
                'text_label'    => 'शीर्षक पाठ',
                'default_text'  => 'हमारे स्टोर में आपका स्वागत है',
            ],
            'subtext' => [
                'name'          => 'उप-पाठ',
                'text_label'    => 'उप-पाठ',
                'default_text'  => 'हमारे सर्वश्रेष्ठ उत्पाद और ऑफ़र खोजें।',
            ],
            'button' => [
                'name'          => 'बटन',
                'text_label'    => 'बटन पाठ',
                'default_text'  => 'कलेक्शन देखें',
                'link_label'    => 'बटन लिंक',
                'color_label'   => 'प्रकार'
            ],
        ],
    ],


    'header' => [
        'name' => 'हेडर',
        'description' => '',
        'blocks' => [
            'logo' => [
                'name' => 'नाम/लोगो',
                'settings' => [
                    'logo_image_label' => 'लोगो अपलोड करें',
                    'logo_text_label' => 'लोगो पाठ',
                    'mobile_logo_image_label' => 'मोबाइल लोगो',
                    'logo_text_placeholder' => 'जब कोई लोगो छवि सेट नहीं हो तब प्रदर्शित होता है',
                    'push_to_left' => 'इस तत्व को प्रारंभ में ले जाएं',
                    'push_to_right' => 'इस तत्व को अंत में ले जाएं'
                ],
            ],
            'nav' => [
                'name' => 'नेविगेशन',
                'settings' => [
                    'push_to_left' => 'इस तत्व को प्रारंभ में ले जाएं',
                    'push_to_right' => 'इस तत्व को अंत में ले जाएं'
                ]
            ],
            'currency' => [
                'name' => 'मुद्रा चयनकर्ता',
            ],
            'locale' => [
                'name' => 'भाषा चयनकर्ता',
                'settings' => [
                    'icon_label' => 'आइकन'
                ]
            ],
            'search' => [
                'name' => 'खोज फ़ॉर्म',
                'placeholder' => 'यहाँ उत्पाद खोजें',
                'settings' => [
                    'search_icon_label' => 'खोज आइकन',
                    'image_search_icon_label' => 'छवि खोज आइकन'
                ]
            ],
            'compare' => [
                'name' => 'तुलना करें',
                'settings' => [
                    'icon_label' => 'आइकन'
                ]
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
                ]
            ],
            'cart' => [
                'name' => 'कार्ट पूर्वावलोकन',
                'settings' => [
                    'heading_label' => 'शीर्षक',
                    'description_label' => 'विवरण',
                    'description_default' => 'अपने पहले आदेश पर 30% तक की छूट पाएं',
                ]
            ],
        ],
    ],


    'footer' => [
        'name' => 'फुटर',
        'description' => 'आपकी वेबसाइट का निचला भाग, जिसमें लिंक और ब्रांडिंग होती है।',

        'settings' => [
            'heading_label' => 'शीर्षक',
            'heading_default' => 'माई स्टोर',

            'description_label' => 'विवरण',
            'description_default' => 'यहाँ अपने स्टोर का विवरण जोड़ें',

            'show_social_links_label' => 'सोशल लिंक दिखाएं',
            'show_social_links_info' => 'आप थीम सेटिंग्स में लिंक कॉन्फ़िगर कर सकते हैं',
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
        'description' => 'चयनित श्रेणियों की ग्रिड को छवियों और लिंक के साथ प्रदर्शित करें।',
        'settings' => [
            'heading_label'         => 'शीर्षक',
            'heading_default'       => 'श्रेणी अनुसार खरीदारी करें',

            'heading_size_label'    => 'शीर्षक का आकार',
            'size_small_label'      => 'छोटा',
            'size_medium_label'     => 'मध्यम',
            'size_large_label'      => 'बड़ा',

            'columns_desktop_label' => 'कॉलम (डेस्कटॉप)',
            'columns_mobile_label'  => 'कॉलम (मोबाइल)',
        ],
        'blocks' => [
            'category' => [
                'name' => 'श्रेणी',
                'settings' => [
                    'category_label' => 'श्रेणी',
                ],
            ],
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

            'new_label'             => 'नए उत्पाद',
            'featured_label'        => 'विशेष उत्पाद',
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


    'newsletter' => [
        'name'        => 'न्यूज़लेटर साइनअप',
        'description' => 'ग्राहकों को अपडेट और प्रमोशन के लिए सदस्यता लेने की अनुमति दें।',

        'settings' => [
            'heading_label' => 'शीर्षक',
            'heading_default' => 'हमारे न्यूज़लेटर के लिए साइन अप करें',

            'description_label' => 'विवरण',
            'description_default' => 'अपने ब्रांड के बारे में जानकारी साझा करने के लिए इस पाठ का उपयोग करें। किसी उत्पाद का वर्णन करें, घोषणाएँ साझा करें, या ग्राहकों का अपने स्टोर में स्वागत करें।',

            'scheme_label'    => 'रंग योजना',
            'scheme_note'     => 'यह वैश्विक थीम रंग योजना को ओवरराइड करता है। मुख्य थीम योजना में किए गए परिवर्तन इस अनुभाग को प्रभावित नहीं करेंगे।'
        ],
    ],

    'category-page' => [
        'name'        => 'श्रेणी उत्पाद',
        'description' => 'वर्तमान श्रेणी के उत्पादों को फ़िल्टरिंग और सॉर्टिंग के साथ प्रदर्शित करता है।',

        'settings' => [
            'heading_label'         => 'कस्टम शीर्षक (वैकल्पिक)',
            'columns_label'         => 'ग्रिड कॉलम (डेस्कटॉप)',
            'columns_tablet_label'  => 'ग्रिड कॉलम (टैबलेट)',
            'columns_mobile_label'  => 'ग्रिड कॉलम (मोबाइल)',
            'filters_label'         => 'फ़िल्टर दिखाएं',
            'sorting_label'         => 'सॉर्टिंग दिखाएं',
            'banner_label'          => 'श्रेणी बैनर दिखाएं',
        ],
    ],


    'product-reviews' => [
        'name'        => 'उत्पाद समीक्षाएँ',
        'description' => 'वर्तमान उत्पाद के लिए हाल की ग्राहक समीक्षाएँ दिखाता है।',

        'settings' => [
            'rating_summary_label' => 'रेटिंग सारांश दिखाएं',
            'reviews_label'        => 'व्यक्तिगत समीक्षाएँ दिखाएं',
            'limit_label'          => 'दिखाने के लिए समीक्षाओं की संख्या',
        ],

        'average_rating' => 'औसत रेटिंग',
        'no_reviews'     => 'अभी तक कोई समीक्षा नहीं है।',
    ],

    'text-with-image' => [
        'name'        => 'चित्र के साथ पाठ',
        'description' => 'कॉन्फ़िगर करने योग्य लेआउट के साथ एक छवि के साथ पाठ सामग्री दिखाएँ।',

        'settings' => [
            'image_label'           => 'चित्र',
            'image_position_label'  => 'चित्र की स्थिति',
            'left_label'            => 'पहले चित्र',
            'right_label'           => 'दूसरे चित्र',

            'image_height_label'    => 'चित्र की ऊँचाई',
            'image_height_auto'     => 'चित्र के अनुसार समायोजित करें',
            'image_height_sm'       => 'छोटा',
            'image_height_md'       => 'मध्यम',
            'image_height_lg'       => 'बड़ा',

            'image_width_label'     => 'चित्र की चौड़ाई (डेस्कटॉप)',
            'width_sm'              => 'छोटा',
            'width_md'              => 'मध्यम',
            'width_lg'              => 'बड़ा',

            'content_position_label'    => 'सामग्री की स्थिति (ऊर्ध्वाधर)',
            'position_top'              => 'ऊपर',
            'position_middle'           => 'मध्य',
            'position_bottom'           => 'नीचे',

            'content_align_label'       => 'सामग्री संरेखण (डेस्कटॉप)',
            'content_align_mobile_label' => 'सामग्री संरेखण (मोबाइल)',
            'align_start'               => 'प्रारंभ',
            'align_center'              => 'मध्य',
            'align_end'                 => 'अंत',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'शीर्षक',
                'settings' => [
                    'text_label' => 'शीर्षक पाठ',
                    'text_default' => 'चित्र के साथ पाठ'
                ],
            ],
            'body' => [
                'label' => 'मुख्य पाठ',
                'settings' => [
                    'content_label' => 'पैरा का पाठ',
                    'content_default' => 'अपने चुने हुए उत्पाद, संग्रह, या ब्लॉग पोस्ट पर ध्यान केंद्रित करने के लिए पाठ को एक चित्र के साथ जोड़ें। उपलब्धता, शैली, या यहां तक कि समीक्षा जैसी जानकारी जोड़ें।'
                ],
            ],
            'button' => [
                'label' => 'बटन',
                'settings' => [
                    'text_label' => 'बटन का पाठ',
                    'url_label'  => 'बटन का URL',
                    'text_default' => 'बटन का पाठ',
                    'variant_label'        => 'बटन का प्रकार',

                    'variant_primary'      => 'प्राथमिक',
                    'variant_secondary'    => 'माध्यमिक',
                    'variant_accent'       => 'प्रभावशाली',
                    'variant_neutral'      => 'तटस्थ',

                    'style_label'          => 'बटन की शैली',
                    'style_solid'          => 'ठोस',
                    'style_soft'           => 'मुलायम',
                    'style_outline'        => 'आउटलाइन',
                    'style_ghost'          => 'घोस्ट',
                ],
            ],
        ],
    ],

    'collage' => [
        'name'        => 'कोलाज',
        'description' => 'छवियों, उत्पादों और श्रेणियों को मिलाने के लिए लचीला लेआउट।',

        'settings' => [
            'heading_label'        => 'शीर्षक',
            'heading_size_label'   => 'शीर्षक का आकार',
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
                    'image_label'     => 'छवि',
                    'title_label'     => 'शीर्षक',
                    'text_label'      => 'विवरण',
                    'link_label'      => 'लिंक',
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
        'name'        => 'संपर्क फ़ॉर्म',
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

    'cms-page' => [
        'name' => 'CMS पेज',
        'description' => 'CMS पेज की सामग्री को प्रस्तुत करता है, जिससे स्थैतिक या गतिशील पाठ और मीडिया को सेक्शन लेआउट में प्रदर्शित किया जा सकता है।',
    ],

    'error-page' => [
        'name' => 'त्रुटि पृष्ठ',
        'description' => 'एक स्टाइल की गई त्रुटि संदेश (जैसे 404 या 500) को वैकल्पिक नेविगेशन लिंक या खोज विकल्प के साथ प्रदर्शित करता है ताकि उपयोगकर्ताओं को पुनः मार्गदर्शन मिल सके।',
    ],

    'feature-icons' => [
        'name' => 'फ़ीचर आइकॉन्स',
        'description' => 'शीर्षकों और छोटे विवरणों के साथ आइकॉन्स की एक पंक्ति प्रदर्शित करें।',

        'settings' => [
            'heading_label'     => 'सेक्शन शीर्षक',
            'description_label' => 'सेक्शन विवरण',
            'icon_size_label'   => 'आइकन का आकार (पिक्सेल)',
            'columns_label'     => 'डेस्कटॉप पर कॉलम्स',
            'layout_label'      => 'लेआउट',
            'layout_horizontal' => 'आइकन बाएँ, टेक्स्ट दाएँ',
            'layout_vertical'   => 'आइकन ऊपर, टेक्स्ट नीचे',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'फ़ीचर',
                'settings' => [
                    'icon_label'  => 'आइकन',
                    'title_label' => 'शीर्षक',
                    'text_label'  => 'विवरण',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'शीर्षक',
            'text'  => 'फ़ीचर को विस्तार से समझाने के लिए अतिरिक्त टेक्स्ट',
        ],
    ],

];
