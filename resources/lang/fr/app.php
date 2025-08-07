<?php

return [
    'already_active' => 'L’abonnement est déjà actif.',
    'already_canceled' => 'L’abonnement est déjà annulé.',
    'already_expired' => 'L’abonnement est déjà expiré.',
    'already_suspended' => 'L’abonnement est déjà suspendu.',
    'already_past_due' => 'L’abonnement est déjà en retard de paiement.',

    'cannot_activate_canceled' => 'Impossible d’activer un abonnement annulé.',
    'cannot_expire_canceled' => 'Impossible d’expirer un abonnement annulé.',
    'cannot_suspend_canceled' => 'Impossible de suspendre un abonnement annulé.',
    'cannot_mark_past_due_canceled' => 'Impossible de marquer un abonnement annulé comme en retard de paiement.',

    'cannot_expire_pending' => 'Impossible d’expirer un abonnement en attente.',
    'cannot_suspend_pending' => 'Impossible de suspendre un abonnement en attente.',
    'cannot_mark_past_due_pending' => 'Impossible de marquer un abonnement en attente comme en retard de paiement.',

    'cannot_suspend_expired' => 'Impossible de suspendre un abonnement expiré.',
    'cannot_mark_past_due_expired' => 'Impossible de marquer un abonnement expiré comme en retard de paiement.',
    'cannot_mark_past_due_suspended' => 'Impossible de marquer un abonnement suspendu comme en retard de paiement.',

    // feature----------------------------------
    'limit' => 'Limites',
    'feature' => 'Fonctionnalités',
    'active' => 'Actif',
    'inactive' => 'Inactif',
    'tenant_missing' => "Nous n'avons pas pu trouver votre compte. Veuillez vérifier le lien que vous avez utilisé ou contacter le support.",
    'subscription' => [
        'pending' => 'En attente',
        'active' => 'Actif',
        'canceled' => 'Annulé',
        'expired' => 'Expiré',
        'suspended' => 'Suspendu',
        'past_due' => 'En retard',
    ],
    'tenant_user' => [
        'name_required' => 'Name is required.',
        'name_string' => 'Name must be a string.',
        'email_required' => 'Email is required.',
        'email_email' => 'Email must be a valid email address.',
        'email_unique' => 'This email is already taken.',
        'role_id_required' => 'Role is required.',
        'role_id_integer' => 'Role ID must be an integer.',
        'role_id_exists' => 'Selected role does not exist.',
        'phone_string' => 'Phone must be a string.',
        'department_id_integer' => 'Department ID must be an integer.',
        'department_id_exists' => 'Selected department does not exist.',
        'tenant_id_required' => 'Tenant is required.',
        'tenant_id_integer' => 'Tenant ID must be an integer.',
        'tenant_id_exists' => 'Selected tenant does not exist.',
    ],
];
