<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        Kategorie przepisów
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        @foreach($categories as $category)
            <a class="dropdown-item" href="#">{{$category->name}}</a>
        @endforeach
    </div>
</li>
