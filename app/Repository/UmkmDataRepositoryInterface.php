<?php

namespace App\Repository;

use App\Interface\UmkmDataInterface;
use App\Models\IdentitasUsaha;

class UmkmDataRepositoryInterface implements UmkmDataInterface{

  public function getAll(?string $search, ?int $limit, bool $execute){

        $query = IdentitasUsaha::where(function($query) use ($search){
            if($search){
                $query->search($search);
            }
        });

        // $query->orderByDesc('created_at');

        if($limit){
            $query->take($limit);
        }

        if($execute){
          return  $query->get();
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }
    public function getAllPaginate(?string $search, ?int $rowPerPage){
        
        $query = $this->getAll($search, $rowPerPage, false);

        return  $query->paginate($rowPerPage);

    }
    
}