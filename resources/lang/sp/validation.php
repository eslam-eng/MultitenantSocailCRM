<?php

return [
    'identifier_required' => 'Se requiere correo electrónico o número de teléfono.',
    'password_invalid' => 'Por favor, introduzca una contraseña válida.',
    'currency_code' => 'El código de moneda especificado no es válido.',
    'name_required' => 'El campo nombre es obligatorio.',
    'name_array' => 'El nombre debe ser un arreglo.',
    'name_min' => 'Se debe proporcionar al menos un nombre.',
    'description_string' => 'La descripción debe ser una cadena de texto.',
    'is_active_required' => 'El campo de estado es obligatorio.',
    'is_active_boolean' => 'El estado debe ser verdadero o falso.',
    'slug_required' => 'El identificador (slug) es obligatorio.',
    'slug_unique' => 'El identificador / nombre ya está en uso.',
    'slug_string' => 'El identificador / nombre debe ser una cadena de texto.',
    'group_required' => 'El grupo es obligatorio.',
    'group_invalid' => 'El grupo especificado no es válido.',
    'auth_failed' => 'Estas credenciales no coinciden con nuestros registros.',

    // Locale-aware messages
    'name_locale_required' => 'El nombre en :locale es obligatorio.',
    'name_locale_string' => 'El nombre en :locale debe ser una cadena de texto.',

    'custom' => [
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'email' => 'Por favor, introduzca un correo electrónico válido.',
            'unique' => 'Este correo electrónico ya está registrado. Utilice otro o inicie sesión.',
        ],
        'name' => [
            'required' => 'El nombre es obligatorio.',
        ],
        'organization_name' => [
            'required' => 'El nombre de la organización es obligatorio.',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'confirmed' => 'La confirmación de la contraseña no coincide.',
        ],
        'template' => [
            // Basic template fields
            'name_required' => 'El nombre de la plantilla es requerido',
            'name_string' => 'El nombre de la plantilla debe ser una cadena de texto',
            'name_max' => 'El nombre de la plantilla no puede exceder :max caracteres',

            'description_string' => 'La descripción debe ser una cadena de texto',
            'description_max' => 'La descripción no puede exceder :max caracteres',

            'category_required' => 'La categoría de campaña es requerida',
            'category_in' => 'La categoría de campaña seleccionada es inválida. Opciones válidas: :values',

            'template_type_required' => 'El tipo de plantilla es requerido',
            'template_type_in' => 'El tipo de plantilla seleccionado es inválido. Opciones válidas: :values',

            'content_required' => 'El contenido de la plantilla es requerido',
            'content_string' => 'El contenido de la plantilla debe ser una cadena de texto',

            'header_content_string' => 'El contenido del encabezado debe ser una cadena de texto',
            'header_content_max' => 'El contenido del encabezado no puede exceder :max caracteres',

            'footer_content_string' => 'El contenido del pie de página debe ser una cadena de texto',
            'footer_content_max' => 'El contenido del pie de página no puede exceder :max caracteres',

            'is_active_required' => 'El estado de activación es requerido',
            'is_active_boolean' => 'El estado de activación debe ser verdadero o falso',

            // Template buttons validation
            'template_buttons_array' => 'Los botones de la plantilla deben ser un array',
            'template_buttons_min' => 'Se requiere al menos :min botón',

            'button_text_required' => 'El texto del botón es requerido para el botón en la posición :position',
            'button_text_string' => 'El texto del botón debe ser una cadena para el botón en la posición :position',
            'button_text_max' => 'El texto del botón no puede exceder :max caracteres para el botón en la posición :position',

            'button_type_required' => 'El tipo de botón es requerido para el botón en la posición :position',
            'button_type_in' => 'Tipo de botón inválido para el botón en la posición :position. Tipos válidos: :values',

            'action_value_required' => 'El valor de acción es requerido para el botón en la posición :position',
            'action_value_string' => 'El valor de acción debe ser una cadena para el botón en la posición :position',

            // Template parameters validation
            'template_parms_array' => 'Los parámetros de la plantilla deben ser un array',
            'template_parms_min' => 'Se requiere al menos :min parámetro',

            'parm_name_required' => 'El nombre del parámetro es requerido para el parámetro en la posición :position',
            'parm_name_string' => 'El nombre del parámetro debe ser una cadena para el parámetro en la posición :position',
            'parm_name_max' => 'El nombre del parámetro no puede exceder :max caracteres para el parámetro en la posición :position',

        ],
    ],
];
