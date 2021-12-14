<?php

namespace app\modules\home;

class Module extends \yii\base\Module
{
    public function init()
    {
        \Yii::setAlias('@app', dirname(dirname(__DIR__)) . '/modules/home');
        // debug(\Yii::$app, true);die;
        \Yii::$app->setViewPath('/app/modules/home/views');
        parent::init();
    }
}
