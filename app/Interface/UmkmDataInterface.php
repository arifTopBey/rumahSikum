<?php

namespace App\Interface;

interface UmkmDataInterface {

    public function getAll(?string $search, ?int $limit, bool $execute);
    public function getAllPaginate(?string $search, ?int $rowPerPage);
    
}
