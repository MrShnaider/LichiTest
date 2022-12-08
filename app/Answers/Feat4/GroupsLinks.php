<?php


namespace App\Answers\Feat4;


use App\Models\Group;
use Illuminate\Support\Collection;

class GroupsLinks
{
    public int $id;
    public string $name = 'Продукты';
    /**
     * @var Collection<GroupsLinks>
     */
    public Collection $groups;

    private function __construct(int $groupId, array $idSequence)
    {
        $this->id = $groupId;
        $this->name = $groupId === 0
            ? 'Продукты'
            : Group::findOrFail($groupId)->name;
        if (!in_array($groupId, $idSequence)) {
            $this->groups = collect([]);
        } else {
            $groups = Group::where('id_parent', $groupId)->get();
            $this->groups = $groups->map(fn (Group $g) => new GroupsLinks($g->getKey(), $idSequence));
        }
    }

    public static function generateGroupsLinks(int $groupId): GroupsLinks
    {
        $idSequence = self::generateIdSequence($groupId);
        return new self(0, $idSequence);
    }

    public static function generateIdSequence($groupId): array
    {
        $reversed = static::generateReversedIdSequence($groupId);

        return array_reverse($reversed);
    }

    private static function generateReversedIdSequence($groupId): array
    {
        if ($groupId === 0) return [0];

        $sequence = [];
        $currentId = $groupId;
        do {
            $group = Group::findOrFail($currentId);
            $sequence []= $group->id;
            $currentId = $group->id_parent;
        } while ($currentId !== 0);
        $sequence []= 0;

        return $sequence;
    }
}
