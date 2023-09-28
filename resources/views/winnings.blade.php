<div>
    <div class="text-white">
        @foreach($winnings as $item)
        <div class="p-3 md:flex items-center justify-around mb-3 rounded-md" style="background:rgba(0,255,0,0.2)">
            <div>
                <span class="text-sm block">Multiplier</span>
                <strong>{{ $item->multiplier }}</strong>
            </div>
            <div>
                <span class="text-sm block">Stake</span>
                <strong>{{ $item->stake }}</strong>
            </div>
            <div>
                <span class="text-sm block">Amount</span>
                <strong>{{ $item->amount }}</strong>
            </div>
        </div>
        @endforeach
    </div>
</div>