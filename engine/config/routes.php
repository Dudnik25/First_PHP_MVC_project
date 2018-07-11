<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'showIndex'
        ],
    'reg' => [
        'controller' => 'accounts',
        'action' => 'showReg'
    ],
    'logout' => [
        'controller' => 'accounts',
        'action' => 'logout'
    ],'id([0-9]{1,10})' => [
        'controller' => 'user',
        'action' => 'showUserPage'
    ],'settings' => [
        'controller' => 'user',
        'action' => 'showUserSettings'
    ],'catalog' => [
        'controller' => 'catalog',
        'action' => 'showCatalog'
    ],'favorites' => [
        'controller' => 'favorites',
        'action' => 'showFavorites'
    ],'events' => [
        'controller' => 'events',
        'action' => 'showEvents'
    ],'error' => [
        'controller' => 'main',
        'action' => 'errorPage'
    ],'test' => [
        'controller' => 'test',
        'action' => 'test'
    ],'admin' => [
        'controller' => 'admin',
        'action' => 'loginPageShow'
    ],'admin/id([0-9]{1,10})' => [
        'controller' => 'admin',
        'action' => 'userPageShow'
    ]


];