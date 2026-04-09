<div class="swiper-slide">
    <div class="testimonial-card">
        <div class="testimonial-stars">
            @for($i = 0; $i < $testimonial['rating']; $i++) <i class="fas fa-star"></i> @endfor
            @for($i = $testimonial['rating']; $i < 5; $i++) <i class="far fa-star"></i> @endfor
        </div>
        <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
        <div class="testimonial-author">
            <div class="author-avatar"><i class="fas fa-user-circle"></i></div>
            <div>
                <h6 class="author-name">{{ $testimonial['name'] }}</h6>
                <span class="author-role">{{ $testimonial['role'] }}</span>
            </div>
        </div>
    </div>
</div>
