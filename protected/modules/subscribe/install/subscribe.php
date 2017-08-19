<?php
/**
 * Файл настроек для модуля subscribe
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2017 amyLabs && Yupe! team
 * @package yupe.modules.subscribe.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.subscribe.SubscribeModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/subscribe' => '/subscribe/subscribe/subscribe',
    ],
];