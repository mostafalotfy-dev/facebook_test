<li class="nav-item">
    <a href="{{ route('admins.index') }}"
       class="nav-link {{ Request::is('admins*') ? 'active' : '' }}">
        <p>@lang('models/admins.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('recipes.index') }}"
       class="nav-link {{ Request::is('recipes*') ? 'active' : '' }}">
        <p>@lang('models/recipes.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <p>@lang('models/categories.plural')</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('recipes.index') }}"
       class="nav-link {{ Request::is('recipes*') ? 'active' : '' }}">
        <p>@lang('models/recipes.plural')</p>
    </a>
</li>

