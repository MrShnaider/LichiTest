<?php

namespace Tests\Feature;

use App\Answers\Feat3\TestManager;
use App\Models\Test;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TestModelTest extends TestCase
{
    use DatabaseTransactions;

    private $attr = [
        'script_name' => 'testScript',
        'start_time' => 0,
        'end_time' => 0,
    ];

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('tests')->delete();
    }

    private function whenThereAreScriptsWith(array $results)
    {
        foreach ($results as $result) {
            Test::create([...$this->attr, 'result' => $result]);
        }
    }

    public function testGet()
    {
        $this->whenThereAreScriptsWith(
            ['normal', 'illegal', 'failed', 'success']
        );
        $result = (new TestManager())->get();
        $this->assertEquals(2, $result->count());
    }

    public function testGetMore()
    {
        $this->whenThereAreScriptsWith(
            ['normal', 'normal', 'illegal', 'failed', 'success', 'success']
        );
        $result = (new TestManager())->get();
        $this->assertEquals(4, $result->count());
    }
}
