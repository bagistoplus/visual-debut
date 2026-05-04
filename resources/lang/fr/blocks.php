<?php

return [
    'common' => [
        'product_label' => 'Produit',
        'color_scheme_label' => 'Schéma de couleurs',
        'color_scheme_info' => 'Remplacer le schéma de couleurs de la section pour ce bloc',

        // Spacing
        'spacing_header' => 'Espacement',
        'padding_header' => 'Marge intérieure',
        'padding_label' => 'Marge intérieure',
        'margin_label' => 'Marge extérieure',
        'hide_on_mobile_label' => 'Masquer sur mobile',
    ],

    'product' => [
        'settings' => [
            'product_info' => 'Sélectionnez un produit à afficher',
        ],
    ],

    'product-card-group' => [
        'name' => 'Groupe de cartes produit',
    ],

    'category' => [
        'settings' => [
            'category_label' => 'Catégorie',
        ],
    ],

    'category-card' => [
        'settings' => [
            'category_label' => 'Catégorie',
        ],
        'presets' => [
            'overlay' => [
                'name' => 'Carte de catégorie avec superposition',
            ],
            'vertical_overlay' => [
                'name' => 'Verticale avec superposition',
                'category' => 'Catégorie',
            ],
            'vertical_below' => [
                'name' => 'Verticale avec nom en dessous',
                'category' => 'Catégorie',
            ],
            'simple_hover' => [
                'name' => 'Survol simple',
                'category' => 'Catégorie',
            ],
        ],
    ],

    'feature' => [
        'icon_label' => 'Icône',
        'title_label' => 'Titre',
        'text_label' => 'Description',
    ],

    'featured-product' => [
        'product_label' => 'Produit',
        'product_info' => 'Sélectionnez un produit à afficher',
    ],

    'footer-group' => [
        'title_label' => 'Nom du groupe',
        'title_default' => 'Groupe de liens',
    ],

    'footer-link' => [
        'text_label' => 'Texte du lien',
        'text_default' => 'Lien',
        'link_label' => 'URL du lien',
    ],

    'collage-image' => [
        'image_label' => 'Image',
    ],

    'collage-product' => [
        'product_label' => 'Produit',
    ],

    'collage-category' => [
        'category_label' => 'Sélectionner la catégorie',
    ],

    'collage-custom' => [
        'image_label' => 'Image',
        'title_label' => 'Titre',
        'text_label' => 'Description',
        'link_label' => 'URL du lien',
        'link_text_label' => 'Texte du lien',
    ],

    'text-with-image-button' => [
        'text_label' => 'Texte du bouton',
        'url_label' => 'URL du bouton',
        'text_default' => 'Texte du bouton',
        'variant_label' => 'Variante du bouton',
        'variant_primary' => 'Primaire',
        'variant_secondary' => 'Secondaire',
        'variant_accent' => 'Accent',
        'variant_neutral' => 'Neutre',
        'style_label' => 'Style du bouton',
        'style_solid' => 'Plein',
        'style_soft' => 'Doux',
        'style_outline' => 'Contour',
        'style_ghost' => 'Fantôme',
    ],

    'accordion' => [
        'settings' => [
            'icon_label' => 'Style d\'icône',
            'icon_options' => [
                'caret' => 'Flèche',
                'plus' => 'Plus',
            ],

            'dividers_label' => 'Afficher les séparateurs',

            'typography_label' => 'Typographie',
            'typography_info' => 'Sélectionner le style de typographie',

            'inherit_color_scheme_label' => 'Hériter du schéma de couleurs',
            'color_scheme_label' => 'Schéma de couleurs',

            'borders_header' => 'Bordures',

            'border_label' => 'Style de bordure',
            'border_options' => [
                'none' => 'Aucune',
                'solid' => 'Pleine',
            ],

            'border_width_label' => 'Épaisseur de bordure',
            'border_opacity_label' => 'Opacité de bordure',
            'border_radius_label' => 'Rayon de bordure',

            'padding_header' => 'Marge intérieure',

            'padding_top_label' => 'Haut',
            'padding_bottom_label' => 'Bas',
            'padding_left_label' => 'Gauche',
            'padding_right_label' => 'Droite',
        ],

        'presets' => [
            'accordion' => [
                'name' => 'Accordéon',
                'category' => 'Disposition',
            ],
        ],
    ],

    'accordion-row' => [
        'settings' => [
            'heading_label' => 'Titre',
            'open_by_default_label' => 'Ouvert par défaut',

            'icon_header' => 'Icône',

            'icon_label' => 'Icône',
            'width_label' => 'Largeur de l\'icône',
        ],

        'presets' => [
            'accordion_row' => [
                'name' => 'Ligne d\'accordéon',
            ],
        ],
    ],

    'product-media-gallery' => [
        'settings' => [
            'presentation_header' => 'Présentation',

            'media_presentation_label' => 'Présentation des médias',
            'media_presentation_options' => [
                'carousel' => 'Carrousel',
                'grid' => 'Grille',
            ],
            'media_presentation_info' => 'Choisissez comment afficher les images et vidéos du produit',

            'grid_columns_label' => 'Colonnes de la grille',
            'grid_columns_info' => 'Nombre de colonnes lors de l\'utilisation de la présentation en grille',

            'image_gap_label' => 'Écart entre les images',
            'image_gap_info' => 'Espace entre les images en vue grille',

            'image_settings_header' => 'Paramètres d\'image',

            'aspect_ratio_label' => 'Ratio d\'aspect',
            'aspect_ratio_options' => [
                'adapt' => 'Adapter à l\'image',
                'square' => 'Carré (1:1)',
                'portrait' => 'Portrait (2:3)',
                'landscape' => 'Paysage (3:2)',
            ],

            'constrain_to_viewport_label' => 'Contraindre à la fenêtre',
            'constrain_to_viewport_info' => 'Empêcher les images de dépasser la hauteur de l\'écran',

            'media_fit_label' => 'Ajustement des médias',
            'media_fit_options' => [
                'contain' => 'Contenir',
                'cover' => 'Couvrir',
            ],

            'media_radius_label' => 'Rayon des coins des médias',

            'zoom_label' => 'Activer le zoom',
            'zoom_info' => 'Permettre aux utilisateurs de zoomer sur les images des produits',

            'layout_header' => 'Disposition',

            'sticky_label' => 'Fixe',
            'sticky_info' => 'Garder la galerie de médias visible lors du défilement',
        ],
    ],

    'product-details' => [
        'settings' => [
            'layout_header' => 'Disposition',
            'gap_label' => 'Écart',
            'gap_info' => 'Espace entre les blocs enfants',

            'sticky_label' => 'Fixe',
            'sticky_info' => 'Garder les détails du produit visibles lors du défilement',

            'spacing_header' => 'Espacement',
            'padding_top_label' => 'Marge intérieure haut',
            'padding_bottom_label' => 'Marge intérieure bas',
            'padding_left_label' => 'Marge intérieure gauche',
            'padding_right_label' => 'Marge intérieure droite',
        ],
    ],

    'product-price' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-rating' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-quantity-selector' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-buy-buttons' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
            'enable_buy_now_label' => 'Activer le bouton "Acheter maintenant"',
            'enable_buy_now_info' => 'Afficher un bouton "Acheter maintenant" séparé pour un paiement rapide',
        ],
    ],

    'product-button' => [
        'settings' => [
            'action_label' => 'Action',
            'action_options' => [
                'cart' => 'Ajouter au panier',
                'wishlist' => 'Ajouter aux favoris',
                'compare' => 'Ajouter à la comparaison',
            ],
            'variant_label' => 'Variante',
            'variant_options' => [
                'solid' => 'Plein',
                'outline' => 'Contour',
                'soft' => 'Doux',
                'link' => 'Lien',
            ],
            'size_label' => 'Taille',
            'size_options' => [
                'sm' => 'Petit',
                'md' => 'Moyen',
                'lg' => 'Grand',
                'xl' => 'Très grand',
            ],
            'color_label' => 'Couleur',
            'color_options' => [
                'primary' => 'Primaire',
                'secondary' => 'Secondaire',
                'success' => 'Succès',
                'danger' => 'Danger',
                'warning' => 'Avertissement',
                'info' => 'Info',
            ],
            'icon_label' => 'Icône',
            'icon_info' => 'Icône facultative à afficher dans le bouton',
            'circle_label' => 'Bouton circulaire',
            'circle_info' => 'Rendre le bouton circulaire (icône uniquement)',
            'square_label' => 'Bouton carré',
            'square_info' => 'Rendre le bouton carré (icône uniquement)',
            'block_label' => 'Pleine largeur',
            'block_info' => 'Faire occuper toute la largeur du parent au bouton',
        ],
        'placeholder' => [
            'cart' => 'Ajouter au panier',
            'wishlist' => 'Ajouter aux favoris',
            'compare' => 'Ajouter à la comparaison',
        ],
        'wishlist_disabled' => 'Favoris désactivés',
        'compare_disabled' => 'Comparaison désactivée',
    ],

    'product-card' => [
        'presets' => [
            'vertical' => [
                'name' => 'Carte verticale',
                'category' => 'Cartes produit',
            ],
            'horizontal' => [
                'name' => 'Carte horizontale',
                'category' => 'Cartes produit',
            ],
            'overlay' => [
                'name' => 'Carte avec superposition au survol',
                'category' => 'Cartes produit',
            ],
        ],
    ],

    'product-variant-picker' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-grouped-options' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-bundle-options' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-downloadable-options' => [
        'settings' => [
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-customizable-options' => [
        'name' => 'Options personnalisables du produit',
        'description' => 'Afficher les options personnalisables du produit avec ajustements de prix',
    ],

    'logo' => [
        'name' => 'Logo',
        'description' => 'Logo ou nom du site',
        'settings' => [
            'logo_text_label' => 'Texte du logo',
            'logo_text_placeholder' => 'Affiché lorsqu\'aucune image de logo n\'est définie',
            'logo_text_info' => 'Les images de logo sont configurées dans les paramètres du thème sous "Logo & Favicon"',
        ],
    ],

    'header-nav' => [
        'name' => 'Navigation',
        'description' => 'Menu de navigation principal affiché dans l\'en-tête',
        'settings' => [
            'push_to_left' => 'Pousser cet élément au début',
            'push_to_right' => 'Pousser cet élément à la fin',
        ],
    ],

    'header-group' => [
        'name' => 'Groupe d\'en-tête',
    ],

    'header-currency' => [
        'name' => 'Sélecteur de devise',
        'description' => 'Permet aux clients de basculer entre les devises disponibles',
    ],

    'header-locale' => [
        'name' => 'Sélecteur de langue',
        'description' => 'Permet aux clients de basculer entre les langues disponibles',
        'settings' => [
            'icon_label' => 'Icône',
        ],
    ],

    'header-search' => [
        'name' => 'Formulaire de recherche',
        'description' => 'Champ de recherche de produits avec recherche d\'image optionnelle',
        'settings' => [
            'search_icon_label' => 'Icône de recherche',
            'image_search_icon_label' => 'Icône de recherche d\'image',
        ],
    ],

    'header-compare' => [
        'name' => 'Comparaison',
        'description' => 'Lien vers la page de comparaison de produits',
        'settings' => [
            'icon_label' => 'Icône',
        ],
    ],

    'header-user' => [
        'name' => 'Menu utilisateur',
        'description' => 'Menu de compte utilisateur avec options de connexion/inscription',
        'settings' => [
            'icon_label' => 'Icône',
            'guest_heading_label' => 'Titre affiché aux utilisateurs invités',
            'guest_description_label' => 'Description affichée aux utilisateurs invités',
            'guest_heading_default' => 'Bienvenue Invité',
            'guest_description_default' => 'Gérer panier, commandes et favoris',
        ],
    ],

    'header-cart' => [
        'name' => 'Aperçu du panier',
        'description' => 'Icône du panier avec aperçu du mini panier',
        'settings' => [
            'heading_label' => 'Titre',
            'description_label' => 'Description',
            'description_default' => 'Obtenez jusqu\'à 30% de réduction sur votre 1ère commande',
        ],
    ],

    'feature-icon' => [
        'name' => 'Icône de fonctionnalité',
    ],

];
