<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

function debug($meta, $get_class_methods = false) {
    if ($get_class_methods) {
        echo '<pre>';var_dump(get_class_methods($meta));echo '</pre>';
    } else {
        echo '<pre>';var_dump($meta);echo '</pre>';
    }
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
