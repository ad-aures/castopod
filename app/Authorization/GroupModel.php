<?php

declare(strict_types=1);

namespace App\Authorization;

use Myth\Auth\Authorization\GroupModel as MythAuthGroupModel;

class GroupModel extends MythAuthGroupModel
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
