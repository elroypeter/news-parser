<?php

namespace App\Service;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as CustomPaginator;

class PaginatorService
{
    private $totalPages;
    private $lastPage;
    private $items;

    /**
     * @param QueryBuilder|Query $query
     * @param int $page
     * @param int $limit
     * @return PaginatorService
     */
    public function paginate($query, int $page = 1, int $limit = 10): PaginatorService
    {
        $paginator = new CustomPaginator($query);
        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $this->total = $paginator->count();
        $this->lastPage = (int) ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
        $this->items = $paginator;
        return $this;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    public function getItems()
    {
        return $this->items;
    }
}
