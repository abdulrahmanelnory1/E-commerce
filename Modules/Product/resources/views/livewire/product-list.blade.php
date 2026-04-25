<div>
    <div class="page-header">
        <h1>📦 {{ $subCategory->name }} Products</h1>
        <p style="color:#666; margin-top:0.4rem; margin-bottom:0.75rem; font-size:0.9rem;">
            Browse all products in this subcategory
        </p>
        <input
            type="text"
            wire:model.live="search"
            placeholder="🔍 Search products..."
            style="
                width: 100%;
                max-width: 400px;
                padding: 0.5rem 1rem;
                border: 1px solid #ddd;
                border-radius: 25px;
                font-size: 0.9rem;
                outline: none;
            "
        >
    </div>

    <div wire:loading style="text-align:center; padding: 0.5rem; color: #667eea; font-size:0.85rem;">
        ⏳ Searching...
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                <div class="fade-card" style="display:flex; flex-direction:column;">
                    <div class="product-wrapper">

                        <div class="product-image-area">
                            <span class="product-badge">⭐ New</span>
                            @if($product->images->count() > 0)
                                <img id="main-img-{{ $product->id }}"
                                     src="{{ asset('images/' . $product->images->first()->path) }}"
                                     alt="{{ $product->name }}">
                                @if($product->images->count() > 1)
                                    <span class="img-count-badge">
                                        🖼️ <span id="counter-{{ $product->id }}">1</span>/{{ $product->images->count() }}
                                    </span>
                                @endif
                            @else
                                <span class="placeholder">📦</span>
                            @endif
                        </div>

                        @if($product->images->count() > 1)
                            <div class="thumb-strip">
                                @foreach($product->images as $i => $image)
                                    <div class="thumb {{ $i === 0 ? 'active' : '' }}"
                                         onclick="switchImg({{ $product->id }}, this, '{{ asset('images/' . $image->path) }}', {{ $i + 1 }})">
                                        <img src="{{ asset('images/' . $image->path) }}" alt="thumb">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="info-panel">
                            <div class="card-title">{{ $product->name }}</div>

                            <div class="price-container">
                                <div class="price-label">Price</div>
                                <div class="price-value">
                                    ${{ number_format($product->price, 2) }}
                                    <small>USD</small>
                                </div>
                            </div>

                            @if($product->description)
                                <div class="description-box">
                                    <strong>ℹ️ Description</strong>
                                    {{ Str::limit($product->description, 70) }}
                                </div>
                            @endif

                            <div style="display:flex; gap:6px; align-items:center;">
                                <button wire:click="addToCart({{ $product->id }})" class="btn-add-to-cart" style="flex:1;">
                                    🛒 Add to Cart
                                </button>
                                <a href="{{ route('products.show', $product) }}" class="btn-show">
                                    👁️ Show
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('subcategories.index', $subCategory->category_id) }}" class="back-button">
            ← Back to Subcategories
        </a>
    @else
        <div class="empty-state">
            <p>No products found in this subcategory.</p>
            <a href="{{ route('subcategories.index', $subCategory->category_id) }}" class="back-button">
                ← Back to Subcategories
            </a>
        </div>
    @endif
</div>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        --price-gradient: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
    }

    .page-header {
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        background: var(--primary-gradient);
    }

    .product-wrapper {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }
    .product-wrapper:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(102,126,234,0.18);
    }

    .product-image-area {
        background: var(--primary-gradient);
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .product-image-area::after {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: linear-gradient(to bottom right,
            rgba(255,255,255,0.1) 0%,
            rgba(255,255,255,0.3) 50%,
            rgba(255,255,255,0.1) 100%);
        transform: rotate(45deg);
        animation: shimmer 3s infinite;
    }
    @keyframes shimmer {
        0%   { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }
    .product-image-area img {
        width: 100%; height: 100%;
        object-fit: cover;
        z-index: 1;
    }
    .product-image-area .placeholder {
        font-size: 3rem;
        color: rgba(255,255,255,0.85);
        z-index: 1;
    }

    .product-badge {
        position: absolute;
        top: 10px; right: 10px;
        background: var(--secondary-gradient);
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 600;
        z-index: 3;
    }

    .img-count-badge {
        position: absolute;
        bottom: 8px; right: 8px;
        background: rgba(0,0,0,0.45);
        color: white;
        padding: 0.15rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        z-index: 2;
        backdrop-filter: blur(4px);
    }

    .thumb-strip {
        display: flex;
        gap: 6px;
        padding: 0.5rem 0.75rem;
        overflow-x: auto;
        background: #f8f9fa;
        border-top: 1px solid #eee;
    }
    .thumb-strip::-webkit-scrollbar { height: 3px; }
    .thumb-strip::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }

    .thumb {
        flex-shrink: 0;
        width: 40px; height: 40px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s ease;
        background: var(--primary-gradient);
    }
    .thumb img { width: 100%; height: 100%; object-fit: cover; }
    .thumb.active, .thumb:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(102,126,234,0.35);
    }

    .info-panel { padding: 1rem; }
    .card-title { font-size: 0.95rem; font-weight: 600; color: #333; margin-bottom: 0.5rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.4; height: 2.6rem; }
    .price-container { background: #f8f9fa; padding: 0.55rem 0.85rem; border-radius: 10px; margin-bottom: 0.65rem; }
    .price-label { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
    .price-value { font-size: 1.2rem; font-weight: 700; background: var(--price-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1.2; }
    .price-value small { font-size: 0.75rem; font-weight: 400; background: none; -webkit-text-fill-color: #888; }
    .description-box { background: #f8f9fa; border-radius: 10px; padding: 0.55rem 0.85rem; margin-bottom: 0.65rem; color: #555; font-size: 0.78rem; line-height: 1.5; }
    .description-box strong { color: #333; display: block; margin-bottom: 2px; font-size: 0.75rem; }
    .btn-add-to-cart { flex: 1; padding: 0.55rem; border: none; border-radius: 10px; background: var(--primary-gradient); color: white; font-weight: 600; font-size: 0.78rem; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; justify-content: center; gap: 4px; width: 100%; }
    .btn-add-to-cart:hover { color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102,126,234,0.4); }
    .btn-show { padding: 0.55rem 0.75rem; border-radius: 10px; background: #f8f9fa; color: #667eea; font-weight: 600; font-size: 0.78rem; text-decoration: none; border: 2px solid #667eea; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 3px; white-space: nowrap; }
    .btn-show:hover { background: #667eea; color: white; }
    .back-button { display: inline-flex; align-items: center; gap: 8px; padding: 0.75rem 1.5rem; border: 2px solid transparent; border-radius: 30px; background: white; color: #667eea; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-top: 1.5rem; margin-bottom: 1rem; }
    .back-button:hover { border-color: #667eea; background: transparent; color: #667eea; transform: translateX(-5px); }
    .empty-state { text-align: center; padding: 4rem 2rem; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
    .empty-state p { font-size: 1.2rem; color: #666; margin-bottom: 1.5rem; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .fade-card { animation: fadeInUp 0.5s ease-out forwards; }
    .fade-card:nth-child(1) { animation-delay: 0.05s; }
    .fade-card:nth-child(2) { animation-delay: 0.10s; }
    .fade-card:nth-child(3) { animation-delay: 0.15s; }
    .fade-card:nth-child(4) { animation-delay: 0.20s; }
    .fade-card:nth-child(5) { animation-delay: 0.25s; }
    .fade-card:nth-child(6) { animation-delay: 0.30s; }
    .fade-card:nth-child(7) { animation-delay: 0.35s; }
    .fade-card:nth-child(8) { animation-delay: 0.40s; }
    .fade-card:nth-child(9) { animation-delay: 0.45s; }
    .fade-card:nth-child(10) { animation-delay: 0.50s; }
    .fade-card:nth-child(11) { animation-delay: 0.55s; }
    .fade-card:nth-child(12) { animation-delay: 0.60s; }
</style>

<script>
    function switchImg(productId, thumbEl, src, index) {
        const mainImg = document.getElementById('main-img-' + productId);
        if (mainImg) mainImg.src = src;
        const counter = document.getElementById('counter-' + productId);
        if (counter) counter.textContent = index;
        const strip = thumbEl.closest('.thumb-strip');
        if (strip) {
            strip.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumbEl.classList.add('active');
        }
    }
</script>
