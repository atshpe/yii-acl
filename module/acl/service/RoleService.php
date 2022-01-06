<?php

namespace acl\service;

use acl\model\Role;

class RoleService
{
    public function hasDynamic($value)
    {
        $db = \Yii::$app->db;

        $sql = "SELECT id from acl_rule_roles WHERE role='{$value}'";
        $res = $db->createCommand($sql)->queryOne();

        return $res ? true : false;
    }

    public function hasStatic($value)
    {
        return in_array(
            $value,
            (new \ReflectionClass(new Role()))->getConstants()
        );
    }

    public function has($value)
    {
        return ($this->hasStatic($value) || $this->hasDynamic($value));
    }

    public function getType($value)
    {
        if ($this->hasStatic($value)) return 'static';
        if ($this->hasDynamic($value)) return 'dynamic';
    }

    /* config should look like this */
    
    // $cfg = [
    //     'controller' => $this->controller,
    //     'actions' => [
    //         'index',
    //         'about',
    //     ],
    //     'roles' => [
    //         'DynamicUser',
    //     ],
    //     'assertions' => [],
    // ];
    
    public function setDynamic(array $config) : void
    {
        if ($this->validateConfig($config)) {
            $db = \Yii::$app->db;
            $controller = addslashes($config['controller']);

            $sql = "INSERT INTO acl_rule (controller) VALUES ('{$controller}');";
            $res = $db->createCommand($sql)->execute();
            $id = $db->getLastInsertID();
            
            $sql = "INSERT INTO acl_rule_action (action,rule_id) VALUES";
            
            foreach ($config['actions'] as $action) {
                $sql .= "('{$action}',{$id}),";
            }
            
            $sql = rtrim($sql, ',') . ';';
            $db->createCommand($sql)->execute();
            
            $sql = "INSERT INTO acl_rule_roles (role,rule_id) VALUES";
            
            foreach ($config['roles'] as $role) {
                $sql .= "('{$role}', {$id}),";
            }
            
            $sql = rtrim($sql, ',') . ';';
            $db->createCommand($sql)->execute();

            // if (isset($config['assertions'])) {
            //     insert into assertions table..
            // }
        }
    }

    public function removeDynamic($role) : void
    {
        // if has dynamic
        $sql = "DELETE FROM acl_rule WHERE id IN(
            SELECT id FROM acl_rule_roles WHERE role='{$role}'
        )";

        \Yii::$app->db->createCommand($sql)->execute();
    }

    public function addPermission()
    {

    }
    
    public function removePermission()
    {

    }
    
    public function validateConfig(array $config)
    {
        foreach ($config['roles'] as $role) {
            if ($this->has($role)) {
                throw new \Exception("Role with name '{$role}' already exists.");
            }
        }
        // if controller or action not exist, return false

        return true;
    }
}
