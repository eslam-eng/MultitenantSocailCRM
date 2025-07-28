<?php

return [
    'identifier_required' => 'البريد الإلكتروني أو رقم الهاتف مطلوب',
    'password_invalid' => 'الرجاء إدخال كلمة مرور صالحة',
    'currency_code' => 'رمز العملة المحدد غير صالح',
    'name_required' => 'حقل الاسم مطلوب.',
    'name_array' => 'يجب أن يكون الاسم مصفوفة.',
    'name_min' => 'يجب إدخال اسم واحد على الأقل.',
    'description_string' => 'يجب أن يكون الوصف نصًا.',
    'is_active_required' => 'حقل الحالة مطلوب.',
    'is_active_boolean' => 'يجب أن تكون الحالة صحيحة أو خاطئة.',
    'slug_required' => 'المعرف (slug) مطلوب.',
    'slug_unique' => 'المعرف / الاسم مستخدم بالفعل.',
    'slug_string' => 'يجب أن يكون المعرف / الاسم نصًا.',
    'group_required' => 'المجموعة مطلوبة.',
    'group_invalid' => 'المجموعة المحددة غير صالحة.',
    'auth_failed' => 'بيانات الاعتماد هذه غير مطابقة لسجلاتنا.',
    // Locale-aware messages
    'name_locale_required' => 'الاسم باللغة :locale مطلوب.',
    'name_locale_string' => 'الاسم باللغة :locale يجب أن يكون نصًا.',
    'custom' => [
        'email' => [
            'required' => 'البريد الإلكتروني مطلوب.',
            'email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'unique' => 'هذا البريد الإلكتروني مسجل بالفعل. يرجى استخدام بريد إلكتروني آخر أو تسجيل الدخول.',
        ],
        'name' => [
            'required' => 'الاسم مطلوب.',
        ],
        'organization_name' => [
            'required' => 'اسم المؤسسة مطلوب.',
        ],
        'password' => [
            'required' => 'كلمة المرور مطلوبة.',
            'confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ],
        'template' => [
            // Basic template fields
            'name_required' => 'اسم القالب مطلوب',
            'name_string' => 'اسم القالب يجب أن يكون نص',
            'name_max' => 'اسم القالب لا يمكن أن يتجاوز :max حرف',

            'description_string' => 'الوصف يجب أن يكون نص',
            'description_max' => 'الوصف لا يمكن أن يتجاوز :max حرف',

            'category_required' => 'فئة الحملة مطلوبة',
            'category_in' => 'فئة الحملة المحددة غير صحيحة. الخيارات الصحيحة: :values',

            'template_type_required' => 'نوع القالب مطلوب',
            'template_type_in' => 'نوع القالب المحدد غير صحيح. الخيارات الصحيحة: :values',

            'content_required' => 'محتوى القالب مطلوب',
            'content_string' => 'محتوى القالب يجب أن يكون نص',

            'header_content_string' => 'محتوى الرأس يجب أن يكون نص',
            'header_content_max' => 'محتوى الرأس لا يمكن أن يتجاوز :max حرف',

            'footer_content_string' => 'محتوى التذييل يجب أن يكون نص',
            'footer_content_max' => 'محتوى التذييل لا يمكن أن يتجاوز :max حرف',

            'is_active_required' => 'حالة التفعيل مطلوبة',
            'is_active_boolean' => 'حالة التفعيل يجب أن تكون صحيح أو خطأ',

            // Template buttons validation
            'template_buttons_array' => 'أزرار القالب يجب أن تكون مصفوفة',
            'template_buttons_min' => 'مطلوب على الأقل :min زر',

            'button_text_required' => 'نص الزر مطلوب للزر في الموضع :position',
            'button_text_string' => 'نص الزر يجب أن يكون نص للزر في الموضع :position',
            'button_text_max' => 'نص الزر لا يمكن أن يتجاوز :max حرف للزر في الموضع :position',

            'button_type_required' => 'نوع الزر مطلوب للزر في الموضع :position',
            'button_type_in' => 'نوع الزر غير صحيح للزر في الموضع :position. الأنواع الصحيحة: :values',

            'action_value_required' => 'قيمة العمل مطلوبة للزر في الموضع :position',
            'action_value_string' => 'قيمة العمل يجب أن تكون نص للزر في الموضع :position',

            // Template parameters validation
            'template_parms_array' => 'معاملات القالب يجب أن تكون مصفوفة',
            'template_parms_min' => 'مطلوب على الأقل :min معامل',

            'parm_name_required' => 'اسم المعامل مطلوب للمعامل في الموضع :position',
            'parm_name_string' => 'اسم المعامل يجب أن يكون نص للمعامل في الموضع :position',
            'parm_name_max' => 'اسم المعامل لا يمكن أن يتجاوز :max حرف للمعامل في الموضع :position',

        ],
    ],

];
