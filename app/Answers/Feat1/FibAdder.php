<?php


namespace App\Answers\Feat1;


use Illuminate\Support\Collection;

class FibAdder
{
    public static function getAnswer(): int
    {
        return (new FibAdder())->getFibSumForMatrix(
            [
                [399, 9160, 144, 3230, 407, 8875, 1597, 9835],
                [2093, 3279, 21, 9038, 918, 9238, 2592, 7467],
                [3531, 1597, 3225, 153, 9970, 2937, 8, 807],
                [7010, 662, 6005, 4181, 3, 4606, 5, 3980],
                [6367, 2098, 89, 13, 337, 9196, 9950, 5424],
                [7204, 9393, 7149, 8, 89, 6765, 8579, 55],
                [1597, 4360, 8625, 34, 4409, 8034, 2584, 2],
                [920, 3172, 2400, 2326, 3413, 4756, 6453, 8],
                [4914, 21, 4923, 4012, 7960, 2254, 4448, 1]
            ]
        );
    }

    private int $limit;
    private Collection $matrix;
    private Collection $fibs;

    public function getFibSumForMatrix(array $matrix): int
    {
        if (count($matrix) < 1) return 0;
        $this->init($matrix);
        $this->findLimitForFibs();
        $this->generateFibsBeforeLimit();
        return $this->sumAllFibsInMatrix();
    }

    private function init(array $matrix)
    {
        $this->matrix = collect($matrix);
    }

    private function findLimitForFibs(): void
    {
        $this->limit = 1;
        foreach ($this->matrix as $row) {
            foreach ($row as $value) {
                if ($value > $this->limit) $this->limit = $value;
            }
        }
    }

    private function generateFibsBeforeLimit()
    {
        $this->fibs = collect([1, 1]);
        $currentFib = 1;
        while ($currentFib < $this->limit) {
            $currentFib = $this->fibs->slice(-2)->sum();
            $this->fibs->add($currentFib);
        }
    }

    private function sumAllFibsInMatrix()
    {
        return $this->matrix
            ->flatten()
            ->filter(fn ($item) => $this->fibs->contains($item))
            ->sum();
    }
}
