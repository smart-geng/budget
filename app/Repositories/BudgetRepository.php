<?php

namespace App\Repositories;

use App\Models\Budget;
use App\Models\Spending;
use Exception;

class BudgetRepository
{
    public function getById(int $id): ?Budget
    {
        return Budget::find($id);
    }

    public function getSpentById(int $id): int
    {
        $budget = $this->getById($id);

        if (!$budget) {
            throw new Exception('Could not find budget (where ID is ' . $id . ')');
        }

        if ($budget->period === 'monthly') {
            return Spending::where('space_id', session('space')->id)
                ->where('tag_id', $budget->tag->id)
                ->whereRaw('MONTH(happened_on) = ?', [date('n')])
                ->whereRaw('YEAR(happened_on) = ?', [date('Y')])
                ->sum('amount');
        }

        throw new Exception('No clue what to do with period "' . $budget->period . '"');
    }
}