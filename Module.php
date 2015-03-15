<?php

namespace frenzelgmbh\sblog;

use yii\base\Module as BaseModule;

/**
 * Smart Weblog Module for Yii2
 *
 * @author Philipp frenzel <philipp@frenzel.net>
 */
class Module extends BaseModule 
{

    const VERSION = '0.1.1-dev';

    /**
     * controllerNamespace
     * 
     * (default value: 'frenzelgmbh\sblog\controllers')
     * @var string
     * @access public
     */
    public $controllerNamespace = 'frenzelgmbh\sblog\controllers';

    /**
     * @var string|null View path. Leave as null to use default "@user/views"
     */
    public $viewPath;

    /**
     * @var string|null main layout that should be used by default we set it to null
     */
    public $layout = 'main';

    /**
     * [$layoutPath description]
     * @var string
     */
    public $layoutPath = '@app/views/layouts';

    /**
     * @var array
     */
    public static $blogMenu = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setAliases([
            '@sblog' => dirname(__FILE__)
        ]);
    }

}
