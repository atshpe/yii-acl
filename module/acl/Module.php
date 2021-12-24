<?php

namespace app\module\acl;

class Module extends \yii\base\Module
{
    public function init()
    {
        \Yii::setAlias('@acl', dirname(dirname(__DIR__)) . '/module/acl');

        $this->initServices();

        \Yii::$app->on(\yii\base\Application::EVENT_BEFORE_ACTION, function () {
            \Yii::$container->get('acl\gate')->run();
        });

        parent::init();
    }

    public function getConfig() : array
    {
        return require __DIR__ . '/config/base.php';
    }

    private function initServices()
    {
        \Yii::$container->set('acl\role', function () {
            return new \acl\service\RoleService();
        });

        // $identity = $session->getIdentity();
        $identity = (object) [
            'id' => null,
            'username' => null,
            'role' => 'DynamicUser',
            'email' => null,
        ];

        $config = $this->getConfig();
        $roleService = \Yii::$container->get('acl\role');

        \Yii::$container->set('acl\gate', function () use (
            $identity,
            $config,
            $roleService
        ) {
            return new \acl\service\Gate(
                $identity,
                $config,
                $roleService
            );
        });
    }
}
