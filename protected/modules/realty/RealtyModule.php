<?php
/**
 * RealtyModule основной класс модуля realty
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.realty
 * @since 0.1
 */

class RealtyModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';


    /**
     * @var string
     */
     public $seoTemplateForHome;
     public $seoTemplateForCottage;
     public $seoTemplateForEarth;
     public $seoTemplateForCommercial;
     public $seoTemplateForApartment;
     

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $phone2;

    public function getPhoneForLink($phone = null)
    {
        if (is_null($phone)) {
            $phone = $this->phone;
        }
        $phoneLink = preg_replace('~\D~','',$phone);
        if (strlen($phoneLink) >= 10) {
            $phoneLink = substr($phoneLink, strlen($phoneLink) - 10);
        }
        return 'tel:+7'.$phoneLink;
    }

    /**
     * @var string
     */
    public $adres;


    /**
     * @var string
     */
    public $uploadPath = 'realty';
    /**
     * @var string
     */
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    /**
     * @var int
     */
    public $minSize = 0;
    /**
     * @var
     */
    public $maxSize;
    /**
     * @var int
     */
    public $maxFiles = 1;

    public $itemsPerPage;

    /**
     * Массив с именами модулей, от которых зависит работа данного модуля
     *
     * @return array
     */
    public function getDependencies()
    {
        return parent::getDependencies();
    }

    /**
     * Работоспособность модуля может зависеть от разных факторов: версия php, версия Yii, наличие определенных модулей и т.д.
     * В этом методе необходимо выполнить все проверки.
     *
     * @return array или false
     */
    public function checkSelf()
    {
        return parent::checkSelf();
    }

    /**
     * Каждый модуль должен принадлежать одной категории, именно по категориям делятся модули в панели управления
     *
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('RealtyModule.realty', 'Realty');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            "itemsPerPage" => "Кол-во элементов на странице",
            "phone" => "Номер телефона №1",
            'phone2' => 'Номер телефона №2',
            "adres" => "Адрес",
            "seo" => "Адрес",
            'seoTemplateForHome' => 'Шаблон SEO для новостроек',
            'seoTemplateForCottage' => 'Шаблон SEO для коттеджей',
            'seoTemplateForEarth' => 'Шаблон SEO для участков',
            'seoTemplateForCommercial' => 'Шаблон SEO для коммерческой',
            'seoTemplateForApartment' => 'Шаблон SEO для квартир',
            "itemsPerPage" => "Элементов на странице",
            "uploadPath" => "Путь для загрузки изображений",
            "editor" => "Используемый визуальный редактор"

        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'phone',
            'phone2',
            'adres',
            'itemsPerPage',
            'uploadPath',
            'seoTemplateForHome',
            'seoTemplateForCottage',
            'seoTemplateForEarth',
            'seoTemplateForCommercial',
            'seoTemplateForApartment',
            'editor' => Yii::app()->getModule('yupe')->editors,
        ];

    }

    public function getSeoTemplateForBuilding(Building $model) {
        if ($model->status == STATUS_HOME) {
            return $this->seoTemplateForHome;
        }
        if ($model->status == STATUS_COTTAGE) {
            return $this->seoTemplateForCottage;
        }
        if ($model->status == STATUS_EARTH) {
            return $this->seoTemplateForEarth;
        }
        if ($model->status == STATUS_COMMERCIAL) {
            return $this->seoTemplateForCommercial;
        }
    }


    /**
     * @return bool
     */
    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir($this->uploadPath, 0755);
        }

        return true;
    }


    /**
     * массив групп параметров модуля, для группировки параметров на странице настроек
     *
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return parent::getEditableParamsGroups();
    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
           
            [
                'icon' => 'fa fa-fw fa-male',
                'label' => Yii::t('RealtyModule.realty', 'Builders'),
                'url' => ['/backend/realty/builder/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RealtyModule.realty', 'Builders list'),
                        'url' => ['/backend/realty/builder/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-plus-square',
                        'label' => Yii::t('RealtyModule.realty', 'Create builder'),
                        'url' => ['/backend/realty/builder/create'],
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-fw fa-calendar',
                'label' => Yii::t('RealtyModule.realty', 'ReadyTimes'),
                'url' => ['/backend/realty/readyTime/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RealtyModule.realty', 'ReadyTimes list'),
                        'url' => ['/backend/realty/readyTime/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-plus-square',
                        'label' => Yii::t('RealtyModule.realty', 'Create readyTime'),
                        'url' => ['/backend/realty/readyTime/create'],
                    ],
                ],
            ],
            // [
            //     'icon' => 'fa fa-fw fa-page',
            //     'label' => Yii::t('RealtyModule.realty', 'Страницы'),
            //     'url' => ['/backend/realty/realtyPage/index'],
            // ],
            [
                'icon' => 'fa fa-fw fa-home',
                'label' => Yii::t('RealtyModule.realty', 'Buildings'),
                'url' => ['/backend/realty/building/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RealtyModule.realty', 'Buildings list'),
                        'url' => ['/backend/realty/building/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-plus-square',
                        'label' => Yii::t('RealtyModule.realty', 'Create building'),
                        'url' => ['/backend/realty/building/create'],
                    ],
                ],
            ],
        ];
    }

    /**
     * текущая версия модуля
     *
     * @return string
     */
    public function getVersion()
    {
        return Yii::t('RealtyModule.realty', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('RealtyModule.realty', 'http://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('RealtyModule.realty', 'realty');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('RealtyModule.realty', 'Описание модуля "realty"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('RealtyModule.realty', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('RealtyModule.realty', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/realty/realtyBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-home";
    }

    /**
     * Возвращаем статус, устанавливать ли галку для установки модуля в инсталяторе по умолчанию:
     *
     * @return bool
     **/
    public function getIsInstallDefault()
    {
        return parent::getIsInstallDefault();
    }

    /**
     * Инициализация модуля, считывание настроек из базы данных и их кэширование
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'realty.models.*',
                'realty.components.*',
            ]
        );
    }

    /**
     * Массив правил модуля
     * @return array
     */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Realty.RealtyManager',
                'description' => Yii::t('RealtyModule.realty', 'Manage realty'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Realty.RealtyBackend.Index',
                        'description' => Yii::t('RealtyModule.realty', 'Index')
                    ],
                ]
            ]
        ];
    }
}
