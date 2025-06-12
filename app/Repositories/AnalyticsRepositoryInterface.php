<?php

namespace App\Repositories;

interface AnalyticsRepositoryInterface
{
    public function getSalesSummary(): array;
    public function getTopPizzas(int $limit = 5): array;
    public function getSalesByDate(string $from, string $to): array;
    public function getRecentSales(int $limit = 10): array;
    public function getSalesByMonth(string $year): array;
}
