<?php
use App\Answers\Feat4\GroupsLinks;
/**
* @var GroupsLinks $groups
*/
?>

<a href="/products?group={{ $groups->id }}">
    <p>{{ $groups->name }}</p>
    @if ($groups->groups->count() > 0)
        <ul>
            @foreach($groups->groups as $groups)
            <li>
                @include('products', ['groups' => $groups])
            </li>
            @endforeach
        </ul>
    @endif
</a>
