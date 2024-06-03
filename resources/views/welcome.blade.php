<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="xl:flex xl:flex-row space-x-2 sm:flex sm:flex-col md:flex md:flex-row">
        @foreach ($products as $product)
        <div class="xl:w-1/5 sm:w-1/6 md:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$product->title}}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price-{{$product->price}}</p>
            <form class="form">
                <input type="hidden" class="product_id" name="product_id" value="{{$product->id}}">
                <div class="mb-5">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="quantity bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="quantity" min="1" max="100">
                </div>
                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add to Cart
                </button>
            </form>
        </div>
        @endforeach
    </div>
    <div class="cartmessage ml-8"></div>
    <div class="maindiv flex flex-col max-w-3xl p-6 space-y-4 sm:p-10 dark:bg-gray-50 dark:text-gray-800">
        <h2 class="text-xl font-semibold">Your cart - Total items in cart <span class="cartLength"></span></h2>
        <div class="cart_items"></div>
    </div>

    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
        
            function fetchCarts() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/carts',
                    method: 'GET',
                    success: function(allCarts) {
                        let cartLength = allCarts.length;
                        $('.cartLength').text(cartLength);
        
                        let cartItems = $('.cart_items');
                        cartItems.empty();
        
                        let cartmessage = $('.cartmessage');
        
                        allCarts.forEach(c => {
                            cartItems.append(`
                                <ul class="flex flex-col divide-y dark:divide-gray-300">
                                    <li class="flex flex-col py-6 sm:flex-row sm:justify-between">
                                        <div class="flex w-full space-x-2 sm:space-x-4">
                                            <div class="flex pb-2 justify-between w-full">
                                                <div class="flex justify-between w-full pb-2 space-x-2">
                                                    <div class="space-y-1">
                                                        <div class="text-lg font-semibold leading-snug sm:pr-8">${c.title}</div>
                                                        <div class="text-sm dark:text-gray-600">${c.description}</div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-lg font-semibold">${c.price}</div>
                                                    </div>
                                                </div>
                                                <div class="flex text-sm divide-x">
                                                    <button class="delete-button flex items-center px-2 py-1 space-x-1" value="${c.id}">
                                                        <svg viewBox="0 0 512 512" class="w-4 h-4 fill-current">
                                                            <path d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z"></path>
                                                            <rect width="32" height="200" x="168" y="216"></rect>
                                                            <rect width="32" height="200" x="240" y="216"></rect>
                                                            <rect width="32" height="200" x="312" y="216"></rect>
                                                            <path d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z"></path>
                                                        </svg>
                                                    </button>
                                                    <button class="flex items-center px-2 py-1 space-x-1 add-to-favorites">
                                                        <span>Add To Favourites</span>
                                                        <svg viewBox="0 0 512 512" class="w-4 h-4 fill-current">
                                                            <path d="M453.122,79.012a128,128,0,0,0-181.087.068l-15.511,15.7L241.142,79.114l-.1-.1a128,128,0,0,0-181.02,0l-6.91,6.91a128,128,0,0,0,0,181.019L235.485,449.314l20.595,21.578.491-.492.533.533L276.4,450.574,460.032,266.94a128.147,128.147,0,0,0,0-181.019ZM437.4,244.313,256.571,425.146,75.738,244.313a96,96,0,0,1,0-135.764l6.911-6.91a96,96,0,0,1,135.713-.051l38.093,38.787,38.274-38.736a96,96,0,0,1,135.765,0l6.91,6.909A96.11,96.11,0,0,1,437.4,244.313Z"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="space-y-1 text-right">
                                    <p>Total amount:
                                        <span class="font-semibold">Quantity-<span class="totalquantity">${c.quantity}</span> * Price-<span class="perstockprice">${c.price}</span>=<span class="totalprice">${c.quantity * c.price}</span></span>
                                    </p>
                                    <p class="text-sm dark:text-gray-600">Not including taxes and shipping costs</p>
                                </div>
                            `);
                        });
        
                        $('.delete-button').on('click', function(e) {
                            e.preventDefault();
                            const deleteId = $(this).val();
                            $.ajax({
                                url: `http://127.0.0.1:8000/cart/${deleteId}`,
                                method: 'DELETE',
                                headers: {
                                    'Content-type': 'application/json; charset=UTF-8',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                success: function(deletedCart) {
                                    cartmessage.addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400');
                                    cartmessage.text(deletedCart.message);
                                    fetchCarts();
                                }
                            });
                        });
                    }
                });
            }
        
            $('.form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const quantity = form.find('.quantity').val();
                const productId = form.find('.product_id').val();
        
                $.ajax({
                    url: `http://127.0.0.1:8000/products/${productId}`,
                    method: 'GET',
                    success: function(singleProduct) {
                        const price = parseFloat(singleProduct.price);
        
                        $.ajax({
                            url: 'http://127.0.0.1:8000/carts',
                            method: 'GET',
                            success: function(allCarts) {
                                const cartIds = allCarts.map(c => c.product_id);
                                const isProductId = cartIds.includes(parseFloat(productId));
        
                                if (isProductId) {
                                    const singleProduct = allCarts.find(cart => cart.product_id === parseFloat(productId));
                                    const currentCartQuantity = parseFloat(singleProduct.quantity);
                                    let inputQuantity = parseFloat(quantity);
                                    inputQuantity += currentCartQuantity;
                                    const updatedPrice = inputQuantity * price;
        
                                    let CartObj = {
                                        quantity: inputQuantity,
                                        total_price: updatedPrice,
                                        product_id: productId
                                    };
        
                                    $.ajax({
                                        url: 'http://127.0.0.1:8000/addTo/Cart',
                                        method: 'POST',
                                        headers: {
                                            'Content-type': 'application/json; charset=UTF-8',
                                            'X-CSRF-TOKEN': csrfToken,
                                        },
                                        data: JSON.stringify(CartObj),
                                        success: function(cartAddJson) {
                                            let cartmessage = $('.cartmessage');
                                            cartmessage.addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400');
                                            cartmessage.text(cartAddJson.message);
                                            fetchCarts();
                                        }
                                    });
                                } else {
                                    let CartObj = {
                                        price: price,
                                        quantity: quantity,
                                        total_price: price * quantity,
                                        product_id: productId
                                    };
        
                                    $.ajax({
                                        url: 'http://127.0.0.1:8000/addTo/Cart',
                                        method: 'POST',
                                        headers: {
                                            'Content-type': 'application/json; charset=UTF-8',
                                            'X-CSRF-TOKEN': csrfToken,
                                        },
                                        data: JSON.stringify(CartObj),
                                        success: function(cartUpdateJson) {
                                            let cartmessage = $('.cartmessage');
                                            cartmessage.addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400');
                                            cartmessage.text(cartUpdateJson.message);
                                            fetchCarts();
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });
        
            fetchCarts();
        });
        </script>
        
</body>
</html>

