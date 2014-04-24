<?php

namespace frenzelgmbh\golfteamplanner;

use yii\base\Module as BaseModule;

/**
 * Golf Team Planner Module
 *
 * @author Philipp frenzel <philipp@frenzel.net>
 */
class Module extends BaseModule {

    const VERSION = '0.1.0-dev';

    /**
     * @var string|null View path. Leave as null to use default "@user/views"
     */
    public $viewPath;

    /**
     * @var string|null main layout that should be used by default we set it to /main
     */
    public $mainLayout = '/main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        \Yii::setAlias('@golfteamplanner', dirname(__FILE__));
        \Yii::$app->i18n->translations['golfteamplanner'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@golfteamplanner/messages',
        ];
    }

}
