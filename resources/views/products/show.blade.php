<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            --price-gradient: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
        }

        .product-wrapper {
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .main-image-area {
            background: var(--primary-gradient);
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .main-image-area::after {
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

        .main-image-area img {
            max-height: 360px;
            max-width: 100%;
            object-fit: contain;
            z-index: 1;
            border-radius: 8px;
        }

        .main-image-placeholder {
            z-index: 1;
            color: rgba(255,255,255,0.85);
            font-size: 6rem;
        }

        .thumb-strip {
            display: flex;
            gap: 10px;
            padding: 1rem 1.5rem;
            overflow-x: auto;
            background: #f8f9fa;
            border-top: 1px solid #eee;
        }

        .thumb-strip::-webkit-scrollbar { height: 4px; }
        .thumb-strip::-webkit-scrollbar-thumb { background: #c0c0c0; border-radius: 4px; }

        .thumb {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.25s ease;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .thumb img { width: 100%; height: 100%; object-fit: cover; }

        .thumb.active,
        .thumb:hover {
            border-color: #667eea;
            box-shadow: 0 3px 10px rgba(102, 126, 234, 0.35);
            transform: translateY(-3px);
        }

        .img-count-badge {
            position: absolute;
            bottom: 15px; right: 15px;
            background: rgba(0,0,0,0.45);
            color: white;
            padding: 0.3rem 0.9rem;
            border-radius: 20px;
            font-size: 0.8rem;
            z-index: 2;
            backdrop-filter: blur(4px);
        }

        .no-image-strip {
            padding: 0.8rem 1.5rem;
            background: #f8f9fa;
            color: #aaa;
            font-size: 0.85rem;
            border-top: 1px solid #eee;
        }

        .info-panel { padding: 2rem; }

        .product-title {
            font-size: 1.9rem;
            font-weight: 700;
            color: #333;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .category-badge {
            display: inline-block;
            background: var(--secondary-gradient);
            color: white;
            padding: 0.35rem 1.2rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            margin-right: 0.5rem;
            box-shadow: 0 3px 10px rgba(240,147,251,0.3);
        }

        .subcategory-badge {
            display: inline-block;
            background: var(--success-gradient);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 25px;
            font-weight: 500;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 3px 10px rgba(132,250,176,0.3);
        }

        .price-container {
            background: #f8f9fa;
            padding: 1.2rem 1.5rem;
            border-radius: 12px;
            margin: 1.5rem 0;
        }

        .price-label {
            font-size: 0.8rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .price-value {
            font-size: 2rem;
            font-weight: 700;
            background: var(--price-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .price-value small {
            font-size: 1rem;
            font-weight: 400;
            background: none;
            -webkit-text-fill-color: #888;
        }

        .description-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.5rem;
            color: #555;
            line-height: 1.7;
            font-size: 0.97rem;
        }

        .description-box h6 {
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .btn-add-to-cart {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.85rem 2rem;
            border: none;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102,126,234,0.3);
        }

        .btn-add-to-cart:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.45);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.75rem 1.5rem;
            border: 2px solid #667eea;
            border-radius: 30px;
            background: white;
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .back-button:hover {
            background: #667eea;
            color: white;
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .product-title { font-size: 1.5rem; }
            .main-image-area { min-height: 250px; }
            .main-image-placeholder { font-size: 4rem; }
            .info-panel { padding: 1.5rem; }
        }
    </style>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

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

                            {{-- Badges --}}
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

                            {{-- Price --}}
                            <div class="price-container">
                                <div class="price-label">Price</div>
                                <div class="price-value">
                                    ${{ number_format($product->price, 2) }}
                                    <small>USD</small>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="description-box">
                                <h6>ℹ️ Description</h6>
                                @if($product->description)
                                    {{ $product->description }}
                                @else
                                    <span style="color:#aaa;">No description available.</span>
                                @endif
                            </div>

                            {{-- Add to Cart --}}
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                                    <input type="number" name="quantity" value="1" min="1"
                                           style="width:70px; padding:0.6rem; border:2px solid #e0e0e0; border-radius:10px; text-align:center; font-size:1rem;">
                                    <button type="submit" class="btn-add-to-cart">
                                        🛒 Add to Cart
                                    </button>
                                </div>
                            </form>

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

</x-app-layout>