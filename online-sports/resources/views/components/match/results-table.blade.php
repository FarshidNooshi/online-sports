@foreach ($data as $league)
    <div class="bg-gray-700">
        <div class="flex pl-5 h-11 items-center border-b border-gray-900">
            <img height="20" width="20" src="{{ $league['league_badge']  }}" alt="">
            <span class="ml-4">
                {{ $league['league_name'] }}
            </span>
        </div>
        @foreach ($league['matches'] as $match)
            @include('components.match.match-result', [
                'match' => $match,
            ])
        @endforeach
    </div>
@endforeach
