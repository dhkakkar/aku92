@php $t = is_array($testimonial) ? (object)$testimonial : $testimonial; @endphp
<div class="swiper-slide">
    <div class="testimonial-card">
        <div class="testimonial-stars">
            @for($i = 0; $i < ($t->rating ?? 5); $i++) <i class="fas fa-star"></i> @endfor
            @for($i = ($t->rating ?? 5); $i < 5; $i++) <i class="far fa-star"></i> @endfor
        </div>
        <p class="testimonial-text">"{{ $t->text }}"</p>
        <div class="testimonial-author">
            <div class="author-avatar"><i class="fas fa-user-circle"></i></div>
            <div>
                <h6 class="author-name">{{ $t->name }}</h6>
                <span class="author-role">{{ $t->role ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
