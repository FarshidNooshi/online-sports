<div class="grid gap-4 place-items-center bg-gray-800 h-16 w-full border-b border-gray-900" style="grid-template-columns: 1fr 25px 40px 25px 1fr;">
    <span class="text-right w-full">{{ $match['match_hometeam_name'] }}</span>
    <img class="" width="25" height="25" src="{{ $match['team_home_badge'] }}">
    <div class="grid grid-flow-row gap-1 justify-items-center grid-rows-1">
        @if($match['match_live'] == 1 or $match['match_status'] == 'Finished')
            <span class="">{{ $match['match_hometeam_score'] }} - {{ $match['match_awayteam_score'] }}</span>
            <span class="text-gray-500 text-sm">{{ $match['match_status'] }}</span>
        @else
            <span class="text-gray-500">{{ $match['match_time'] }}</span>
        @endif

    </div>
    <img class="" width="25" height="25" src="{{ $match['team_away_badge'] }}">
    <span class="text-left w-full">{{ $match['match_awayteam_name'] }}</span>
</div>
