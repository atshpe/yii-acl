<?php

namespace app\module\home;

class Module extends \yii\base\Module
{
    public function init()
    {
        \Yii::setAlias('@app', dirname(dirname(__DIR__)) . '/module/home');
        \Yii::$app->setViewPath(dirname(dirname(__DIR__)) . '/module/home/views');

        parent::init();
    }
}
