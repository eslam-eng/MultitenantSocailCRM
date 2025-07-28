<?php

return [
    'identifier_required' => "L'e-mail ou le numéro de téléphone est requis.",
    'password_invalid' => 'Veuillez entrer un mot de passe valide.',
    'currency_code' => 'Le code de devise spécifié est invalide.',
    'name_required' => 'Le champ nom est requis.',
    'name_array' => 'Le nom doit être un tableau.',
    'name_min' => 'Au moins un nom est requis.',
    'description_string' => 'La description doit être une chaîne de caractères.',
    'is_active_required' => 'Le champ état est requis.',
    'is_active_boolean' => "L'état doit être vrai ou faux.",
    'slug_required' => 'Le slug est requis.',
    'slug_unique' => 'Le slug / nom est déjà utilisé.',
    'slug_string' => 'Le slug / nom doit être une chaîne de caractères.',
    'group_required' => 'Le groupe est requis.',
    'group_invalid' => 'Le groupe spécifié est invalide.',
    'auth_failed' => 'Ces identifiants ne correspondent pas à nos enregistrements.',

    // Locale-aware messages
    'name_locale_required' => 'Le nom en :locale est requis.',
    'name_locale_string' => 'Le nom en :locale doit être une chaîne de caractères.',

    'custom' => [
        'email' => [
            'required' => "L'adresse e-mail est requise.",
            'email' => 'Veuillez saisir une adresse e-mail valide.',
            'unique' => 'Cette adresse e-mail est déjà enregistrée. Veuillez en utiliser une autre ou vous connecter.',
        ],
        'name' => [
            'required' => 'Le nom est requis.',
        ],
        'organization_name' => [
            'required' => "Le nom de l'organisation est requis.",
        ],
        'password' => [
            'required' => 'Le mot de passe est requis.',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ],
        'template' => [
            // Basic template fields
            'name_required' => 'Le nom du modèle est requis',
            'name_string' => 'Le nom du modèle doit être une chaîne de caractères',
            'name_max' => 'Le nom du modèle ne peut pas dépasser :max caractères',

            'description_string' => 'La description doit être une chaîne de caractères',
            'description_max' => 'La description ne peut pas dépasser :max caractères',

            'category_required' => 'La catégorie de campagne est requise',
            'category_in' => 'La catégorie de campagne sélectionnée est invalide. Options valides: :values',

            'template_type_required' => 'Le type de modèle est requis',
            'template_type_in' => 'Le type de modèle sélectionné est invalide. Options valides: :values',

            'content_required' => 'Le contenu du modèle est requis',
            'content_string' => 'Le contenu du modèle doit être une chaîne de caractères',

            'header_content_string' => 'Le contenu de l\'en-tête doit être une chaîne de caractères',
            'header_content_max' => 'Le contenu de l\'en-tête ne peut pas dépasser :max caractères',

            'footer_content_string' => 'Le contenu du pied de page doit être une chaîne de caractères',
            'footer_content_max' => 'Le contenu du pied de page ne peut pas dépasser :max caractères',

            'is_active_required' => 'Le statut d\'activation est requis',
            'is_active_boolean' => 'Le statut d\'activation doit être vrai ou faux',

            // Template buttons validation
            'template_buttons_array' => 'Les boutons du modèle doivent être un tableau',
            'template_buttons_min' => 'Au moins :min bouton est requis',

            'button_text_required' => 'Le texte du bouton est requis pour le bouton à la position :position',
            'button_text_string' => 'Le texte du bouton doit être une chaîne pour le bouton à la position :position',
            'button_text_max' => 'Le texte du bouton ne peut pas dépasser :max caractères pour le bouton à la position :position',

            'button_type_required' => 'Le type de bouton est requis pour le bouton à la position :position',
            'button_type_in' => 'Type de bouton invalide pour le bouton à la position :position. Types valides: :values',

            'action_value_required' => 'La valeur d\'action est requise pour le bouton à la position :position',
            'action_value_string' => 'La valeur d\'action doit être une chaîne pour le bouton à la position :position',

            // Template parameters validation
            'template_parms_array' => 'Les paramètres du modèle doivent être un tableau',
            'template_parms_min' => 'Au moins :min paramètre est requis',

            'parm_name_required' => 'Le nom du paramètre est requis pour le paramètre à la position :position',
            'parm_name_string' => 'Le nom du paramètre doit être une chaîne pour le paramètre à la position :position',
            'parm_name_max' => 'Le nom du paramètre ne peut pas dépasser :max caractères pour le paramètre à la position :position',

        ],
    ],
];
