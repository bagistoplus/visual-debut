<?php

return [
    'announcement-bar' => [
        'name' => 'Barre d\'annonce',
        'description' => 'Une barre d\'annonce simple pour afficher des informations importantes à vos clients.',
        'settings' => [
            'text_label'      => 'Texte de l\'annonce',
            'default_text'    => 'Livraison gratuite pour les commandes supérieures à 50 $',
            'link_label'      => 'Lien',
            'variant_label'   => 'Variante d\'arrière-plan',
            'scheme_label'    => 'Palette de couleurs',
            'scheme_note'     => 'Cela remplace la palette de couleurs globale du thème. Les modifications du thème principal n\'affecteront pas cette section.'
        ],
    ],

    'hero-banner' => [
        'nom' => 'Bannière Hero',
        'description' => 'Une bannière pleine largeur avec du texte et des boutons d’appel à l’action.',

        'settings' => [
            'scheme_label'           => 'Palette de couleurs',
            'background_label'       => 'Image de fond',
            'overlay_label'          => 'Afficher l\'overlay',
            'overlay_opacity_label'  => 'Opacité de l\'overlay (%)',
            'height_label'           => 'Hauteur de la bannière',
            'scheme_note' => 'Cela remplace la palette de couleurs globale du thème. Les modifications du thème principal n\'affecteront pas cette section.'
        ],
        'blocks' => [
            'heading' => [
                'name'          => 'Titre',
                'text_label'    => 'Texte du titre',
                'default_text'  => 'Bienvenue dans notre boutique',
            ],
            'subtext' => [
                'name'          => 'Sous-texte',
                'text_label'    => 'Sous-texte',
                'default_text'  => 'Découvrez nos meilleurs produits et offres.',
            ],
            'button' => [
                'name'          => 'Bouton',
                'text_label'    => 'Texte du bouton',
                'default_text'  => 'Voir les collections',
                'link_label'    => 'Lien du bouton',
                'color_label'   => 'Variante'
            ],
        ],
    ],

    'header' => [
        'name' => 'En-tête',
        'description' => '',
        'blocks' => [
            'logo' => [
                'name' => 'Nom/Logo',
                'settings' => [
                    'logo_image_label' => 'Télécharger le logo',
                    'logo_text_label' => 'Texte du logo',
                    'mobile_logo_image_label' => 'Logo mobile',
                    'logo_text_placeholder' => 'Affiché en l\'absence d\'image de logo',
                    'push_to_left' => 'Aligner cet élément à gauche',
                    'push_to_right' => 'Aligner cet élément à droite'
                ],
            ],
            'nav' => [
                'name' => 'Navigation',
                'settings' => [
                    'push_to_left' => 'Aligner cet élément à gauche',
                    'push_to_right' => 'Aligner cet élément à droite'
                ]
            ],
            'currency' => [
                'name' => 'Sélecteur de devise',
            ],
            'locale' => [
                'name' => 'Sélecteur de langue',
                'settings' => [
                    'icon_label' => 'Icône'
                ]
            ],
            'search' => [
                'name' => 'Formulaire de recherche',
                'placeholder' => 'Recherchez des produits ici',
                'settings' => [
                    'search_icon_label' => 'Icône de recherche',
                    'image_search_icon_label' => 'Icône de recherche par image'
                ]
            ],
            'compare' => [
                'name' => 'Comparer',
                'settings' => [
                    'icon_label' => 'Icône'
                ]
            ],
            'user' => [
                'name' => 'Menu utilisateur',
                'sign-in' => 'Connexion',
                'sign-up' => 'S’inscrire',
                'settings' => [
                    'icon_label' => 'Icône',
                    'guest_heading_label' => 'Titre pour les invités',
                    'guest_description_label' => 'Description pour les invités',
                    'guest_heading_default' => 'Bienvenue invité',
                    'guest_description_default' => 'Gérer le panier, les commandes et la liste de souhaits',
                ]
            ],
            'cart' => [
                'name' => 'Aperçu du panier',
                'settings' => [
                    'heading_label' => 'Titre',
                    'description_label' => 'Description',
                    'description_default' => 'Bénéficiez de jusqu\'à 30% de réduction sur votre 1ère commande',
                ]
            ],
        ],
    ],

    'footer' => [
        'name' => 'Pied de page',
        'description' => 'Section inférieure de votre site avec des liens et du branding.',
        'settings' => [
            'heading_label' => 'Titre',
            'heading_default' => 'Ma boutique',
            'description_label' => 'Description',
            'description_default' => 'Ajoutez ici une description de votre boutique',
            'show_social_links_label' => 'Afficher les liens sociaux',
            'show_social_links_info' => 'Vous pouvez configurer les liens dans les paramètres du thème',
        ],
        'blocks' => [
            'group' => [
                'name' => 'Groupe de liens',
                'settings' => [
                    'title_label' => 'Nom du groupe',
                    'title_default' => 'Groupe de liens',
                ],
            ],
            'link' => [
                'name' => 'Lien',
                'settings' => [
                    'text_label' => 'Texte du lien',
                    'text_default' => 'Lien',
                    'link_label' => 'Lien',
                ],
            ],
        ],
    ],

    'hero' => [
        'name' => 'Héros',
        'description' => '',
        'settings' => [
            'image_label' => 'Image',
            'height_label' => 'Hauteur',
            'height_small' => 'Petite',
            'height_medium' => 'Moyenne',
            'height_large' => 'Grande',
            'header_content' => 'Contenu',
            'content_position_label' => 'Position du contenu',
            'content_position_top' => 'Haut',
            'content_position_middle' => 'Milieu',
            'content_position_bottom' => 'Bas',
            'show_overlay_label' => 'Afficher l\'overlay',
            'overlay_opacity_label' => 'Opacité de l\'overlay',
        ],
        'blocks' => [
            'heading' => [
                'name' => 'Titre',
                'settings' => [
                    'heading_label' => 'Titre',
                    'heading_default' => 'Titre principal',
                    'heading_size_label' => 'Taille du titre',
                    'heading_size_small' => 'Petite',
                    'heading_size_medium' => 'Moyenne',
                    'heading_size_large' => 'Grande',
                ],
            ],
            'subheading' => [
                'name' => 'Sous-titre',
                'settings' => [
                    'subheading_label' => 'Sous-titre',
                    'subheading_default' => 'Sous-titre principal',
                ],
            ],
            'button' => [
                'name' => 'Appel à l\'action',
                'settings' => [
                    'text_label' => 'Texte du bouton',
                    'text_default' => 'Acheter maintenant',
                    'link_label' => 'Lien du bouton',
                ],
            ],
        ],
    ],

    'category-list' => [
        'name' => 'Liste des catégories',
        'description' => 'Afficher une grille de catégories sélectionnées avec images et liens.',
        'settings' => [
            'heading_label' => 'Titre',
            'heading_default' => 'Acheter par catégorie',
            'heading_size_label' => 'Taille du titre',
            'size_small_label' => 'Petite',
            'size_medium_label' => 'Moyenne',
            'size_large_label' => 'Grande',
            'columns_desktop_label' => 'Colonnes (bureau)',
            'columns_mobile_label' => 'Colonnes (mobile)',
        ],
        'blocks' => [
            'category' => [
                'name' => 'Catégorie',
                'settings' => [
                    'category_label' => 'Catégorie',
                ],
            ],
        ],
    ],

    'featured-products' => [
        'name' => 'Produits en vedette',
        'description' => 'Afficher des produits choisis ou automatiquement chargés, comme en vedette ou nouveaux.',
        'settings' => [
            'heading_label' => 'Titre',
            'heading_default' => 'Produits en vedette',
            'subheading_label' => 'Sous-titre',
            'subheading_default' => 'Découvrez nos derniers produits',
            'nb_products_label' => 'Nombre de produits à afficher',
            'nb_products_info' => 'Utilisé uniquement si aucun bloc produit n\'est ajouté',
            'product_type_label' => 'Type de produit',
            'product_type_info' => 'Utilisé uniquement si aucun bloc produit n\'est ajouté',
            'new_label' => 'Nouveaux produits',
            'featured_label' => 'Produits en vedette',
        ],
        'blocks' => [
            'product' => [
                'name' => 'Produit',
                'settings' => [
                    'product_label' => 'Produit',
                    'product_info' => 'Sélectionnez un produit à afficher',
                ],
            ],
        ],
    ],

    'newsletter' => [
        'name' => 'Inscription à la newsletter',
        'description' => 'Permet aux clients de s\'abonner aux mises à jour et promotions.',
        'settings' => [
            'heading_label' => 'Titre',
            'heading_default' => 'Inscrivez-vous à notre newsletter',
            'description_label' => 'Description',
            'description_default' => 'Utilisez ce texte pour partager des informations sur votre marque avec vos clients. Décrivez un produit, partagez des annonces ou accueillez les clients dans votre boutique.',
            'scheme_label' => 'Palette de couleurs',
            'scheme_note' => 'Cela remplace la palette de couleurs globale du thème. Les modifications du thème principal n\'affecteront pas cette section.'
        ],
    ],

    'product-details' => [
        'name' => 'Détails du produit',
        'description' => 'Affiche les informations produit avec des blocs individuels : titre, prix, description, panier.',
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Droite',
            'position_under_gallery' => 'Sous la galerie d\'images',
        ],
        'blocks' => [
            'text' => [
                'name' => 'Texte',
                'settings' => [
                    'text_label' => 'Texte',
                ],
            ],
            'title' => [
                'name' => 'Titre',
                'settings' => [
                    'title_tag_label' => 'Balise de titre',
                    'title_size' => 'Taille du titre'
                ]
            ],
            'price' => [
                'name' => 'Prix',
            ],
            'rating' => [
                'name' => 'Évaluation',
            ],
            'short-description' => [
                'name' => 'Description courte',
            ],
            'quantity-selector' => [
                'name' => 'Sélecteur de quantité',
            ],
            'buy-buttons' => [
                'name' => 'Boutons d\'achat',
                'settings' => [
                    'enable_buy_now_label' => 'Afficher le bouton acheter maintenant',
                    'enable_buy_now_info' => 'Activez cette option pour afficher un bouton "Acheter maintenant" permettant aux clients de passer directement à la caisse.',
                ],
            ],
            'description' => [
                'name' => 'Description du produit',
                'settings' => [
                    'show_in_panel_label' => 'Afficher dans un panneau repliable',
                    'should_open_panel_label' => 'Ouvrir le panneau par défaut'
                ]
            ],
            'collapsible' => [
                'name' => 'Panneau repliable',
                'settings' => [
                    'icon_label' => 'Icône',
                    'heading_label' => 'Titre',
                    'content_label' => 'Contenu du panneau',
                    'should_open_panel_label' => 'Ouvrir le panneau par défaut'
                ]
            ],
            'separator' => [
                'name' => 'Séparateur',
            ],
            'variant-picker' => [
                'name' => 'Sélecteur de variante',
            ],
            'grouped-options' => [
                'name' => 'Options de produits groupés',
            ],
            'bundle-options' => [
                'name' => 'Options de lot de produits',
            ],
            'downloadable-options' => [
                'name' => 'Options de produits téléchargeables',
            ],
        ],
    ],

    'category-page' => [
        'name' => 'Produits par catégorie',
        'description' => 'Affiche les produits de la catégorie actuelle avec filtrage et tri.',
        'settings' => [
            'heading_label' => 'Titre personnalisé (facultatif)',
            'columns_label' => 'Colonnes de grille (bureau)',
            'columns_tablet_label' => 'Colonnes de grille (tablette)',
            'columns_mobile_label' => 'Colonnes de grille (mobile)',
            'filters_label' => 'Afficher les filtres',
            'sorting_label' => 'Afficher le tri',
            'banner_label' => 'Afficher la bannière de catégorie',
        ],
    ],

    'product-reviews' => [
        'name' => 'Avis sur le produit',
        'description' => 'Affiche les avis récents des clients pour le produit actuel.',
        'settings' => [
            'rating_summary_label' => 'Afficher le résumé des évaluations',
            'reviews_label' => 'Afficher les avis individuels',
            'limit_label' => 'Nombre d\'avis à afficher',
        ],
        'average_rating' => 'Note moyenne',
        'no_reviews' => 'Pas encore d\'avis.',
    ],

    'text-with-image' => [
        'name'        => 'Texte avec Image',
        'description' => 'Afficher du contenu textuel accompagné d’une image avec une disposition configurable.',

        'settings' => [
            'image_label'           => 'Image',
            'image_position_label'  => 'Position de l’image',
            'left_label'            => 'Image en premier',
            'right_label'           => 'Image en second',

            'image_height_label'    => 'Hauteur de l’image',
            'image_height_auto'     => 'Adapter à l’image',
            'image_height_sm'       => 'Petite',
            'image_height_md'       => 'Moyenne',
            'image_height_lg'       => 'Grande',

            'image_width_label'     => 'Largeur de l’image (Bureau)',
            'width_sm'              => 'Petite',
            'width_md'              => 'Moyenne',
            'width_lg'              => 'Grande',

            'content_position_label'    => 'Position du contenu (Verticale)',
            'position_top'              => 'Haut',
            'position_middle'           => 'Milieu',
            'position_bottom'           => 'Bas',

            'content_align_label'       => 'Alignement du contenu (Bureau)',
            'content_align_mobile_label' => 'Alignement du contenu (Mobile)',
            'align_start'               => 'Début',
            'align_center'              => 'Centre',
            'align_end'                 => 'Fin',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'En-tête',
                'settings' => [
                    'text_label' => 'Texte de l’en-tête',
                    'text_default' => 'Image avec texte'
                ],
            ],
            'body' => [
                'label' => 'Texte principal',
                'settings' => [
                    'content_label' => 'Texte du paragraphe',
                    'content_default' => 'Associez du texte à une image pour mettre en valeur un produit, une collection ou un article de blog. Ajoutez des détails sur la disponibilité, le style ou même un avis.'
                ],
            ],
            'button' => [
                'label' => 'Bouton',
                'settings' => [
                    'text_label' => 'Texte du bouton',
                    'url_label'  => 'URL du bouton',
                    'text_default' => 'Texte du bouton',
                    'variant_label'        => 'Variante du bouton',

                    'variant_primary'      => 'Principal',
                    'variant_secondary'    => 'Secondaire',
                    'variant_accent'       => 'Accent',
                    'variant_neutral'      => 'Neutre',

                    'style_label'          => 'Style du bouton',
                    'style_solid'          => 'Plein',
                    'style_soft'           => 'Doux',
                    'style_outline'        => 'Contour',
                    'style_ghost'          => 'Fantôme',
                ],
            ],
        ],
    ],

    'collage' => [
        'name'        => 'Collage',
        'description' => 'Mise en page flexible pour mélanger des images, des produits et des catégories.',

        'settings' => [
            'heading_label'        => 'Titre',
            'heading_size_label'   => 'Taille du titre (px)',
        ],

        'blocks' => [
            'image' => [
                'label' => 'Image',
                'settings' => [
                    'image_label' => 'Image',
                ],
            ],
            'product' => [
                'label' => 'Produit',
                'settings' => [
                    'product_label' => 'Produit',
                ],
            ],
            'custom' => [
                'label' => 'Contenu personnalisé',
                'settings' => [
                    'image_label'     => 'Image',
                    'title_label'     => 'Titre',
                    'text_label'      => 'Description',
                    'link_label'      => 'Lien',
                    'link_text_label' => 'Texte du lien',
                ],
            ],
            'category' => [
                'label' => 'Catégorie',
                'settings' => [
                    'category_label' => 'Sélectionner une catégorie',
                ],
            ],
        ],
    ],

    'contact-form' => [
        'name'        => 'Formulaire de Contact',
        'description' => 'Section simple avec un formulaire de nom, e-mail et message.',

        'success_message' => 'Merci ! Votre message a été envoyé.',
    ],

    'breadcrumbs' => [
        'name' => 'Fil d’Ariane',
        'description' => 'Affiche un fil d’Ariane pour la navigation.',
        'settings' => [
            'separator_label' => 'Caractère de séparation',
        ],
    ],

    'cart-content' => [
        'name' => 'Contenu du Panier',
        'description' => 'Affiche un résumé du panier du client, y compris les produits, les quantités, les prix et les actions comme la mise à jour ou la suppression d’articles.',
    ],

    'checkout' => [
        'name' => 'Paiement',
        'description' => 'Une mise en page complète du paiement incluant les détails de facturation, le récapitulatif du panier, la saisie du coupon et le calcul du total.',
    ],

    'checkout-success' => [
        'name' => 'Confirmation de Commande',
        'description' => 'Affiche un message de confirmation de commande avec les détails du récapitulatif après un paiement réussi.',
    ],

    'search-result' => [
        'name' => 'Résultats de recherche',
        'description' => 'Affiche les produits ou contenus correspondant à la requête de recherche de l’utilisateur, avec prise en charge du filtrage et de la pagination.',
    ],

    'cms-page' => [
        'name' => 'Page CMS',
        'description' => 'Affiche le contenu d’une page CMS, permettant l’affichage de texte et de médias statiques ou dynamiques dans une mise en page sectionnée.',
    ],

    'error-page' => [
        'name' => 'Page d’erreur',
        'description' => 'Affiche un message d’erreur stylisé (par exemple 404 ou 500) avec des liens de navigation ou une recherche en option pour aider les utilisateurs à se repérer.',
    ],

    'feature-icons' => [
        'name' => 'Icônes de Fonctionnalité',
        'description' => 'Afficher une rangée d’icônes avec des titres et de courtes descriptions.',

        'settings' => [
            'heading_label'     => 'Titre de la section',
            'description_label' => 'Description de la section',
            'icon_size_label'   => 'Taille des icônes (px)',
            'columns_label'     => 'Colonnes sur ordinateur',
            'layout_label'      => 'Disposition',
            'layout_horizontal' => 'Icône à gauche, texte à droite',
            'layout_vertical'   => 'Icône en haut, texte en dessous',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'Fonctionnalité',
                'settings' => [
                    'icon_label'  => 'Icône',
                    'title_label' => 'Titre',
                    'text_label'  => 'Description',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'Titre',
            'text'  => 'Un texte complémentaire pour développer la fonctionnalité',
        ],
    ],

];
