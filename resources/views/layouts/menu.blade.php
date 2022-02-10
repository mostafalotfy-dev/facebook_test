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

<li class="nav-item">
    <a href="{{ route('replies.index') }}"
       class="nav-link {{ Request::is('replies*') ? 'active' : '' }}">
        <p>@lang('models/replies.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('shortVideos.index') }}"
       class="nav-link {{ Request::is('shortVideos*') ? 'active' : '' }}">
        <p>@lang('models/shortVideos.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cheifs.index') }}"
       class="nav-link {{ Request::is('cheifs*') ? 'active' : '' }}">
        <p>@lang('models/cheifs.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('followings.index') }}"
       class="nav-link {{ Request::is('followings*') ? 'active' : '' }}">
        <p>@lang('models/followings.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('comics.index') }}"
       class="nav-link {{ Request::is('comics*') ? 'active' : '' }}">
        <p>@lang('models/comics.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('hashTags.index') }}"
       class="nav-link {{ Request::is('hashTags*') ? 'active' : '' }}">
        <p>@lang('models/hashTags.plural')</p>
    </a>
</li>


