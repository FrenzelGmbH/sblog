<?php

namespace frenzelgmbh\sblog;
use yii\base\BootstrapInterface;

/**
 * Blogs module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // Add module I18N category.
        if (!isset($app->i18n->translations['sblog']) && !isset($app->i18n->translations['sblog/*'])) {
            \Yii::$app->i18n->translations['sblog'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => '@frenzelgmbh/sblog/messages',
            ];
        }
    }
}