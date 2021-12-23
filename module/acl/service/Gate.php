<?php

namespace acl\service;

use acl\model\Role;

class Gate
{
    private
        $identity,
        $request,
        $config,
        $roleService;
    
    public function __construct($identity, $config, $roleService)
    {
        $this->identity = $identity;
        $this->request = \Yii::$app->getRequest();
        $this->config = $config;
        $this->roleService = $roleService;
    }

    public function run()
    {
        $config = $this->config['base'];
        $controller = \Yii::$app->controller::className();
        $action = \Yii::$app->controller->action->id;
        
        $role = 'Guest';
        $lock = true;
        
        if ($this->identity) {
            $role = $this->identity->role;
            if (! $this->roleService->hasStatic($role)) {
                throw new \yii\web\ServerErrorHttpException();
            }
        }

        foreach ($config as $item) {
            if ($item['controller'] == $controller) {
                if (in_array($action, $item['resources'])) {
                    if (
                        in_array($role, $item['roles'])
                        OR
                        in_array('*', $item['roles'])
                    ) {
                        $lock = false;
                    }
                }
            }
        }

        if ($lock) {
            echo 'Restricted';die;
        }
    }
}
