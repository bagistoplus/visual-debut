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
    ],

    'product' => [
        'settings' => [
            'product_info' => 'Sélectionnez un produit à afficher',
        ],
    ],

    'product-card-group' => [
        'name' => 'Groupe de cartes produit',
    ],

    'divider' => [
        'settings' => [
            'thickness_label' => 'Épaisseur',
            'thickness_info' => 'Définir l\'épaisseur de la ligne de séparation',

            'corner_radius_label' => 'Rayon des coins',
            'corner_radius_options' => [
                'square' => 'Carré',
                'rounded' => 'Arrondi',
            ],

            'width_percent_label' => 'Longueur',
            'width_percent_info' => 'Définir la largeur du séparateur en pourcentage',

            'alignment_label' => 'Alignement',
            'alignment_info' => 'Alignement horizontal du séparateur',
            'alignment_options' => [
                'left' => 'Gauche',
                'center' => 'Centre',
                'right' => 'Droite',
            ],

            'padding_header' => 'Marge intérieure',
            'padding_top_label' => 'Haut',
            'padding_bottom_label' => 'Bas',
        ],
    ],

    'richtext' => [
        'settings' => [
            'content_label' => 'Contenu',

            'layout_header' => 'Disposition',

            'width_label' => 'Largeur',
            'width_options' => [
                'fit' => 'Ajuster au contenu',
                'fill' => 'Remplir',
            ],

            'max_width_label' => 'Largeur maximale',
            'max_width_options' => [
                'narrow' => 'Étroit (Prose)',
                'normal' => 'Normal',
                'wide' => 'Large',
                'none' => 'Aucune',
            ],

            'alignment_label' => 'Alignement',
            'alignment_options' => [
                'left' => 'Gauche',
                'center' => 'Centre',
                'right' => 'Droite',
            ],

            'padding_header' => 'Marge intérieure',
            'padding_top_label' => 'Haut',
            'padding_bottom_label' => 'Bas',
            'padding_left_label' => 'Gauche',
            'padding_right_label' => 'Droite',
        ],
    ],

    'text' => [
        'settings' => [
            'text_label' => 'Contenu du texte',

            'layout_header' => 'Disposition',

            'width_label' => 'Largeur',
            'width_options' => [
                'fit' => 'Ajuster au contenu',
                'fill' => 'Remplir',
            ],

            'max_width_label' => 'Largeur maximale',
            'max_width_options' => [
                'narrow' => 'Étroit',
                'normal' => 'Normal',
                'none' => 'Aucune',
            ],

            'alignment_label' => 'Alignement',
            'alignment_options' => [
                'left' => 'Gauche',
                'center' => 'Centre',
                'right' => 'Droite',
            ],

            'typography_header' => 'Typographie',

            'typography_label' => 'Typographie',
            'typography_info' => 'Sélectionner le style de typographie',

            'color_label' => 'Couleur du texte',
            'color_options' => [
                'default' => 'Par défaut',
                'primary' => 'Primaire',
                'secondary' => 'Secondaire',
                'accent' => 'Accent',
                'info' => 'Info',
                'success' => 'Succès',
                'warning' => 'Avertissement',
                'danger' => 'Danger',
                'custom' => 'Personnalisé',
            ],

            'text_color_label' => 'Couleur personnalisée',

            'appearance_header' => 'Apparence',

            'padding_header' => 'Marge intérieure',

            'padding_top_label' => 'Haut',
            'padding_bottom_label' => 'Bas',
            'padding_left_label' => 'Gauche',
            'padding_right_label' => 'Droite',
        ],

        'presets' => [
            'text' => [
                'name' => 'Texte',
                'category' => 'Texte',
            ],
            'category-name' => [
                'name' => 'Nom de catégorie',
            ],
            'heading' => [
                'name' => 'Titre',
                'category' => 'Texte',
            ],
        ],
    ],

    'icon' => [
        'settings' => [
            'icon_label' => 'Icône',

            'size_label' => 'Taille',

            'color_label' => 'Couleur',
            'color_options' => [
                'default' => 'Par défaut',
                'primary' => 'Primaire',
                'secondary' => 'Secondaire',
                'accent' => 'Accent',
                'info' => 'Info',
                'success' => 'Succès',
                'warning' => 'Avertissement',
                'danger' => 'Danger',
                'custom' => 'Personnalisé',
            ],

            'custom_color_label' => 'Couleur personnalisée',
        ],
    ],

    'button' => [
        'settings' => [
            'label_label' => 'Étiquette du bouton',
            'label_default' => 'Bouton',

            'link_label' => 'URL du lien',

            'open_in_new_tab_label' => 'Ouvrir dans un nouvel onglet',

            'style_class_label' => 'Style du bouton',
            'style_class_options' => [
                'button' => 'Plein',
                'outline' => 'Contour',
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
            'icon_info' => 'Ajouter une icône au bouton',

            'circle_label' => 'Bouton circulaire',
            'circle_info' => 'Rendre le bouton circulaire (icône uniquement)',

            'square_label' => 'Bouton carré',
            'square_info' => 'Rendre le bouton carré (icône uniquement)',

            'block_label' => 'Pleine largeur',
            'block_info' => 'Faire occuper toute la largeur du parent au bouton',

            'width_label' => 'Largeur (Bureau)',
            'width_options' => [
                'fit_content' => 'Ajuster au contenu',
                'custom' => 'Personnalisé',
            ],

            'custom_width_label' => 'Largeur personnalisée',

            'width_mobile_label' => 'Largeur (Mobile)',
            'width_mobile_options' => [
                'fit_content' => 'Ajuster au contenu',
                'custom' => 'Personnalisé',
            ],

            'custom_width_mobile_label' => 'Largeur mobile personnalisée',
        ],

        'presets' => [
            'button' => [
                'name' => 'Bouton',
                'category' => 'Actions',
            ],
        ],
    ],

    'link' => [
        'settings' => [
            'text_label' => 'Texte du lien',
            'url_label' => 'URL',
            'open_in_new_tab_label' => 'Ouvrir dans un nouvel onglet',

            'typography_header' => 'Typographie',

            'typography_label' => 'Typographie',
            'typography_info' => 'Sélectionner le style de typographie',

            'appearance_header' => 'Apparence',

            'underline_label' => 'Soulignement',
            'underline_options' => [
                'none' => 'Aucun',
                'hover' => 'Au survol',
                'always' => 'Toujours',
            ],

            'spacing_header' => 'Espacement',

            'padding_top_label' => 'Marge intérieure haut',
            'padding_bottom_label' => 'Marge intérieure bas',
        ],

        'presets' => [
            'link' => [
                'name' => 'Lien',
                'category' => 'Basique',
            ],
        ],
    ],

    'heading' => [
        'text_label' => 'Texte du titre',
        'default_text' => 'Bienvenue dans notre boutique',
        'heading_level_label' => 'Niveau de titre',
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

    'category-image' => [
        'settings' => [
            'category_label' => 'Catégorie',
            'image_source_label' => 'Source de l\'image',
            'image_source_options' => [
                'banner' => 'Image de bannière',
                'logo' => 'Image de logo',
            ],
            'image_source_info' => 'Choisissez quelle image de catégorie afficher',
            'aspect_ratio_label' => 'Ratio d\'aspect',
            'aspect_ratio_options' => [
                'adapt' => 'Adapter à l\'image',
                'square' => 'Carré (1:1)',
                'portrait' => 'Portrait (3:4)',
                'landscape' => 'Paysage (4:3)',
            ],
            'object_fit_label' => 'Ajustement de l\'objet',
            'object_fit_options' => [
                'cover' => 'Couvrir',
                'contain' => 'Contenir',
            ],
        ],
    ],

    'category-name' => [
        'settings' => [
            'category_label' => 'Catégorie',
            'tag_label' => 'Balise HTML',
            'alignment_label' => 'Alignement',
            'alignment_options' => [
                'left' => 'Gauche',
                'center' => 'Centre',
                'right' => 'Droite',
            ],
            'text_color_label' => 'Couleur du texte',
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

    'image' => [
        'settings' => [
            'image_label' => 'Image',
            'link_label' => 'Lien',
            'alt_label' => 'Texte alternatif',
            'alt_info' => 'Texte descriptif pour l\'accessibilité et le référencement',

            'size_header' => 'Taille',
            'sizing_header' => 'Dimensionnement',

            'image_ratio_label' => 'Ratio d\'image',
            'image_ratio_options' => [
                'adapt' => 'Adapter à l\'image',
                'portrait' => 'Portrait (3:4)',
                'square' => 'Carré (1:1)',
                'landscape' => 'Paysage (4:3)',
            ],

            'aspect_ratio_label' => 'Ratio d\'aspect',
            'aspect_ratio_options' => [
                'adapt' => 'Adapter à l\'image',
                'square' => 'Carré (1:1)',
                'portrait' => 'Portrait (3:4)',
                'landscape' => 'Paysage (4:3)',
            ],

            'object_fit_label' => 'Ajustement de l\'objet',
            'object_fit_options' => [
                'cover' => 'Couvrir',
                'contain' => 'Contenir',
                'fill' => 'Remplir',
            ],

            'width_label' => 'Largeur',
            'width_options' => [
                'fit_content' => 'Ajuster au contenu',
                'fill' => 'Remplir',
                'custom' => 'Personnalisé',
            ],

            'custom_width_label' => 'Largeur personnalisée (%)',

            'width_mobile_label' => 'Largeur (Mobile)',
            'width_mobile_options' => [
                'fit_content' => 'Ajuster au contenu',
                'fill' => 'Remplir',
                'custom' => 'Personnalisé',
            ],

            'custom_width_mobile_label' => 'Largeur mobile personnalisée (%)',

            'height_label' => 'Hauteur',
            'height_options' => [
                'fit' => 'Ajuster au contenu',
                'fill' => 'Remplir',
            ],

            'hover_zoom_label' => 'Agrandir l\'image au survol',
            'hover_zoom_info' => 'Zoomer sur l\'image lors du survol',
            'hover_zoom_scale_label' => 'Niveau d\'agrandissement',

            'borders_header' => 'Bordures',

            'border_label' => 'Bordure',
            'border_options' => [
                'none' => 'Aucune',
                'solid' => 'Pleine',
            ],
            'border_width_label' => 'Largeur de bordure',
            'border_opacity_label' => 'Opacité de bordure',
            'border_radius_label' => 'Rayon de bordure',
            'border_radius_options' => [
                'none' => 'Aucun',
                'sm' => 'Petit',
                'md' => 'Moyen',
                'lg' => 'Grand',
                'xl' => 'Très grand',
                '2xl' => '2x grand',
                '3xl' => '3x grand',
                'full' => 'Complet',
            ],

            'padding_header' => 'Marge intérieure',

            'padding_top_label' => 'Haut',
            'padding_bottom_label' => 'Bas',
            'padding_left_label' => 'Gauche',
            'padding_right_label' => 'Droite',
        ],

        'presets' => [
            'image' => [
                'name' => 'Image',
                'category' => 'Média',
            ],
        ],
    ],

    'group' => [
        'settings' => [
            'layout_header' => 'Disposition',

            'content_direction_label' => 'Direction',
            'content_direction_options' => [
                'row' => 'Ligne',
                'column' => 'Colonne',
            ],

            'alignment_label' => 'Alignement',
            'alignment_options' => [
                'start' => 'Début',
                'center' => 'Centre',
                'end' => 'Fin',
            ],

            'gap_label' => 'Écart',

            'size_header' => 'Taille',

            'width_label' => 'Largeur',
            'width_options' => [
                'auto' => 'Auto',
                'full' => 'Complet',
            ],

            'height_label' => 'Hauteur',
            'height_options' => [
                'auto' => 'Auto',
                'full' => 'Complet',
            ],

            'padding_header' => 'Marge intérieure',

            'padding_top_label' => 'Haut',
            'padding_bottom_label' => 'Bas',
            'padding_left_label' => 'Gauche',
            'padding_right_label' => 'Droite',
        ],

        'presets' => [
            'empty_group' => [
                'name' => 'Groupe vide',
                'category' => 'Disposition',
            ],
            'two_columns' => [
                'name' => 'Deux colonnes',
                'category' => 'Disposition',
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

    'product-title' => [
        'settings' => [
            'tag_label' => 'Balise de titre',
            'size_label' => 'Taille du titre',
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
        ],
    ],

    'product-image' => [
        'settings' => [
            'size_label' => 'Taille de l\'image',
            'size_options' => [
                'small' => 'Petite',
                'medium' => 'Moyenne',
                'large' => 'Grande',
                'original' => 'Originale',
            ],
            'size_info' => 'Sélectionnez la taille de l\'image du produit à afficher',

            'aspect_ratio_label' => 'Ratio d\'aspect',
            'aspect_ratio_options' => [
                'square' => 'Carré (1:1)',
                'portrait' => 'Portrait (3:4)',
                'landscape' => 'Paysage (4:3)',
                'auto' => 'Auto',
            ],
            'aspect_ratio_info' => 'Définir le ratio d\'aspect de l\'image',

            'object_fit_label' => 'Ajustement de l\'objet',
            'object_fit_options' => [
                'cover' => 'Couvrir',
                'contain' => 'Contenir',
                'fill' => 'Remplir',
            ],
            'object_fit_info' => 'Comment l\'image doit s\'adapter à ses limites',
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

    'product-short-description' => [
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

    'product-labels' => [
        'settings' => [
            'layout_label' => 'Disposition',
            'layout_options' => [
                'inline' => 'En ligne',
                'stack' => 'Empilé',
            ],
            'gap_label' => 'Écart',
            'alignment_label' => 'Alignement',
            'alignment_options' => [
                'start' => 'Début',
                'center' => 'Centre',
                'end' => 'Fin',
            ],
            'size_label' => 'Taille',
            'size_options' => [
                'xs' => 'Très petit',
                'sm' => 'Petit',
                'md' => 'Moyen',
                'lg' => 'Grand',
            ],
            'variant_label' => 'Variante',
            'variant_options' => [
                'solid' => 'Plein',
                'outline' => 'Contour',
                'soft' => 'Doux',
            ],
            'corner_radius_label' => 'Rayon des coins',
            'corner_radius_options' => [
                'none' => 'Aucun',
                'sm' => 'Petit',
                'md' => 'Moyen',
                'lg' => 'Grand',
                'full' => 'Complet',
            ],
        ],
        'placeholder' => 'Aucune étiquette disponible',
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

    'product-description' => [
        'settings' => [
            'show_in_panel_label' => 'Afficher dans un panneau d\'accordéon',
            'should_open_panel_label' => 'Ouvrir le panneau par défaut',
            'position_label' => 'Position',
            'position_right' => 'Colonne de droite',
            'position_under_gallery' => 'Sous la galerie',
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

    'group' => [
        'name' => 'Groupe',
        'description' => 'Groupe polyvalent pour la composition de mise en page avec flex, grille, espacement, dimensionnement et bordures',
        'settings' => [
            // Layout
            'layout_header' => 'Disposition',
            'layout_type_label' => 'Type de disposition',
            'layout_type_info' => 'Choisissez comment les blocs enfants sont disposés',
            'layout_type_options' => [
                'block' => 'Bloc',
                'flex' => 'Flexbox',
                'grid' => 'Grille',
            ],

            // Flex Settings
            'flex_direction_label' => 'Direction',
            'flex_direction_options' => [
                'horizontal' => 'Horizontal',
                'vertical' => 'Vertical',
            ],

            'vertical_justify_label' => 'Position du contenu',
            'vertical_justify_options' => [
                'top' => 'Haut',
                'center' => 'Centre',
                'space_between' => 'Espace entre',
                'bottom' => 'Bas',
            ],
            'vertical_align_label' => 'Alignement du contenu',
            'vertical_align_options' => [
                'start' => 'Début',
                'center' => 'Centre',
                'end' => 'Fin',
            ],

            'horizontal_justify_label' => 'Position du contenu',
            'horizontal_justify_options' => [
                'left' => 'Gauche',
                'center' => 'Centre',
                'space_between' => 'Espace entre',
                'right' => 'Droite',
            ],
            'horizontal_align_label' => 'Alignement du contenu',
            'horizontal_align_options' => [
                'top' => 'Haut',
                'center' => 'Centre',
                'bottom' => 'Bas',
            ],

            'flex_wrap_label' => 'Retour à la ligne flex',
            'flex_wrap_options' => [
                'nowrap' => 'Pas de retour',
                'wrap' => 'Retour',
                'wrap_reverse' => 'Retour inversé',
            ],
            'justify_content_label' => 'Justifier le contenu',
            'justify_content_options' => [
                'start' => 'Début',
                'center' => 'Centre',
                'end' => 'Fin',
                'between' => 'Espace entre',
                'around' => 'Espace autour',
                'evenly' => 'Espace uniforme',
            ],
            'align_items_label' => 'Aligner les éléments',
            'align_items_options' => [
                'start' => 'Début',
                'center' => 'Centre',
                'end' => 'Fin',
                'stretch' => 'Étirer',
                'baseline' => 'Ligne de base',
            ],

            // Grid Settings
            'grid_columns_label' => 'Colonnes de la grille',
            'grid_rows_label' => 'Lignes de la grille',
            'grid_rows_options' => [
                'auto' => 'Auto',
            ],
            'gap_label' => 'Écart',

            // Spacing
            'spacing_header' => 'Espacement',
            'padding_top_label' => 'Marge intérieure haut',
            'padding_bottom_label' => 'Marge intérieure bas',
            'padding_left_label' => 'Marge intérieure gauche',
            'padding_right_label' => 'Marge intérieure droite',
            'margin_top_label' => 'Marge extérieure haut',
            'margin_bottom_label' => 'Marge extérieure bas',
            'margin_left_label' => 'Marge extérieure gauche',
            'margin_right_label' => 'Marge extérieure droite',

            // Sizing
            'sizing_header' => 'Dimensionnement',
            'width_label' => 'Largeur',
            'width_options' => [
                'auto' => 'Auto',
                'full' => 'Complet (100%)',
                'fit' => 'Ajuster au contenu',
                'screen' => 'Largeur d\'écran',
                'custom' => 'Personnalisé',
            ],
            'custom_width_label' => 'Largeur personnalisée',
            'min_width_label' => 'Largeur minimale',
            'max_width_label' => 'Largeur maximale',
            'max_width_options' => [
                'none' => 'Aucune',
                'full' => 'Complet',
                'screen' => 'Écran',
            ],
            'height_label' => 'Hauteur',
            'height_options' => [
                'auto' => 'Auto',
                'full' => 'Complet (100%)',
                'fit' => 'Ajuster au contenu',
                'screen' => 'Hauteur d\'écran',
                'custom' => 'Personnalisé',
            ],
            'custom_height_label' => 'Hauteur personnalisée',
            'min_height_label' => 'Hauteur minimale',

            // Borders
            'borders_header' => 'Bordures',
            'border_label' => 'Activer la bordure',
            'border_width_label' => 'Largeur de bordure',
            'border_style_label' => 'Style de bordure',
            'border_style_options' => [
                'solid' => 'Pleine',
                'dashed' => 'Tirets',
                'dotted' => 'Points',
            ],
            'border_color_label' => 'Couleur de bordure',
            'border_opacity_label' => 'Opacité de bordure',
            'border_radius_label' => 'Rayon de bordure',
            'border_radius_options' => [
                'none' => 'Aucun',
                'full' => 'Complet (Pilule)',
            ],

            // Background
            'background_header' => 'Arrière-plan',
            'background_type_label' => 'Type d\'arrière-plan',
            'background_type_options' => [
                'none' => 'Aucun',
                'color' => 'Couleur',
                'gradient' => 'Dégradé',
                'image' => 'Image',
            ],
            'background_color_label' => 'Couleur d\'arrière-plan',
            'background_gradient_label' => 'Dégradé d\'arrière-plan',
            'background_image_label' => 'Image d\'arrière-plan',
            'background_position_label' => 'Position d\'arrière-plan',
            'background_position_options' => [
                'center' => 'Centre',
                'top' => 'Haut',
                'bottom' => 'Bas',
                'left' => 'Gauche',
                'right' => 'Droite',
            ],
            'background_size_label' => 'Taille d\'arrière-plan',
            'background_size_options' => [
                'cover' => 'Couvrir',
                'contain' => 'Contenir',
                'auto' => 'Auto',
            ],
            'background_repeat_label' => 'Répétition d\'arrière-plan',
            'background_repeat_options' => [
                'no_repeat' => 'Pas de répétition',
                'repeat' => 'Répéter',
                'repeat_x' => 'Répéter X',
                'repeat_y' => 'Répéter Y',
            ],

            // Overlay
            'overlay_header' => 'Superposition',
            'is_overlay_label' => 'Positionner en superposition',
            'is_overlay_info' => 'Lorsqu\'activé, ce groupe sera positionné de manière absolue sur son parent',
            'overlay_visibility_label' => 'Visibilité de la superposition',
            'overlay_visibility_info' => 'Contrôler quand la superposition est visible',
            'overlay_visibility_options' => [
                'always' => 'Toujours visible',
                'hover' => 'Afficher au survol du parent',
            ],
            'overlay_hover_target_label' => 'Cible du survol',
            'overlay_hover_target_info' => 'Choisissez quel élément déclenche la visibilité de la superposition au survol',
            'overlay_hover_target_options' => [
                'parent' => 'Parent immédiat',
                'group' => 'N\'importe quel ancêtre',
                'product_card' => 'Carte produit',
            ],
            'z_index_label' => 'Index Z',
            'position_label' => 'Position',
            'position_options' => [
                'static' => 'Statique',
                'relative' => 'Relative',
                'absolute' => 'Absolue',
                'fixed' => 'Fixe',
            ],
        ],
        'presets' => [
            'basic' => [
                'name' => 'Groupe',
                'category' => 'Disposition',
            ],
            'centered' => [
                'name' => 'Groupe centré',
                'category' => 'Disposition',
            ],
            'card' => [
                'name' => 'Carte',
                'category' => 'Disposition',
            ],
            'flex_row' => [
                'name' => 'Ligne flex',
                'category' => 'Disposition',
            ],
            'grid' => [
                'name' => 'Groupe en grille',
                'category' => 'Disposition',
            ],
            'overlay' => [
                'name' => 'Groupe en superposition',
                'category' => 'Disposition',
            ],
            'feature_icon' => [
                'name' => 'Icône de fonctionnalité',
            ],
        ],
    ],
];
