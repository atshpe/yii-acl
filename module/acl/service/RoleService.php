<?php

namespace acl\service;

use acl\model\Role;

class RoleService
{
    public function hasDynamic($value)
    {
        // get role from source
        // return false;
    }

    public function hasStatic($value)
    {
        return in_array(
            $value,
            (new \ReflectionClass(new Role()))->getConstants()
        );
    }
}
