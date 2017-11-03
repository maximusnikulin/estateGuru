<?php
/**
 * Файл настроек для модуля realty
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.realty.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.realty.RealtyModule',
    ],
    'import'    => [],
    'component' => [
        'realty' => [
            'class' => 'application.modules.realty.components.Realty',
        ],
    ],
    'rules'     => [
        '/' => '/realty/realty/index',
        '/services' => '/realty/realty/services',
        '/contacts' => '/realty/realty/contacts',
        '/api/objects' => 'realty/realty/getBuildingsForMap',
        '/api/apartments' => 'realty/realty/getApartmentsForMap',
        '/realty' => 'realty/realty/index',
        '/search/map/<type:\w+>' => 'realty/realty/searchMap',
        '/search/cards/<type:\w+>' => 'realty/realty/searchCards',

        '/zhilie-kompleksy' => 'realty/realty/listDistricts',
        '/zastroyschiki' => 'realty/realty/listBuilders',
        '/stroyaschiesya-doma' => 'realty/realty/nonReady',
        '/kommercheskaya-nedvigimost' => 'realty/realty/commercial',
        '/novostoyki' => 'realty/realty/ready',
        '/vtorichniy-rinok' => 'realty/realty/resell',
        '/dom/<name>/<id>' => 'realty/realty/viewApartment',
        '/dom/<name>' => 'realty/realty/viewBuilding',
        '/zhiloy-kompleks/<name>' => 'realty/realty/viewDistrict',
        '/zastroyschik/<name>' => 'realty/realty/viewBuilder',
        '/<module:\w+>/<controller:\w+>/<action:\w+>' => '/<module>/<controller>/<action>',
    ],

];