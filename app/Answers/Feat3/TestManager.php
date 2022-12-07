<?php

namespace App\Answers\Feat3;

use App\Models\Test;
use Illuminate\Database\Eloquent\Collection;

class TestManager
{
    // я не могу тестировать приватный метод, напрямую всё проходит
    private function fill()
    {
        Test::factory(10)->create();
    }

    public function get(): Collection
    {
        return Test::where('result', 'normal')
            ->orWhere('result', 'success')
            ->get();
    }
}
