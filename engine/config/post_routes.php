<?php

return [
    'login' => [
        'controller' => 'accounts',
        'action' => 'user_loggin'
    ],'register' => [
        'controller' => 'accounts',
        'action' => 'user_register'
    ],'settings' => [
        'controller' => 'user',
        'action' => 'user_settings'
    ],'cat_select_1' => [
        'controller' => 'catalog',
        'action' => 'catSelect1'
    ],'cat_select_2' => [
        'controller' => 'catalog',
        'action' => 'catSelect2'
    ],'favor_control' => [
        'controller' => 'favorites',
        'action' => 'favorControl'
    ],'favor_page' => [
        'controller' => 'favorites',
        'action' => 'favorPage'
    ],'calendar_page' => [
        'controller' => 'events',
        'action' => 'eventsShowContent'
    ],'events_date' => [
        'controller' => 'events',
        'action' => 'eventsDateShowContent'
    ],'admin_content' => [
        'controller' => 'admin',
        'action' => 'getAdminPageContent'
    ]

];