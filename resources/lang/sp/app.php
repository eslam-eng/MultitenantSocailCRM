<?php

return [
    'already_active' => 'La suscripción ya está activa.',
    'already_canceled' => 'La suscripción ya está cancelada.',
    'already_expired' => 'La suscripción ya ha expirado.',
    'already_suspended' => 'La suscripción ya está suspendida.',
    'already_past_due' => 'La suscripción ya está vencida.',

    'cannot_activate_canceled' => 'No se puede activar una suscripción cancelada.',
    'cannot_expire_canceled' => 'No se puede expirar una suscripción cancelada.',
    'cannot_suspend_canceled' => 'No se puede suspender una suscripción cancelada.',
    'cannot_mark_past_due_canceled' => 'No se puede marcar una suscripción cancelada como vencida.',

    'cannot_expire_pending' => 'No se puede expirar una suscripción pendiente.',
    'cannot_suspend_pending' => 'No se puede suspender una suscripción pendiente.',
    'cannot_mark_past_due_pending' => 'No se puede marcar una suscripción pendiente como vencida.',

    'cannot_suspend_expired' => 'No se puede suspender una suscripción expirada.',
    'cannot_mark_past_due_expired' => 'No se puede marcar una suscripción expirada como vencida.',
    'cannot_mark_past_due_suspended' => 'No se puede marcar una suscripción suspendida como vencida.',

    // feature----------------------------------
    'limit' => 'Límites',
    'feature' => 'Funciones',
    'active' => 'Activo',
    'inactive' => 'Inactivo',
    'tenant_missing' => 'No pudimos encontrar tu cuenta. Por favor revisa el enlace que usaste o contacta al soporte.',
    'subscription' => [
        'pending' => 'Pendiente',
        'active' => 'Activo',
        'canceled' => 'Cancelado',
        'expired' => 'Expirado',
        'suspended' => 'Suspendido',
        'past_due' => 'Vencido',
    ],
    'tenant_user' => [
        'name_required' => 'El nombre es obligatorio.',
        'name_string' => 'El nombre debe ser una cadena de texto.',
        'email_required' => 'El correo electrónico es obligatorio.',
        'email_email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'email_unique' => 'Este correo electrónico ya está en uso.',
        'role_id_required' => 'El rol es obligatorio.',
        'role_id_integer' => 'El ID de rol debe ser un número entero.',
        'role_id_exists' => 'El rol seleccionado no existe.',
        'phone_string' => 'El teléfono debe ser una cadena de texto.',
        'department_id_integer' => 'El ID del departamento debe ser un número entero.',
        'department_id_exists' => 'El departamento seleccionado no existe.',
        'tenant_id_required' => 'El inquilino es obligatorio.',
        'tenant_id_integer' => 'El ID del inquilino debe ser un número entero.',
        'tenant_id_exists' => 'El inquilino seleccionado no existe.',
    ],
];
