<?php

namespace App\Interface;

interface UmkmInterface {

    public function getToken();
    public function getData(int $limit, int $page, int $block);

    public function getById(int $id);

    public function getFullDetail(int $id);

    public function getKeuangan();

    public function mapToDatabase(array $allData);
}
