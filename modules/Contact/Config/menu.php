<?php

return [
    [
        'id' => 'ocms-menu-contact',
        'priority' => 95,
        'parent_id' => null,
        'name' => 'contact::messages.contacts',
        'icon' => 'fas fa-headset',
        'url' => route('admin.contacts.index'),
        'permissions' => ['contact.view']
    ]
];
