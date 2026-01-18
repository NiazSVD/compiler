<ul>
    @foreach ($languages as $lang)
        @if (is_object($lang))
            <li class="{{ request()->route('slug') == $lang->slug ? 'active' : '' }}">
                <a href="{{ route('frontend.editor', $lang->slug) }}">
                    <img src="{{ $lang->icon_show }}" alt="default">
                </a>
            </li>
        @endif
    @endforeach
</ul>
