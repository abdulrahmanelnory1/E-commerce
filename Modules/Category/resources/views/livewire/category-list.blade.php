<div>
    <div class="page-header">
        <h1>🛍️ Shop by Category</h1>
        <p style="color:#666; margin-top:0.4rem; margin-bottom:0.75rem; font-size:0.9rem;">
            Browse our collection of categories
        </p>
        <input
            type="text"
            wire:model.live="search"
            placeholder="🔍 Search categories..."
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

    @if($categories->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <div class="fade-card">
                    <a href="{{ route('subcategories.index', $category) }}" style="text-decoration:none; color:inherit;">
                        <div class="category-card">
                            <div style="padding: 1rem 0.75rem; text-align:center;">
                                <div class="category-icon">🏷️</div>
                                <h5 style="font-size:0.85rem; font-weight:600; color:#333; margin-bottom:0.2rem; text-transform:capitalize;">
                                    {{ $category->name }}
                                </h5>
                                <p style="color:#888; font-size:0.75rem; margin:0;">View subcategories</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p style="font-size:1.2rem; color:#666;">😕 No categories found for "{{ $search }}"</p>
        </div>
    @endif
</div>

<style>
    .category-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
    }

    .category-card:hover::before {
        opacity: 1;
    }

    .category-icon {
        width: 40px;
        height: 40px;
        margin: 0 auto 0.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 1rem;
        color: white;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .page-header {
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-card {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .fade-card:nth-child(1)  { animation-delay: 0.05s; }
    .fade-card:nth-child(2)  { animation-delay: 0.10s; }
    .fade-card:nth-child(3)  { animation-delay: 0.15s; }
    .fade-card:nth-child(4)  { animation-delay: 0.20s; }
    .fade-card:nth-child(5)  { animation-delay: 0.25s; }
    .fade-card:nth-child(6)  { animation-delay: 0.30s; }
    .fade-card:nth-child(7)  { animation-delay: 0.35s; }
    .fade-card:nth-child(8)  { animation-delay: 0.40s; }
    .fade-card:nth-child(9)  { animation-delay: 0.45s; }
    .fade-card:nth-child(10) { animation-delay: 0.50s; }
    .fade-card:nth-child(11) { animation-delay: 0.55s; }
    .fade-card:nth-child(12) { animation-delay: 0.60s; }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }
</style>