<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-center items-center">
                        <h1 class="text-xl mb-3 font-bold pb-1 border-b border-gray-900">My Favorite Teams</h1>
                    </div>
                    @foreach($teams as $team)
                        <a href="{{ route('team.profile', $team->team_key) }}">
                            <div
                                class="flex p-5 items-center bg-gray-50 h-16 w-full border-b border-gray-900 hover:bg-gray-100 transition overflow-hidden">
                                <span style="font-size: 2rem;" class="text-2xl mr-5">{{ $loop->index + 1 }}</span>
                                <img class="mr-3 justify-self-start" width="40" height="40" src="{{ $team->team_badge }}">
                                <span class=" text-lg font-bold">{{ $team->team_name }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
