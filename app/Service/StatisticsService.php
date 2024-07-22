<?php

namespace App\Service;

use App\Repository\StatisticsRepository;

class StatisticsService
{
    private $statisticsRepository;

    public function __construct()
    {
        $this->statisticsRepository = new StatisticsRepository();
    }

    public function getStatistics()
    {
        return $this->statisticsRepository->getAllStatistics();
    }
}
