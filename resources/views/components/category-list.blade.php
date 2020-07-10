<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        Przepisy
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('recipes.index')}}">Wszystkie</a>
        @if($categories->count() > 0)
            <div class="dropdown-divider"></div>
        @endif
        @foreach($categories as $category)
            <a class="dropdown-item"
               href="{{route('recipes.index', ['category' => $category->id])}}">{{$category->name}}</a>
        @endforeach
    </div>
</li>
