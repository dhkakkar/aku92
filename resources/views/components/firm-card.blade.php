@php $f = is_array($firm) ? (object)$firm : $firm; @endphp
<div class="col-lg-4 col-md-6 mb-4">
    <div class="firm-card">
        @if(!empty($f->image))
        <div class="firm-image">
            <img src="{{ str_starts_with($f->image, 'http') ? $f->image : asset('images/' . $f->image) }}" alt="{{ $f->name }}">
        </div>
        @endif
        <div class="firm-info">
            <h5 class="firm-name">{{ $f->name }}</h5>
            @if(!empty($f->address))
            <p class="firm-address"><i class="fas fa-map-marker-alt"></i> {{ $f->address }}</p>
            @endif
            @if(!empty($f->description))
            <p class="firm-desc">{{ $f->description }}</p>
            @endif
            @if(!empty($f->phone))
            <p class="firm-phone"><i class="fas fa-phone-alt"></i> {{ $f->phone }}</p>
            @endif
        </div>
    </div>
</div>
