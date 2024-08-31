<?php

namespace App\Repository\Traits;


trait PaginateTrait
{
    public function paginate($alias, int $page, int $itemsPerPage): array
    {
        return $this->createQueryBuilder($alias)
            ->orderBy($alias . '.createdAt', 'DESC')
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->execute();
    }
}