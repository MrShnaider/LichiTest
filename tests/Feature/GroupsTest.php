<?php

namespace Tests\Feature;

use App\Answers\Feat4\GroupsLinks;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GroupsTest extends TestCase
{
    use DatabaseTransactions;

    // Перед тестами заполните базу!
    public function test1(): void
    {
        $s = GroupsLinks::generateIdSequence(0);
        $this->assertEquals([0], $s);
        $s = GroupsLinks::generateIdSequence(1);
        $this->assertEquals([0, 1], $s);
        $s = GroupsLinks::generateIdSequence(4);
        $this->assertEquals([0, 1, 4], $s);
        $s = GroupsLinks::generateIdSequence(6);
        $this->assertEquals([0, 1, 3, 6], $s);
    }

    public function test0()
    {
        $groups = GroupsLinks::generateGroupsLinks(0);
        $this->assertEquals('Продукты', $groups->name);
        $this->assertEquals(2, $groups->groups->flatten()->count());

        GroupsLinks::generateGroupsLinks(1);
        GroupsLinks::generateGroupsLinks(3);
        GroupsLinks::generateGroupsLinks(6);
    }
}
