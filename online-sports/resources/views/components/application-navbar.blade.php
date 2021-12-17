@if (Route::has('login'))
    <div class="w-full flex justify-between fixed top-0 right-0 px-6 py-4">
        <div><a href="{{ url('/') }}"><x-application-logo class="block h-10 w-auto fill-current text-gray-100" /></a></div>
        <div class="align-right">
            <a href="{{ url('/top-ten') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">top ten</a>
            <a href="{{ url('/teams') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">teams</a>
    
            @auth
                <a href="{{ url('/dashboard') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    </div>
@endif