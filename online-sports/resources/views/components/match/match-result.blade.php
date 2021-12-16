@if($show_time == true)
    <div class="grid gap-4 place-items-center bg-gray-800 h-20 w-full border-b border-gray-900 hover:bg-gray-700 transition" style="grid-template-columns: 1fr 25px 80px 25px 1fr; ">
@else
    <div class="grid gap-4 place-items-center bg-gray-800 h-16 w-full border-b border-gray-900 hover:bg-gray-700 transition" style="grid-template-columns: 1fr 25px 60px 25px 1fr; ">
@endif
    <span class="text-right w-full text-sm">{{ $match['match_hometeam_name'] }}</span>
    <img class="" width="25" height="25" src="{{ $match['team_home_badge'] }}">
    <div class="grid grid-flow-row gap-1 justify-items-center grid-rows-1">
        @if($match['match_live'] == 1 or $match['match_status'] == 'Finished')
            <span class="">{{ $match['match_hometeam_score'] }} - {{ $match['match_awayteam_score'] }}</span>
            <span class="text-xs text-green-600">{{ $match['match_status'] }}</span>
        @else
            <span class="text-gray-500">
                <?php
                echo date("H:i", strtotime('+150 minutes', strtotime($match['match_time'])));
                ?>
            </span>
        @endif
        @if($show_time == true)
            <span class="text-center w-full text-xs"> {{ $match['match_date'] }} </span>
        @endif

    </div>
    <img class="" width="25" height="25" src="{{ $match['team_away_badge'] }}">
    <span class="text-left w-full text-sm">{{ $match['match_awayteam_name'] }}</span>
</div>

