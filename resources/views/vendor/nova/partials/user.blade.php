<dropdown-trigger class="h-9 flex items-center">
    @isset($user->email)
        <span class="text-50 mr-3">
            @include('nova-notifications::dropdown')
        </span>
    @endisset

    <span class="text-90">
        {{ $user->name ?? $user->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
        <li>
            <nova-dark-theme-toggle
                label="{{ __('Dark Theme') }}"
            ></nova-dark-theme-toggle>
        </li>
    </ul>
</dropdown-menu>
