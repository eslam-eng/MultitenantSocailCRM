<?php

return [
    'already_active' => 'الاشتراك مفعل بالفعل.',
    'already_canceled' => 'الاشتراك ملغى بالفعل.',
    'already_expired' => 'الاشتراك منتهي بالفعل.',
    'already_suspended' => 'الاشتراك معلق بالفعل.',
    'already_past_due' => 'الاشتراك متأخر بالفعل.',
    'cannot_activate_canceled' => 'لا يمكن تفعيل اشتراك ملغى.',
    'cannot_expire_canceled' => 'لا يمكن إنهاء اشتراك ملغى.',
    'cannot_suspend_canceled' => 'لا يمكن تعليق اشتراك ملغى.',
    'cannot_mark_past_due_canceled' => 'لا يمكن وضع اشتراك ملغى كمتأخر.',
    'cannot_expire_pending' => 'لا يمكن إنهاء اشتراك معلق.',
    'cannot_suspend_pending' => 'لا يمكن تعليق اشتراك معلق.',
    'cannot_mark_past_due_pending' => 'لا يمكن وضع اشتراك معلق كمتأخر.',
    'cannot_suspend_expired' => 'لا يمكن تعليق اشتراك منتهي.',
    'cannot_mark_past_due_expired' => 'لا يمكن وضع اشتراك منتهي كمتأخر.',
    'cannot_mark_past_due_suspended' => 'لا يمكن وضع اشتراك معلق كمتأخر.',

    // feature----------------------------------
    'limit' => 'القيود',
    'feature' => 'الميزات',

    'active' => 'نشط',
    'inactive' => 'غير نشط',

    'tenant_missing' => 'تعذر العثور على حسابك. يرجى التحقق من الرابط أو التواصل مع الدعم.',
    'subscription' => [
        'pending' => 'قيد الانتظار',
        'active' => 'نشط',
        'canceled' => 'ملغي',
        'expired' => 'منتهي',
        'suspended' => 'معلق',
        'past_due' => 'متأخر عن السداد',
    ],
    'tenant_user' => [
        'name_required' => 'الاسم مطلوب.',
        'name_string' => 'يجب أن يكون الاسم نصًا.',
        'email_required' => 'البريد الإلكتروني مطلوب.',
        'email_email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالح.',
        'email_unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
        'role_id_required' => 'الدور مطلوب.',
        'role_id_integer' => 'يجب أن يكون معرف الدور رقمًا صحيحًا.',
        'role_id_exists' => 'الدور المحدد غير موجود.',
        'phone_string' => 'يجب أن يكون رقم الهاتف نصًا.',
        'department_id_integer' => 'يجب أن يكون معرف القسم رقمًا صحيحًا.',
        'department_id_exists' => 'القسم المحدد غير موجود.',
        'tenant_id_required' => 'المستأجر مطلوب.',
        'tenant_id_integer' => 'يجب أن يكون معرف المستأجر رقمًا صحيحًا.',
        'tenant_id_exists' => 'المستأجر المحدد غير موجود.',
    ],
];
