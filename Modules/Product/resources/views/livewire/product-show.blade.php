<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap');

            .ps-root {
                --ink: #1a1714;
                --ink-2: #4a4540;
                --ink-3: #8a8480;
                --surface: #faf9f7;
                --surface-2: #f2f0eb;
                --surface-3: #e8e4dc;
                --gold: #b5893a;
                --gold-light: #f0deb0;
                --gold-muted: #d4a85a;
                --success-bg: #f0f7ed;
                --success-text: #2d6a1e;
                font-family: 'DM Sans', sans-serif;
                color: var(--ink);
            }

            .ps-back {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                font-weight: 500;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--ink-3);
                text-decoration: none;
                margin-bottom: 2.5rem;
                transition: color 0.2s;
            }
            .ps-back:hover { color: var(--gold); }
            .ps-back-arrow {
                display: inline-block;
                transition: transform 0.2s;
            }
            .ps-back:hover .ps-back-arrow { transform: translateX(-3px); }

            .ps-wrapper {
                background: var(--surface);
                border: 1px solid var(--surface-3);
                border-radius: 20px;
                overflow: hidden;
                display: flex;
                flex-wrap: wrap;
            }

            /* ─── LEFT: images ─────────────────── */
            .ps-gallery {
                flex: 1;
                min-width: 320px;
                background: var(--surface-2);
                padding: 2rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .ps-main-img {
                position: relative;
                border-radius: 14px;
                overflow: hidden;
                background: var(--surface-3);
                aspect-ratio: 1 / 1;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .ps-main-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
            .ps-main-img:hover img { transform: scale(1.04); }

            .ps-img-counter {
                position: absolute;
                bottom: 12px;
                right: 12px;
                background: rgba(26,23,20,0.65);
                backdrop-filter: blur(6px);
                color: #fff;
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.05em;
                padding: 4px 10px;
                border-radius: 20px;
            }

            .ps-placeholder-icon {
                font-size: 64px;
                opacity: 0.25;
            }

            .ps-thumbs {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }
            .ps-thumb {
                width: 64px;
                height: 64px;
                border-radius: 10px;
                overflow: hidden;
                cursor: pointer;
                border: 2px solid transparent;
                transition: border-color 0.2s, opacity 0.2s;
                opacity: 0.6;
            }
            .ps-thumb img { width: 100%; height: 100%; object-fit: cover; }
            .ps-thumb.active { border-color: var(--gold); opacity: 1; }
            .ps-thumb:hover { opacity: 1; }

            .ps-no-img {
                font-size: 13px;
                color: var(--ink-3);
                text-align: center;
                padding: 0.5rem 0;
            }

            /* ─── RIGHT: info ──────────────────── */
            .ps-info {
                flex: 1;
                min-width: 320px;
                padding: 2.5rem 2.5rem 2.5rem 2.5rem;
                display: flex;
                flex-direction: column;
                gap: 0;
            }

            .ps-badges {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                margin-bottom: 1.25rem;
            }
            .ps-badge {
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                padding: 4px 12px;
                border-radius: 20px;
            }
            .ps-badge-cat {
                background: var(--gold-light);
                color: #7a5a1a;
            }
            .ps-badge-sub {
                background: var(--surface-3);
                color: var(--ink-2);
            }

            .ps-title {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(1.75rem, 3vw, 2.5rem);
                font-weight: 400;
                line-height: 1.15;
                color: var(--ink);
                margin: 0 0 1.75rem;
            }

            .ps-divider {
                height: 1px;
                background: var(--surface-3);
                margin: 0 0 1.75rem;
            }

            .ps-price-label {
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--ink-3);
                margin-bottom: 4px;
            }
            .ps-price {
                display: flex;
                align-items: baseline;
                gap: 6px;
                margin-bottom: 1.75rem;
            }
            .ps-price-value {
                font-family: 'DM Serif Display', serif;
                font-size: 2.25rem;
                color: var(--ink);
                line-height: 1;
            }
            .ps-price-currency {
                font-size: 13px;
                font-weight: 400;
                color: var(--ink-3);
                letter-spacing: 0.05em;
            }

            .ps-desc-label {
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--ink-3);
                margin-bottom: 8px;
            }
            .ps-desc {
                font-size: 14.5px;
                line-height: 1.75;
                color: var(--ink-2);
                margin-bottom: 2rem;
            }
            .ps-desc-empty { color: var(--ink-3); font-style: italic; }

            /* ─── Cart controls ────────────────── */
            .ps-cart-row {
                display: flex;
                align-items: center;
                gap: 14px;
                flex-wrap: wrap;
            }

            .ps-qty-group {
                display: flex;
                align-items: center;
                background: var(--surface-2);
                border: 1px solid var(--surface-3);
                border-radius: 50px;
                overflow: hidden;
                gap: 0;
            }
            .ps-qty-btn {
                background: none;
                border: none;
                cursor: pointer;
                width: 40px;
                height: 40px;
                font-size: 18px;
                font-weight: 300;
                color: var(--ink-2);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.15s, color 0.15s;
                flex-shrink: 0;
            }
            .ps-qty-btn:hover { background: var(--surface-3); color: var(--ink); }
            .ps-qty-display {
                min-width: 36px;
                text-align: center;
                font-size: 15px;
                font-weight: 500;
                color: var(--ink);
                user-select: none;
            }

            .ps-add-btn {
                flex: 1;
                min-width: 160px;
                background: var(--ink);
                color: #fff;
                border: none;
                border-radius: 50px;
                padding: 0 28px;
                height: 48px;
                font-family: 'DM Sans', sans-serif;
                font-size: 14px;
                font-weight: 500;
                letter-spacing: 0.04em;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                transition: background 0.2s, transform 0.15s;
                position: relative;
                overflow: hidden;
            }
            .ps-add-btn::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(181,137,58,0.2) 0%, transparent 60%);
                opacity: 0;
                transition: opacity 0.2s;
            }
            .ps-add-btn:hover { background: #2e2a25; transform: translateY(-1px); }
            .ps-add-btn:hover::after { opacity: 1; }
            .ps-add-btn:active { transform: translateY(0); }

            .ps-cart-icon {
                font-size: 15px;
            }

            /* ─── Success toast ────────────────── */
            .ps-toast {
                margin-top: 1.25rem;
                padding: 0.75rem 1.125rem;
                background: var(--success-bg);
                color: var(--success-text);
                border-radius: 10px;
                font-size: 13.5px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            /* ─── Trust strip ──────────────────── */
            .ps-trust {
                display: flex;
                gap: 1.5rem;
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid var(--surface-3);
                flex-wrap: wrap;
            }
            .ps-trust-item {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 12px;
                color: var(--ink-3);
            }
            .ps-trust-icon { font-size: 14px; }
        </style>

        {{-- Back Button --}}
        <a href="{{ route('subcategories.index', $product->subCategory->category_id) }}" class="ps-root ps-back">
            <span class="ps-back-arrow">←</span>
            {{ $product->subCategory->name }}
        </a>

        <div class="ps-root ps-wrapper">

            {{-- LEFT: Images --}}
            <div class="ps-gallery">
                <div class="ps-main-img" id="mainImageArea">
                    @if($product->images->count() > 0)
                        <img id="mainImage"
                            src="{{ asset('images/' . $product->images->first()->path) }}"
                            alt="{{ $product->name }}">
                        <span class="ps-img-counter">
                            <span id="imgCounter">1</span> / {{ $product->images->count() }}
                        </span>
                    @else
                        <span class="ps-placeholder-icon">📦</span>
                    @endif
                </div>

                @if($product->images->count() > 1)
                    <div class="ps-thumbs">
                        @foreach($product->images as $index => $image)
                            <div class="ps-thumb {{ $index === 0 ? 'active' : '' }}"
                                onclick="switchImage(this, '{{ asset('images/' . $image->path) }}', {{ $index + 1 }})">
                                <img src="{{ asset('images/' . $image->path) }}" alt="View {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                @elseif($product->images->count() === 0)
                    <p class="ps-no-img">No images available for this product.</p>
                @endif
            </div>

            {{-- RIGHT: Info --}}
            <div class="ps-info">

                {{-- Badges --}}
                <div class="ps-badges">
                    @if($product->subCategory?->category)
                        <span class="ps-badge ps-badge-cat">{{ $product->subCategory->category->name }}</span>
                    @endif
                    @if($product->subCategory)
                        <span class="ps-badge ps-badge-sub">{{ $product->subCategory->name }}</span>
                    @endif
                </div>

                {{-- Title --}}
                <h1 class="ps-title">{{ $product->name }}</h1>

                <div class="ps-divider"></div>

                {{-- Price --}}
                <p class="ps-price-label">Price</p>
                <div class="ps-price">
                    <span class="ps-price-value">${{ number_format($product->price, 2) }}</span>
                    <span class="ps-price-currency">USD</span>
                </div>

                {{-- Description --}}
                <p class="ps-desc-label">Description</p>
                <div class="ps-desc">
                    @if($product->description)
                        {{ $product->description }}
                    @else
                        <span class="ps-desc-empty">No description available.</span>
                    @endif
                </div>

                {{-- Add to Cart --}}
                <div class="ps-cart-row">
                    <div class="ps-qty-group">
                        <button type="button" class="ps-qty-btn" wire:click="decreaseQuantity">−</button>
                        <span class="ps-qty-display">{{ $quantity }}</span>
                        <button type="button" class="ps-qty-btn" wire:click="increaseQuantity">+</button>
                    </div>
                    <button type="button" wire:click="addToCart" class="ps-add-btn">
                        <span class="ps-cart-icon">🛒</span>
                        Add to Cart
                    </button>
                </div>

                {{-- Success Toast --}}
                <div x-data="{ show: false }"
                    x-on:item-added.window="show = true; setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="ps-toast">
                    ✅ Item added to your cart!
                </div>

            </div>
        </div>

    </div>

    <script>
        function switchImage(thumbEl, src, index) {
            const mainImg = document.getElementById('mainImage');
            if (mainImg) {
                mainImg.style.opacity = '0.6';
                mainImg.style.transition = 'opacity 0.15s';
                setTimeout(() => {
                    mainImg.src = src;
                    mainImg.style.opacity = '1';
                }, 150);
            }
            const counter = document.getElementById('imgCounter');
            if (counter) counter.textContent = index;
            document.querySelectorAll('.ps-thumb').forEach(t => t.classList.remove('active'));
            thumbEl.classList.add('active');
        }
    </script>
</div>