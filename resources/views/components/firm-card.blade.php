<div class="col-lg-4 col-md-6 mb-4">
    <div class="firm-card">
        <div class="firm-image">
            <img src="{{ asset('images/' . $firm['image']) }}" alt="{{ $firm['name'] }}">
        </div>
        <div class="firm-info">
            <h5 class="firm-name">{{ $firm['name'] }}</h5>
            <p class="firm-address"><i class="fas fa-map-marker-alt"></i> {{ $firm['address'] }}</p>
            <p class="firm-desc">{{ $firm['description'] }}</p>
            @if(!empty($firm['phone']))
                <p class="firm-phone"><i class="fas fa-phone-alt"></i> {{ $firm['phone'] }}</p>
            @endif
        </div>
    </div>
</div>
