<?php

return [
    'identifier_required' => 'Email or Phone is required',
    'password_invalid' => 'Please enter a valid password',
    'currency_code' => 'The selected currency code is invalid',
    'name_required' => 'The name field is required.',
    'name_array' => 'The name must be an array.',
    'name_min' => 'At least one name is required.',
    'description_string' => 'The description must be a string.',
    'is_active_required' => 'The status field is required.',
    'is_active_boolean' => 'The status must be true or false.',
    'slug_required' => 'The slug is required.',
    'slug_unique' => 'The name is already in use.',
    'slug_string' => 'The name must be a valid string.',
    'group_required' => 'The group field is required.',
    'group_invalid' => 'The selected group is invalid.',

    'auth_failed' => 'These credentials do not match our records.',
    // Locale-aware messages
    'name_locale_required' => 'The name in :locale is required.',
    'name_locale_string' => 'The name in :locale must be a string.',

    'custom' => [
        'email' => [
            'required' => 'Email address is required.',
            'email' => 'Please enter a valid email address.',
            'unique' => 'This email address is already registered. Please use a different email or try logging in.',
        ],
        'name' => [
            'required' => 'Name is required.',
        ],
        'organization_name' => [
            'required' => 'Organization name is required.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'confirmed' => 'Password confirmation does not match.',
        ],

        'template' => [
            // Basic template fields
            'name_required' => 'Template name is required',
            'name_string' => 'Template name must be a string',
            'name_max' => 'Template name cannot exceed :max characters',

            'description_string' => 'Description must be a string',
            'description_max' => 'Description cannot exceed :max characters',

            'category_required' => 'Campaign category is required',
            'category_in' => 'Selected campaign category is invalid. Valid options: :values',

            'template_type_required' => 'Template type is required',
            'template_type_in' => 'Selected template type is invalid. Valid options: :values',

            'content_required' => 'Template content is required',
            'content_string' => 'Template content must be a string',

            'header_content_string' => 'Header content must be a string',
            'header_content_max' => 'Header content cannot exceed :max characters',

            'footer_content_string' => 'Footer content must be a string',
            'footer_content_max' => 'Footer content cannot exceed :max characters',

            'is_active_required' => 'Active status is required',
            'is_active_boolean' => 'Active status must be true or false',

            // Template buttons validation
            'template_buttons_array' => 'Template buttons must be an array',
            'template_buttons_min' => 'At least :min button is required',

            'button_text_required' => 'Button text is required for button at position :position',
            'button_text_string' => 'Button text must be a string for button at position :position',
            'button_text_max' => 'Button text cannot exceed :max characters for button at position :position',

            'button_type_required' => 'Button type is required for button at position :position',
            'button_type_in' => 'Invalid button type for button at position :position. Valid types: :values',

            'action_value_required' => 'Action value is required for button at position :position',
            'action_value_string' => 'Action value must be a string for button at position :position',

            // Template parameters validation
            'template_parms_array' => 'Template parameters must be an array',
            'template_parms_min' => 'At least :min parameter is required',

            'parm_name_required' => 'Parameter name is required for parameter at position :position',
            'parm_name_string' => 'Parameter name must be a string for parameter at position :position',
            'parm_name_max' => 'Parameter name cannot exceed :max characters for parameter at position :position',

        ],
    ],
];
