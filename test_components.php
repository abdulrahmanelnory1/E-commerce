<?php

require_once 'vendor/autoload.php';

echo "Testing Livewire Component Loading...\n";
echo "====================================\n\n";

// Test Shop component
try {
    $shop = new Modules\Cart\App\Livewire\Shop();
    echo "✓ Shop component loaded successfully\n";
} catch (Exception $e) {
    echo "✗ Shop component ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Test Checkout component
try {
    $checkout = new Modules\Cart\App\Livewire\Checkout();
    echo "✓ Checkout component loaded successfully\n";
} catch (Exception $e) {
    echo "✗ Checkout component ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Test Orders component
try {
    $orders = new Modules\Cart\App\Livewire\Orders();
    echo "✓ Orders component loaded successfully\n";
} catch (Exception $e) {
    echo "✗ Orders component ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Test ProfileEdit component
try {
    $profile = new App\Livewire\ProfileEdit();
    echo "✓ ProfileEdit component loaded successfully\n";
} catch (Exception $e) {
    echo "✗ ProfileEdit component ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Test ProductShow component
try {
    $productShow = new Modules\Product\App\Livewire\ProductShow();
    echo "✓ ProductShow component loaded successfully\n";
} catch (Exception $e) {
    echo "✗ ProductShow component ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Test CategoryList component
try {
    $categoryList = new Modules\Category\App\Livewire\CategoryList();
    echo "✓ CategoryList component loaded successfully\n";
} catch (Exception $e) {
    echo "✗ CategoryList component ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n====================================\n";
echo "✓ All components loaded successfully!\n";
echo "====================================\n";

exit(0);
