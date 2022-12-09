<?php
use App\Answers\Feat4\GroupsLinks;
/**
* @var GroupsLinks $group
*/
?>

<a href="/products?group={{ $group->id }}">
    <p>{{ $group->name }}</p>
    @if ($group->haveSubGroups())
        <ul>
            @foreach($group->groups as $curGroups)
            <li>
                @include('products', ['group' => $curGroups])
            </li>
            @endforeach
        </ul>
    @endif
</a>
