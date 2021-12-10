@foreach ($teams as $team)
    <div class="bg-gray-700">
        <div class="grid gap-4 place-items-center bg-gray-800 h-16 w-full border-b border-gray-900 hover:bg-gray-700 transition" style="grid-template-columns: 1fr 25px 60px 25px 1fr;">
            <span class="text-right w-full text-sm">{{ $team['team_name'] }}</span>
            <img class="" width="25" height="25" src="{{ $team['team_badge'] }}">
        </div>
    </div>
@endforeach
