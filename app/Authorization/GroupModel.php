<?php

namespace App\Authorization;

class GroupModel extends \Myth\Auth\Authorization\GroupModel
{
    /**
     * @return mixed[]
     */
    public function getContributorRoles(): array
    {
        return $this->select('auth_groups.*')
            ->like('name', 'podcast_', 'after')
            ->findAll();
    }

    /**
     * @return mixed[]
     */
    public function getUserRoles(): array
    {
        return $this->select('auth_groups.*')
            ->notLike('name', 'podcast_', 'after')
            ->findAll();
    }
}
