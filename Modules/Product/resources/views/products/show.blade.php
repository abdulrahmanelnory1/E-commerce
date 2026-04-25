<div class="py-8">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

    <style>
        {{-- same CSS as before --}}
    </style>

        {{-- Back Button --}}
        <a href="{{ route('subcategories.index', $product->subCategory->category_id) }}" class="back-button">
            ← Back to {{ $product->subCategory->name }}
        </a>

        <div class="product-wrapper">
            <div style="display:flex; flex-wrap:wrap;">

                {{-- LEFT: Images --}}
                <div style="flex: 1; min-width: 300px;">
                    <div class="main-image-area" id="mainImageArea">
                        @if($product->images->count() > 0)
                            <img id="mainImage"
                                 src="{{ asset('images/' . $product->images->first()->path) }}"
                                 alt="{{ $product->name }}">
                            <span class="img-count-badge">
                                🖼️ <span id="imgCounter">1</span> / {{ $product->images->count() }}
                            </span>
                        @else
                            <span class="main-image-placeholder">📦</span>
                        @endif
                    </div>

                    {{-- Thumbnails --}}
                    @if($product->images->count() > 1)
                        <div class="thumb-strip">
                            @foreach($product->images as $index => $image)
                                <div class="thumb {{ $index === 0 ? 'active' : '' }}"
                                     onclick="switchImage(this, '{{ asset('images/' . $image->path) }}', {{ $index + 1 }})">
                                    <img src="{{ asset('images/' . $image->path) }}"
                                         alt="Thumbnail {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    @elseif($product->images->count() === 0)
                        <div class="no-image-strip">🖼️ No images available for this product.</div>
                    @endif
                </div>

                {{-- RIGHT: Info --}}
                <div style="flex: 1; min-width: 300px;">
                    <div class="info-panel">

                        @if($product->subCategory?->category)
                            <span class="category-badge">
                                🏷️ {{ $product->subCategory->category->name }}
                            </span>
                        @endif
                        @if($product->subCategory)
                            <span class="subcategory-badge">
                                🔖 {{ $product->subCategory->name }}
                            </span>
                        @endif

                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="price-container">
                            <div class="price-label">Price</div>
                            <div class="price-value">
                                ${{ number_format($product->price, 2) }}
                                <small>USD</small>
                            </div>
                        </div>

                        <div class="description-box">
                            <h6>ℹ️ Description</h6>
                            @if($product->description)
                                {{ $product->description }}
                            @else
                                <span style="color:#aaa;">No description available.</span>
                            @endif
                        </div>

                        {{-- Add to Cart — Livewire --}}
                        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                            <button class="quantity-btn" wire:click="decreaseQuantity">−</button>
                            <span class="quantity-display">{{ $quantity }}</span>
                            <button class="quantity-btn" wire:click="increaseQuantity">+</button>
                            <button wire:click="addToCart" class="btn-add-to-cart">
                                🛒 Add to Cart
                            </button>
                        </div>

                        {{-- Success message --}}
                        <div x-data="{ show: false }"
                             x-on:item-added.window="show = true; setTimeout(() => show = false, 3000)"
                             x-show="show"
                             x-transition
                             style="margin-top:1rem; padding:0.75rem 1rem; background:#d4edda; color:#155724; border-radius:10px; font-weight:500;">
                            ✅ Item added to cart!
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        function switchImage(thumbEl, src, index) {
            const mainImg = document.getElementById('mainImage');
            if (mainImg) mainImg.src = src;
            document.getElementById('imgCounter').textContent = index;
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumbEl.classList.add('active');
        }
    </script>
</div>z