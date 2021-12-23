<?php

namespace app\module\main;

class Module extends \yii\base\Module
{
    public function init()
    {
        \Yii::setAlias('@app', dirname(dirname(__DIR__)) . '/module/main');
        \Yii::$app->setViewPath(dirname(dirname(__DIR__)) . '/module/main/views');

        parent::init();
    }
}
