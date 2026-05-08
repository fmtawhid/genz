@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Point of Sale (POS)</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="bg-gray-100 min-h-screen p-4">
                <div class="grid grid-cols-12 gap-4">

                    <!-- LEFT : PRODUCTS -->
                    <div class="col-span-8">
                        <div class="bg-white rounded-xl shadow-sm h-full flex flex-col">

                            <!-- Header -->
                            <div class="flex justify-between items-center p-4 border-b">
                                <h2 class="font-semibold text-lg">Browse Products</h2>
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm" id="product-count">0</span>
                            </div>

                            <!-- Search -->
                            <div class="p-4">
                                <input type="text" placeholder="Search products..." id="product-search"
                                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-700">
                            </div>

                            <!-- Products -->
                            <div class="p-4 grid grid-cols-4 gap-4 overflow-y-auto" id="products-container">
                                <!-- Products will be loaded here via JavaScript -->
                            </div>

                        </div>
                    </div>


                    <!-- RIGHT : CART & CHECKOUT -->
                    <div class="col-span-4">
                        <div class="bg-white rounded-xl shadow-sm h-full flex flex-col">

                            <!-- Header -->
                            <div class="p-4 border-b">
                                <h2 class="font-semibold text-lg">Cart</h2>
                            </div>

                            <!-- Cart Items -->
                            <div class="flex-1 overflow-y-auto p-4 space-y-3" id="cart-items">
                                <p class="text-gray-400 text-center py-8">Cart is empty</p>
                            </div>

                            <!-- Discount Section -->
                            <div class="p-4 border-t bg-gray-50">
                                <h3 class="font-semibold text-sm mb-3">Discount</h3>
                                <div class="space-y-2">
                                    <div class="flex gap-2">
                                        <select id="discount-type" class="flex-1 border rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-700">
                                            <option value="fixed">Fixed Amount</option>
                                            <option value="percentage">Percentage (%)</option>
                                        </select>
                                        <input type="number" id="discount-value" min="0" step="0.01" placeholder="0" 
                                            class="flex-1 border rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-700">
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="p-4 border-t space-y-3">
                                
                                <!-- Subtotal -->
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-semibold" id="subtotal">৳0.00</span>
                                </div>

                                <!-- Discount Amount -->
                                <div class="flex justify-between text-red-600" id="discount-display" style="display: none;">
                                    <span>Discount</span>
                                    <span class="font-semibold" id="discount-amount">৳0.00</span>
                                </div>

                                <!-- Total -->
                                <div class="flex justify-between pt-2 border-t">
                                    <span class="font-semibold">Total</span>
                                    <span class="font-bold text-lg text-green-600" id="total">৳0.00</span>
                                </div>

                                <button id="confirm-order"
                                    class="w-full bg-green-500 text-white py-2 rounded-lg font-semibold hover:bg-green-600 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                    Confirm Order
                                </button>
                                
                                <button id="clear-cart"
                                    class="w-full bg-gray-300 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-400 transition">
                                    Clear Cart
                                </button>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Hidden form for order submission -->
    <form id="order-form" action="{{ route('admin.sales.store') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="items" id="order-items">
        <input type="hidden" name="total_amount" id="order-total">
        <input type="hidden" name="discount_type" id="order-discount-type">
        <input type="hidden" name="discount_value" id="order-discount-value">
    </form>

    <script>
        // Products data with dummy products
        const products = [
            { id: 1, name: 'Laptop Dell XPS', sku: 'SKU-001', sale_price: 55000, stock_quantity: 15 },
            { id: 2, name: 'USB-C Cable', sku: 'SKU-002', sale_price: 249, stock_quantity: 5 },
            { id: 3, name: 'Wireless Mouse', sku: 'SKU-003', sale_price: 999, stock_quantity: 25 },
            { id: 4, name: '4K Monitor', sku: 'SKU-004', sale_price: 16000, stock_quantity: 3 },
            { id: 5, name: 'Mechanical Keyboard', sku: 'SKU-005', sale_price: 3999, stock_quantity: 0 },
            { id: 6, name: 'Web Camera HD', sku: 'SKU-006', sale_price: 1500, stock_quantity: 12 },
            { id: 7, name: 'HDMI Cable', sku: 'SKU-007', sale_price: 350, stock_quantity: 40 },
            { id: 8, name: 'Power Bank 20000mAh', sku: 'SKU-008', sale_price: 1800, stock_quantity: 8 },
        ];
        let cart = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            setupEventListeners();
        });

        function loadProducts() {
            const container = document.getElementById('products-container');
            container.innerHTML = '';
            
            products.forEach(product => {
                const productEl = document.createElement('div');
                productEl.className = 'bg-gray-50 rounded-xl p-3 text-center hover:shadow transition cursor-pointer';
                productEl.innerHTML = `
                    <div class="h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded mb-2 flex items-center justify-center">
                        <span class="text-2xl">📦</span>
                    </div>
                    <h3 class="text-sm font-medium mb-1">${product.name}</h3>
                    <p class="text-green-600 font-semibold text-sm mb-2">৳${parseFloat(product.sale_price).toFixed(2)}</p>
                    <button class="bg-primary-600 text-white w-full py-1 rounded-lg text-sm hover:bg-primary-700 transition" 
                        onclick="addToCart(${product.id})">
                        + Add
                    </button>
                `;
                container.appendChild(productEl);
            });

            document.getElementById('product-count').textContent = products.length;
        }

        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.sale_price,
                    quantity: 1
                });
            }

            updateCart();
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCart();
        }

        function updateQuantity(productId, quantity) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity = Math.max(1, quantity);
            }
            updateCart();
        }

        function updateCart() {
            const cartContainer = document.getElementById('cart-items');
            
            if (cart.length === 0) {
                cartContainer.innerHTML = '<p class="text-gray-400 text-center py-8">Cart is empty</p>';
                document.getElementById('confirm-order').disabled = true;
            } else {
                cartContainer.innerHTML = cart.map(item => `
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium">${item.name}</p>
                            <p class="text-xs text-gray-400">৳${parseFloat(item.price).toFixed(2)}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-200 w-7 h-7 rounded text-sm hover:bg-gray-300" 
                                onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span class="w-6 text-center text-sm font-semibold">${item.quantity}</span>
                            <button class="bg-gray-200 w-7 h-7 rounded text-sm hover:bg-gray-300" 
                                onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                        <div class="font-semibold text-sm">
                            ৳${(item.price * item.quantity).toFixed(2)}
                        </div>
                        <button class="text-red-600 hover:text-red-800 text-xs ml-2" 
                            onclick="removeFromCart(${item.id})">Remove</button>
                    </div>
                `).join('');
                document.getElementById('confirm-order').disabled = false;
            }

            calculateTotals();
        }

        function calculateTotals() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const discountType = document.getElementById('discount-type').value;
            const discountValue = parseFloat(document.getElementById('discount-value').value) || 0;
            
            let discountAmount = 0;
            if (discountValue > 0) {
                if (discountType === 'percentage') {
                    discountAmount = (subtotal * discountValue) / 100;
                } else {
                    discountAmount = discountValue;
                }
            }

            const total = subtotal - discountAmount;

            document.getElementById('subtotal').textContent = '৳' + subtotal.toFixed(2);
            document.getElementById('total').textContent = '৳' + total.toFixed(2);

            const discountDisplay = document.getElementById('discount-display');
            if (discountValue > 0) {
                discountDisplay.style.display = 'flex';
                document.getElementById('discount-amount').textContent = '৳' + discountAmount.toFixed(2);
            } else {
                discountDisplay.style.display = 'none';
            }
        }

        function setupEventListeners() {
            document.getElementById('discount-type').addEventListener('change', calculateTotals);
            document.getElementById('discount-value').addEventListener('input', calculateTotals);
            
            document.getElementById('confirm-order').addEventListener('click', function() {
                if (cart.length === 0) {
                    alert('Cart is empty');
                    return;
                }
                
                const discountType = document.getElementById('discount-type').value;
                const discountValue = parseFloat(document.getElementById('discount-value').value) || 0;
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                let totalAmount = subtotal;
                
                if (discountValue > 0) {
                    if (discountType === 'percentage') {
                        totalAmount = subtotal - (subtotal * discountValue / 100);
                    } else {
                        totalAmount = subtotal - discountValue;
                    }
                }

                // For now, just show an alert. In a real scenario, you'd submit the order
                alert(`Order Confirmed!\n\nItems: ${cart.length}\nTotal: ৳${totalAmount.toFixed(2)}`);
                cart = [];
                document.getElementById('discount-value').value = '';
                document.getElementById('discount-type').value = 'fixed';
                updateCart();
            });

            document.getElementById('clear-cart').addEventListener('click', function() {
                cart = [];
                document.getElementById('discount-value').value = '';
                document.getElementById('discount-type').value = 'fixed';
                updateCart();
            });
        }

        // Product search
        document.getElementById('product-search').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const container = document.getElementById('products-container');
            
            if (searchTerm === '') {
                loadProducts();
                return;
            }

            const filtered = products.filter(p => p.name.toLowerCase().includes(searchTerm));
            container.innerHTML = '';
            
            filtered.forEach(product => {
                const productEl = document.createElement('div');
                productEl.className = 'bg-gray-50 rounded-xl p-3 text-center hover:shadow transition cursor-pointer';
                productEl.innerHTML = `
                    <div class="h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded mb-2 flex items-center justify-center">
                        <span class="text-2xl">📦</span>
                    </div>
                    <h3 class="text-sm font-medium mb-1">${product.name}</h3>
                    <p class="text-green-600 font-semibold text-sm mb-2">৳${parseFloat(product.sale_price).toFixed(2)}</p>
                    <button class="bg-primary-600 text-white w-full py-1 rounded-lg text-sm hover:bg-primary-700 transition" 
                        onclick="addToCart(${product.id})">
                        + Add
                    </button>
                `;
                container.appendChild(productEl);
            });

            document.getElementById('product-count').textContent = filtered.length;
        });
    </script>
@endsection