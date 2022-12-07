<?php


namespace App\Answers\Feat2;


class SequenceFilter
{
    public static function getAnswer(): int
    {
        return (new SequenceFilter())->getSumForLimit(10000);
    }

    private $sum;

    public function getSumForLimit(int $limit): int
    {
        $this->sum = 0;
        for ($i = 1; $i <= $limit; $i++) {
            $this->addToSumIfNoSequence($i);
        }
        return $this->sum;
    }

    private function addToSumIfNoSequence(int $i)
    {
        if ($this->numberHasNoSequence($i)) $this->sum += $i;
    }

    private function numberHasNoSequence(int $i): bool
    {
        $numbers = array_map('intval', str_split($i));
        for ($pos = 0; $pos <= count($numbers) - 3; $pos++) {
            $sub = array_slice($numbers, $pos, 3);
            if ($sub[0] < $sub[1] && $sub[1] < $sub[2]) return false;
            // Если число 3 изменится - заменить на цикл
        }

        return true;
    }
}
