<div class="flex text-white gap-2" style="flex-wrap:wrap">
    @foreach($wins as $item)
    <div class="@if($item->exp_multiplier <= 1.9) bg-red-600 @elseif($item->exp_multiplier > 10) bg-green-600 @else bg-purple-600 @endif rounded-md" style="padding: 1.5% 3% 1.5% 3%">
        <small class="text-sm">
        @if($item->exp_multiplier == 1)
            {{ '1.00' }}
        @else
            {{ $item->exp_multiplier }}
        @endif
        </small>
    </div>
    @endforeach
</div>