<?php

namespace acl\service;

use acl\model\Role;

class Gate
{
    private
        $identity,
        $request,
        $config,
        $controller,
        $action,
        $roleService;
    
    public function __construct($identity, $config, $roleService)
    {
        $this->identity     = $identity;
        $this->request      = \Yii::$app->getRequest();
        $this->controller   = \Yii::$app->controller::className();
        $this->action       = \Yii::$app->controller->action->id;
        $this->config       = $config;
        $this->roleService  = $roleService;
    }

    public function run()
    {
        $role = 'Guest';
        $lock = true;
        
        if ($this->identity) $role = $this->identity->role;
        if (! $this->isRouteMatch()) throw new \Exception(404);

        $resource = $this->getResource();
        if ($resource) {
            if ($this->isAllowed($role, $resource)) {
                $lock = false;
            }
        }

        if ($lock) {
            echo 'Restricted';die;
        }
    }

    private function isRouteMatch()
    {
        if (class_exists($this->controller)) {
            $action = 'action' . ucfirst($this->action);
            if (method_exists($this->controller, $action)) {
                return true;
            }
        }
        return false;
    }

    private function getResource()
    {
        $resource = null;
        $config = $this->config['base'];

        foreach ($config as $item) {
            if (
                $item['controller'] == $this->controller
                &&
                in_array($this->action, $item['resources'])
            ) {
                $resource = $item;
            }
        }

        return $resource;
    }

    private function isAllowed($role, $resource)
    {
        if (! $this->roleService->has($role)) {
            throw new \Exception("No such role - $role");
        }
        
        $type = $this->roleService->getType($role);
        switch ($type) {
            case 'static':
                if (
                    in_array($role, $resource['roles'])
                    OR
                    in_array('*', $resource['roles'])
                ) {
                    return true;
                }
            break;
            case 'dynamic':
                $controller = addslashes($this->controller);
                $sql = "SELECT acl_rule_action.action
                    FROM acl_rule
                    INNER JOIN acl_rule_roles
                        ON acl_rule.id = acl_rule_roles.rule_id
                    INNER JOIN acl_rule_action
                        ON acl_rule.id = acl_rule_action.rule_id
                    WHERE acl_rule.controller = '{$controller}'
                    AND acl_rule_roles.role = '{$role}'
                    HAVING acl_rule_action.action = '{$this->action}'
                ";
                
                $res = \Yii::$app->db->createCommand($sql)->queryOne();
                return $res ? true : false;
            break;
        }
        return false;
    }
}
