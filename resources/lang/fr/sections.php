<?php

return [
    'common' => [
        'color_scheme_label' => 'Palette de couleurs',
        'color_scheme_info' => 'Remplace la palette de couleurs globale du thème pour cette section',
    ],

    'admin-topbar' => [
        'name' => 'Barre supérieure d’administration',
        'description' => 'Affiche une barre supérieure avec un lien vers le panneau d’administration. Utile pour les vitrines accessibles aux administrateurs.',

        'settings' => [
            'text_label' => 'Texte du lien',
            'url_label' => 'URL du lien',
        ],
    ],

    'announcement-bar' => [
        'name' => 'Barre d\'annonce',
        'description' => 'Une barre d\'annonce simple pour afficher des informations importantes à vos clients.',
        'settings' => [
            'text_label' => 'Texte de l\'annonce',
            'default_text' => 'Livraison gratuite pour les commandes supérieures à 50 $',
            'link_label' => 'Lien',
            'variant_label' => 'Variante d\'arrière-plan',
            'variant_options' => [
                'primary' => 'Principal',
                'secondary' => 'Secondaire',
                'accent' => 'Accent',
                'neutral' => 'Neutre',
            ],
            'scheme_label' => 'Palette de couleurs',
            'scheme_note' => 'Cela remplace la palette de couleurs globale du thème. Les modifications du thème principal n\'affecteront pas cette section.',
        ],
    ],

    'hero-banner' => [
        'nom' => 'Bannière Hero',
        'description' => 'Une bannière pleine largeur avec du texte et des boutons d’appel à l’action.',

        'settings' => [
            'scheme_label' => 'Palette de couleurs',
            'background_label' => 'Image de fond',
            'overlay_label' => 'Afficher l\'overlay',
            'overlay_opacity_label' => 'Opacité de l\'overlay (%)',
            'height_label' => 'Hauteur de la bannière',
            'scheme_note' => 'Cela remplace la palette de couleurs globale du thème. Les modifications du thème principal n\'affecteront pas cette section.',
        ],
        'blocks' => [
            'heading' => [
                'name' => 'Titre',
                'text_label' => 'Texte du titre',
                'default_text' => 'Bienvenue dans notre boutique',
            ],
            'subtext' => [
                'name' => 'Sous-texte',
                'text_label' => 'Sous-texte',
                'default_text' => 'Découvrez nos meilleurs produits et offres.',
            ],
            'button' => [
                'name' => 'Bouton',
                'text_label' => 'Texte du bouton',
                'default_text' => 'Voir les collections',
                'link_label' => 'Lien du bouton',
                'color_label' => 'Variante',
            ],
        ],
    ],

    'header' => [
        'name' => 'En-tête',
        'description' => '',
        'settings' => [
            'content_width_label' => 'Largeur du contenu',
            'content_width_container' => 'Conteneur',
            'content_width_fullwidth' => 'Pleine largeur',
        ],
        'region' => [
            'logo_group' => 'Logo',
            'actions_group' => 'Actions',
        ],
        'presets' => [
            'default' => [
                'name' => 'En-tête',
            ],
        ],
        'blocks' => [
            'logo' => [
                'name' => 'Nom/Logo',
                'settings' => [
                    'logo_image_label' => 'Télécharger le logo',
                    'logo_text_label' => 'Texte du logo',
                    'mobile_logo_image_label' => 'Logo mobile',
                    'logo_text_placeholder' => 'Affiché en l\'absence d\'image de logo',
                    'push_to_left' => 'Aligner cet élément à gauche',
                    'push_to_right' => 'Aligner cet élément à droite',
                ],
            ],
            'nav' => [
                'name' => 'Navigation',
                'settings' => [
                    'push_to_left' => 'Aligner cet élément à gauche',
                    'push_to_right' => 'Aligner cet élément à droite',
                ],
            ],
            'currency' => [
                'name' => 'Sélecteur de devise',
            ],
            'locale' => [
                'name' => 'Sélecteur de langue',
                'settings' => [
                    'icon_label' => 'Icône',
                ],
            ],
            'search' => [
                'name' => 'Formulaire de recherche',
                'placeholder' => 'Recherchez des produits ici',
                'settings' => [
                    'search_icon_label' => 'Icône de recherche',
                    'image_search_icon_label' => 'Icône de recherche par image',
                ],
            ],
            'compare' => [
                'name' => 'Comparer',
                'settings' => [
                    'icon_label' => 'Icône',
                ],
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
                ],
            ],
            'cart' => [
                'name' => 'Aperçu du panier',
                'settings' => [
                    'heading_label' => 'Titre',
                    'description_label' => 'Description',
                    'description_default' => 'Bénéficiez de jusqu\'à 30% de réduction sur votre 1ère commande',
                ],
            ],
        ],
    ],

    'footer' => [
        'name' => 'Pied de page',
        'description' => 'Section inférieure de votre site avec des liens et du branding.',
        'settings' => [
            'layout_header' => 'Mise en page',
            'content_width_label' => 'Largeur du contenu',
            'content_width_options' => [
                'full' => 'Pleine largeur',
                'container' => 'Conteneur',
            ],
            'content_width_info' => 'Choisissez si le contenu du pied de page doit être limité à un conteneur ou s’étendre sur toute la largeur',
            'appearance_header' => 'Apparence',
            'color_scheme_label' => 'Palette de couleurs',
            'color_scheme_info' => 'Remplace la palette de couleurs globale du thème pour cette section',
            'heading_label' => 'Titre',
            'heading_default' => 'Ma boutique',
            'description_label' => 'Description',
            'description_default' => 'Ajoutez ici une description de votre boutique',
            'show_social_links_label' => 'Afficher les liens sociaux',
            'show_social_links_info' => 'Vous pouvez configurer les liens dans les paramètres du thème',
        ],
        'presets' => [
            'classic' => [
                'name' => 'Pied de page classique',
                'brand_title' => 'Ma boutique',
                'brand_description' => 'Ajoutez ici une description de votre boutique. Parlez à vos clients de votre mission, de vos valeurs et de ce qui rend vos produits spéciaux.',
                'brand_column' => 'Marque',
                'footer_columns' => 'Colonnes du pied de page',
                'company_title' => 'Entreprise',
                'policy_title' => 'Politique',
                'account_title' => 'Compte',
                'bottom_bar' => 'Barre inférieure',
                'social_icons' => 'Icônes sociales',
                'copyright' => '© :year :store. Tous droits réservés.',
                'links' => [
                    'about_us' => 'À propos',
                    'contact' => 'Contact',
                    'careers' => 'Carrières',
                    'privacy_policy' => 'Politique de confidentialité',
                    'terms_of_service' => 'Conditions d’utilisation',
                    'shipping_policy' => 'Politique d’expédition',
                    'sign_in' => 'Connexion',
                    'register' => 'Inscription',
                    'my_account' => 'Mon compte',
                ],
            ],

            'minimal' => [
                'name' => 'Pied de page minimal centré',
                'tagline' => 'Votre partenaire e-commerce de confiance',
                'centered_content' => 'Contenu centré',
                'social_icons' => 'Icônes sociales',
                'copyright' => '© :year Tous droits réservés.',
            ],

            'newsletter' => [
                'name' => 'Pied de page newsletter',
                'heading' => 'Restez informé',
                'description' => 'Abonnez-vous à notre newsletter pour recevoir des offres exclusives et des mises à jour.',
                'copyright' => '© :year :store',
                'container' => 'Newsletter + liens',
                'newsletter' => 'Newsletter',
                'links' => 'Liens',
                'columns' => [
                    'quick_links' => 'Liens rapides',
                    'help' => 'Aide',
                    'account' => 'Compte',
                ],
                'links_items' => [
                    'shop' => 'Boutique',
                    'about' => 'À propos',
                    'contact' => 'Contact',
                    'faq' => 'FAQ',
                    'shipping' => 'Expédition',
                    'returns' => 'Retours',
                    'sign_in' => 'Connexion',
                    'register' => 'Inscription',
                ],
            ],
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
        'description' => 'Afficher les catégories dans une grille responsive ou un carrousel.',
        'settings' => [
            'heading_default' => 'Acheter par catégorie',

            'parent_category_label' => 'Catégorie parente',
            'parent_category_info' => 'Sélectionnez une catégorie parente pour afficher ses enfants. Laissez vide pour afficher les catégories ajoutées manuellement.',

            'layout_header' => 'Mise en page',
            'layout_type_label' => 'Type de mise en page',
            'layout_type_options' => [
                'grid' => 'Grille',
                'carousel' => 'Carrousel',
            ],
            'columns_label' => 'Colonnes',
            'gap_label' => 'Espacement',
            'gap_info' => 'Espace entre les éléments (0-24, où 4 = 1rem)',

            'carousel_nav_header' => 'Carrousel',
            'loop_label' => 'Boucler',
            'autoplay_label' => 'Lecture automatique',
            'autoplay_delay_label' => 'Délai de lecture automatique',
            'autoplay_delay_info' => 'Temps entre les changements automatiques de diapositive en millisecondes.',
            'nav_style_label' => 'Style de navigation',
            'nav_style_options' => [
                'arrow' => 'Flèches',
                'dot' => 'Points',
                'both' => 'Les deux',
                'none' => 'Aucun',
            ],
            'nav_shape_label' => 'Forme de navigation',
            'nav_shape_options' => [
                'none' => 'Aucune',
                'circle' => 'Cercle',
                'square' => 'Carré',
            ],
            'nav_icon_label' => 'Icône de navigation',
            'nav_icon_options' => [
                'arrow' => 'Flèche',
                'chevron' => 'Chevron',
            ],

            'appearance_header' => 'Apparence',

            'content_width_label' => 'Largeur du contenu',
            'content_width_options' => [
                'container' => 'Conteneur',
                'full' => 'Pleine largeur',
            ],
        ],
        'presets' => [
            'grid' => [
                'name' => 'Grille de catégories',
                'heading' => 'Acheter par catégorie',
                'category_card' => 'Carte de catégorie',
            ],
        ],
        'blocks' => [
            'category' => [
                'name' => 'Catégorie',
                'settings' => [
                    'category_label' => 'Catégorie',
                ],
            ],
        ],
        'placeholder' => [
            'category' => 'Catégorie :index',
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
        'presets' => [
            'featured' => [
                'name' => 'Produits en vedette',
            ],
            'new' => [
                'name' => 'Nouveautés',
            ],
        ],
    ],

    'product-list' => [
        'name' => 'Liste de produits',
        'description' => 'Affiche une liste de produits depuis une catégorie, ou filtre par type de produit.',

        'settings' => [
            'parent_category_label' => 'Catégorie parente',
            'parent_category_info' => 'Filtre les produits par catégorie. Laissez vide pour afficher les produits de toutes les catégories.',

            'product_type_label' => 'Type de produit',
            'product_type_info' => 'Utilisé uniquement si aucune catégorie parente n’est sélectionnée',
            'new_label' => 'Nouveaux produits',
            'featured_label' => 'Produits en vedette',

            'nb_products_label' => 'Nombre de produits',
            'nb_products_info' => 'Nombre maximum de produits à afficher',

            'layout_header' => 'Mise en page',
            'layout_type_label' => 'Type de mise en page',
            'layout_type_options' => [
                'grid' => 'Grille',
                'carousel' => 'Carrousel',
            ],

            'columns_label' => 'Colonnes',
            'gap_label' => 'Espacement',
            'gap_info' => 'Espace entre les produits',

            'content_width_label' => 'Largeur du contenu',
            'content_width_options' => [
                'container' => 'Conteneur',
                'full' => 'Pleine largeur',
            ],

            'carousel_nav_header' => 'Carrousel',
            'loop_label' => 'Boucler',
            'autoplay_label' => 'Lecture automatique',
            'autoplay_delay_label' => 'Délai de lecture automatique',
            'autoplay_delay_info' => 'Temps entre les changements automatiques de diapositive en millisecondes.',
            'nav_style_label' => 'Style de navigation',
            'nav_style_options' => [
                'arrow' => 'Flèches',
                'dot' => 'Points',
                'both' => 'Les deux',
                'none' => 'Aucun',
            ],
            'nav_shape_label' => 'Forme de navigation',
            'nav_shape_options' => [
                'circle' => 'Cercle',
                'square' => 'Carré',
                'none' => 'Aucune',
            ],
            'nav_icon_label' => 'Icône de navigation',
            'nav_icon_options' => [
                'arrow' => 'Flèche',
                'chevron' => 'Chevron',
            ],

            'appearance_header' => 'Apparence',
            'color_scheme_label' => 'Palette de couleurs',
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
        'placeholder' => [
            'product' => 'Produit :index',
        ],

        'presets' => [
            'featured' => [
                'name' => 'Produits en vedette',
            ],
            'new' => [
                'name' => 'Nouveautés',
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
            'scheme_note' => 'Cela remplace la palette de couleurs globale du thème. Les modifications du thème principal n\'affecteront pas cette section.',
        ],
    ],

    'product-information' => [
        'name' => 'Informations produit',
        'description' => 'Affiche la galerie média et les détails du produit dans une mise en page en grille flexible.',

        'settings' => [
            'section_width_label' => 'Largeur de la section',
            'section_width_options' => [
                'container' => 'Conteneur',
                'full_width' => 'Pleine largeur',
            ],

            'layout_header' => 'Mise en page',
            'media_position_label' => 'Position des médias',
            'media_position_options' => [
                'left' => 'Gauche',
                'right' => 'Droite',
            ],
            'equal_columns_label' => 'Colonnes égales',
            'equal_columns_info' => 'Donne la même largeur aux colonnes médias et détails (50/50 au lieu d’un ratio 2:1)',
            'gap_label' => 'Espacement',
            'gap_info' => 'Espace entre les colonnes médias et détails',

            'appearance_header' => 'Apparence',
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
        'name' => 'Texte avec Image',
        'description' => 'Afficher du contenu textuel accompagné d’une image avec une disposition configurable.',

        'settings' => [
            'image_label' => 'Image',
            'image_position_label' => 'Position de l’image',
            'left_label' => 'Image en premier',
            'right_label' => 'Image en second',

            'image_height_label' => 'Hauteur de l’image',
            'image_height_auto' => 'Adapter à l’image',
            'image_height_sm' => 'Petite',
            'image_height_md' => 'Moyenne',
            'image_height_lg' => 'Grande',

            'image_width_label' => 'Largeur de l’image (Bureau)',
            'width_sm' => 'Petite',
            'width_md' => 'Moyenne',
            'width_lg' => 'Grande',

            'content_position_label' => 'Position du contenu (Verticale)',
            'position_top' => 'Haut',
            'position_middle' => 'Milieu',
            'position_bottom' => 'Bas',

            'content_align_label' => 'Alignement du contenu (Bureau)',
            'content_align_mobile_label' => 'Alignement du contenu (Mobile)',
            'align_start' => 'Début',
            'align_center' => 'Centre',
            'align_end' => 'Fin',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'En-tête',
                'settings' => [
                    'text_label' => 'Texte de l’en-tête',
                    'text_default' => 'Image avec texte',
                ],
            ],
            'body' => [
                'label' => 'Texte principal',
                'settings' => [
                    'content_label' => 'Texte du paragraphe',
                    'content_default' => 'Associez du texte à une image pour mettre en valeur un produit, une collection ou un article de blog. Ajoutez des détails sur la disponibilité, le style ou même un avis.',
                ],
            ],
            'button' => [
                'label' => 'Bouton',
                'settings' => [
                    'text_label' => 'Texte du bouton',
                    'url_label' => 'URL du bouton',
                    'text_default' => 'Texte du bouton',
                    'variant_label' => 'Variante du bouton',

                    'variant_primary' => 'Principal',
                    'variant_secondary' => 'Secondaire',
                    'variant_accent' => 'Accent',
                    'variant_neutral' => 'Neutre',

                    'style_label' => 'Style du bouton',
                    'style_solid' => 'Plein',
                    'style_soft' => 'Doux',
                    'style_outline' => 'Contour',
                    'style_ghost' => 'Fantôme',
                ],
            ],
        ],
    ],

    'collage' => [
        'name' => 'Collage',
        'description' => 'Mise en page flexible pour mélanger des images, des produits et des catégories.',

        'settings' => [
            'heading_label' => 'Titre',
            'heading_size_label' => 'Taille du titre',
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
                    'image_label' => 'Image',
                    'title_label' => 'Titre',
                    'text_label' => 'Description',
                    'link_label' => 'Lien',
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
        'name' => 'Formulaire de Contact',
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

    'compare' => [
        'name' => 'Comparer les produits',
        'description' => 'Affiche un tableau comparatif des produits sélectionnés avec leurs attributs et fonctionnalités.',
    ],

    'wishlist' => [
        'name' => 'Liste de souhaits',
        'description' => 'Affiche les articles enregistrés dans la liste de souhaits du client avec des options pour les ajouter au panier ou les supprimer.',
    ],

    'customer-edit-address' => [
        'name' => 'Modifier l’adresse',
    ],

    'customer-add-address' => [
        'name' => 'Ajouter une adresse',
    ],

    'customer-addresses' => [
        'name' => 'Adresses',
    ],

    'customer-orders' => [
        'name' => 'Commandes',
    ],

    'customer-order-details' => [
        'name' => 'Détails de la commande',
    ],

    'customer-reviews' => [
        'name' => 'Avis',
    ],

    'downloadables' => [
        'name' => 'Téléchargements',
    ],

    'login-form' => [
        'name' => 'Formulaire de connexion',
    ],

    'register-form' => [
        'name' => 'Formulaire d’inscription',
    ],

    'profile' => [
        'name' => 'Profil',
    ],

    'profile-form' => [
        'name' => 'Formulaire de profil',
    ],

    'cms-page' => [
        'name' => 'Page CMS',
        'description' => 'Affiche le contenu d’une page CMS, permettant l’affichage de texte et de médias statiques ou dynamiques dans une mise en page sectionnée.',
    ],

    'error-page' => [
        'name' => 'Page d’erreur',
        'description' => 'Affiche un message d’erreur stylisé (par exemple 404 ou 500) avec des liens de navigation ou une recherche en option pour aider les utilisateurs à se repérer.',
    ],

    'flex-section' => [
        'name' => 'Section flexible',
        'description' => 'Une section universelle qui accepte tout type de bloc avec des contrôles complets de mise en page, de taille et de style.',

        'empty_state' => 'Ajoutez des blocs pour commencer',

        'presets' => [
            'custom_section' => [
                'name' => 'Section personnalisée',
            ],
            'rich_text' => [
                'name' => 'Section texte enrichi',
                'heading' => 'Nouveautés',
                'description' => 'Nous concevons des objets qui fonctionnent mieux et durent plus longtemps. Nos produits résolvent de vrais problèmes avec un design épuré et des matériaux honnêtes.',
                'cta' => 'Acheter maintenant',
            ],
            'faq' => [
                'name' => 'Section FAQ',
                'heading' => 'Questions fréquentes',
                'items' => [
                    'return_policy' => [
                        'question' => 'Quelle est la politique de retour ?',
                        'answer' => 'Notre objectif est que chaque client soit entièrement satisfait de son achat. Si ce n’est pas le cas, contactez-nous et nous ferons de notre mieux pour trouver une solution.',
                    ],
                    'final_sale' => [
                        'question' => 'Certains achats sont-ils définitifs ?',
                        'answer' => 'Nous ne pouvons pas accepter les retours sur certains articles. Ceux-ci seront clairement indiqués avant l’achat.',
                    ],
                    'order_delivery' => [
                        'question' => 'Quand recevrai-je ma commande ?',
                        'answer' => 'Nous expédierons votre commande aussi rapidement que possible. Une fois expédiée, vous recevrez un e-mail avec plus d’informations. Les délais de livraison varient selon votre emplacement.',
                    ],
                    'manufacturing' => [
                        'question' => 'Où vos produits sont-ils fabriqués ?',
                        'answer' => 'Nos produits sont fabriqués localement et dans le monde entier. Nous sélectionnons soigneusement nos partenaires de fabrication afin de garantir des produits de qualité et à juste prix.',
                    ],
                    'shipping_cost' => [
                        'question' => 'Combien coûte la livraison ?',
                        'answer' => 'Les frais de livraison sont calculés selon votre emplacement et les articles de votre commande. Vous connaîtrez toujours le prix de livraison avant l’achat.',
                    ],
                ],
            ],
            'image_with_text' => [
                'name' => 'Image avec texte',
                'content' => 'Contenu',
                'heading' => 'Image avec texte',
                'description' => 'Associez du texte à une image pour mettre en valeur un produit, une collection ou un article de blog. Ajoutez des détails sur la disponibilité, le style ou même un avis.',
                'cta' => 'Acheter maintenant',
            ],
            'hero_banner' => [
                'name' => 'Bannière Hero',
                'heading' => 'Bienvenue dans notre boutique',
                'description' => 'Découvrez nos meilleurs produits et offres.',
                'buttons' => 'Boutons',
                'cta' => 'Voir les collections',
            ],
            'feature_icons' => [
                'name' => 'Icônes de fonctionnalité',
                'heading' => 'Pourquoi acheter chez nous ?',
                'description' => 'Découvrez nos services pensés pour nos clients',
                'grid' => 'Grille des fonctionnalités',
                'feature' => 'Fonctionnalité',
                'items' => [
                    'free_shipping' => [
                        'title' => 'Livraison gratuite',
                        'description' => 'Livraison gratuite pour les commandes de plus de 50 $',
                    ],
                    'support' => [
                        'title' => 'Assistance 24/7',
                        'description' => 'Contactez-nous à tout moment, où que vous soyez',
                    ],
                    'secure_payment' => [
                        'title' => 'Paiement sécurisé',
                        'description' => 'Paiement 100 % sécurisé garanti',
                    ],
                    'easy_returns' => [
                        'title' => 'Retours faciles',
                        'description' => 'Politique de retour sous 30 jours',
                    ],
                ],
            ],
        ],

        'settings' => [
            'layout_header' => 'Mise en page',

            'direction_label' => 'Direction',
            'direction_options' => [
                'horizontal' => 'Horizontale',
                'vertical' => 'Verticale',
            ],
            'gap_label' => 'Espacement entre les éléments',
            'gap_info' => 'Espace entre les blocs enfants',

            'size_header' => 'Taille',

            'section_width_label' => 'Largeur du contenu',
            'section_width_options' => [
                'full' => 'Pleine largeur',
                'container' => 'Conteneur',
            ],
            'section_width_info' => 'Le conteneur limite la largeur maximale et centre le contenu',

            'section_height_label' => 'Hauteur de la section',
            'section_height_options' => [
                'auto' => 'Automatique',
                'xs' => 'Très petite',
                'sm' => 'Petite',
                'md' => 'Moyenne',
                'lg' => 'Grande',
                'screen' => 'Plein écran',
                'custom' => 'Personnalisée',
            ],

            'section_height_custom_label' => 'Hauteur personnalisée',

            'appearance_header' => 'Apparence',

            'color_scheme_label' => 'Palette de couleurs',

            'background_type_label' => 'Type d’arrière-plan',
            'background_type_options' => [
                'none' => 'Aucun',
                'color' => 'Couleur',
                'gradient' => 'Dégradé',
                'image' => 'Image',
            ],

            'background_color_label' => 'Couleur d’arrière-plan',

            'background_gradient_label' => 'Dégradé d’arrière-plan',

            'background_image_label' => 'Image d’arrière-plan',

            'background_position_label' => 'Position de l’arrière-plan',
            'background_position_options' => [
                'center' => 'Centre',
                'top' => 'Haut',
                'bottom' => 'Bas',
                'left' => 'Gauche',
                'right' => 'Droite',
            ],

            'background_size_label' => 'Taille de l’arrière-plan',
            'background_size_options' => [
                'cover' => 'Couvrir',
                'contain' => 'Contenir',
                'auto' => 'Automatique',
            ],

            'background_repeat_label' => 'Répétition de l’arrière-plan',
            'background_repeat_options' => [
                'no_repeat' => 'Ne pas répéter',
                'repeat' => 'Répéter',
                'repeat_x' => 'Répéter horizontalement',
                'repeat_y' => 'Répéter verticalement',
            ],

            'border_label' => 'Afficher la bordure',
            'border_width_label' => 'Largeur de la bordure',
            'border_opacity_label' => 'Opacité de la bordure',
            'border_radius_label' => 'Rayon de la bordure',
            'border_radius_options' => [
                'none' => 'Aucun',
                'sm' => 'Petit',
                'md' => 'Moyen',
                'lg' => 'Grand',
                'xl' => 'Très grand',
                'full' => 'Complet',
            ],

            'toggle_overlay_label' => 'Afficher l’overlay',
            'toggle_overlay_info' => 'Ajoute un overlay au-dessus du média d’arrière-plan',

            'overlay_color_label' => 'Couleur de l’overlay',
            'overlay_color_options' => [
                'black' => 'Noir',
                'white' => 'Blanc',
            ],

            'overlay_style_label' => 'Style de l’overlay',
            'overlay_style_options' => [
                'solid' => 'Uni',
                'gradient' => 'Dégradé',
            ],

            'overlay_gradient_label' => 'Dégradé de l’overlay',
        ],
    ],

    'feature-icons' => [
        'name' => 'Icônes de Fonctionnalité',
        'description' => 'Afficher une rangée d’icônes avec des titres et de courtes descriptions.',

        'settings' => [
            'heading_label' => 'Titre de la section',
            'description_label' => 'Description de la section',
            'icon_size_label' => 'Taille des icônes (px)',
            'columns_label' => 'Colonnes sur ordinateur',
            'layout_label' => 'Disposition',
            'layout_horizontal' => 'Icône à gauche, texte à droite',
            'layout_vertical' => 'Icône en haut, texte en dessous',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'Fonctionnalité',
                'settings' => [
                    'icon_label' => 'Icône',
                    'title_label' => 'Titre',
                    'text_label' => 'Description',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'Titre',
            'text' => 'Un texte complémentaire pour développer la fonctionnalité',
        ],
    ],

];
