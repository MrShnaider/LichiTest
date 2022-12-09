<?php

namespace App\Answers\Feat4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $groupId = $request->input('group') ?? 0;
        $group = GroupsLinks::generateGroupsLinks($groupId);
        return view('products', ['group' => $group]);
    }
}
