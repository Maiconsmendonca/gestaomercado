<?php

namespace App\Controller;

use App\Service\StatisticsService;
use Exception;

/**
 *
 */
class StatisticController {
    /**
     * @var StatisticsService
     */
    protected StatisticsService $statisticsService;

    /**
     * @param StatisticsService $statisticsService
     */
    public function __construct(StatisticsService $statisticsService) {
        $this->statisticsService = $statisticsService;
    }

    /**
     * @return void
     */
    public function index() {
        try {
            $statistics = $this->statisticsService->getStatistics();
            echo '<pre>';
            print_r($statistics); // Exiba as estatísticas para depuração
            echo '</pre>';
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
}
