<?php

namespace app\module\acl;

class Module extends \yii\base\Module
{
    public function init()
    {
        // \Yii::setAlias('@acl', dirname(dirname(__DIR__)) . '/module/acl');
        \Yii::$app->on(\yii\base\Application::EVENT_BEFORE_REQUEST, function () {
            // debug(\Yii::$container);die;
            \Yii::$container->get('acl\gate')->run();
        });

        parent::init();
    }
}
