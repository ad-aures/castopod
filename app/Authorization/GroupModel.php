<?php

namespace App\Authorization;

class GroupModel extends \Myth\Auth\Authorization\GroupModel
{
    public function getContributorRoles()
    {
        return $this->select('auth_groups.*')
            ->like('name', 'podcast_', 'after')
            ->findAll();
    }

    public function getUserRoles()
    {
        return $this->select('auth_groups.*')
            ->notLike('name', 'podcast_', 'after')
            ->findAll();
    }
}
