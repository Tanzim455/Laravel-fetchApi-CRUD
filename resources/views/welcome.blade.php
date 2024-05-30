<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="xl:flex xl:flex-row space-x-2 sm:flex sm:flex-col">
        @foreach ($products as $product)
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add to Cart
                </button>
            </form>
        </div>
        @endforeach
        <div class="maindiv flex flex-col max-w-3xl p-6 space-y-4 sm:p-10 dark:bg-gray-50 dark:text-gray-800">
            <h2 class="text-xl font-semibold">Your cart - Total items in cart <span class="cartLength"></span></h2>
            <div class="cart-items"></div>
        </div>
    </div>

    <script>
        const allForm = document.querySelectorAll('.form');

        async function fetchCarts() {
            try {
                const allCarts = await axios.get('http://127.0.0.1:8000/carts');
                const cartLength = allCarts.data.length;
                document.querySelector('.cartLength').textContent = cartLength;

                const cartItemsDiv = document.querySelector('.cart-items');
                cartItemsDiv.innerHTML = ''; // Clear previous items

                allCarts.data.forEach(cart => {
                    const cartDiv = document.createElement('div');
                    cartDiv.classList.add('text-bold', 'font-serif', 'text-2xl');
                    cartDiv.textContent = `Product ID: ${cart.product_id}, Quantity: ${cart.quantity}, Total Price: ${cart.total_price}`;
                    cartItemsDiv.appendChild(cartDiv);
                });
            } catch (error) {
                console.error('Error fetching carts:', error);
            }
        }

        allForm.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const form = e.target;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const quantity = parseFloat(form.querySelector('.quantity').value);
                const productId = parseFloat(form.querySelector('.product_id').value);

                try {
                    const singleProductResponse = await fetch(`http://127.0.0.1:8000/products/${productId}`);
                    const singleProduct = await singleProductResponse.json();
                    const price = parseFloat(singleProduct.price);

                    const allCartsResponse = await fetch(`http://127.0.0.1:8000/carts`);
                    const allCarts = await allCartsResponse.json();

                    const existingCart = allCarts.find(cart => cart.product_id === productId);

                    if (existingCart) {
                        const newQuantity = existingCart.quantity + quantity;
                        const updatedPrice = newQuantity * price;

                        const response = await fetch('http://127.0.0.1:8000/addTo/Cart', {
                            method: 'POST',
                            headers: {
                                'Content-type': 'application/json; charset=UTF-8',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                quantity: newQuantity,
                                total_price: updatedPrice,
                                product_id: productId
                            }),
                        });
                    } else {
                        const response = await fetch('http://127.0.0.1:8000/addTo/Cart', {
                            method: 'POST',
                            headers: {
                                'Content-type': 'application/json; charset=UTF-8',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                price: price,
                                quantity: quantity,
                                total_price: price * quantity,
                                product_id: productId
                            }),
                        });
                    }

                    fetchCarts();
                } catch (error) {
                    console.error('Error adding to cart:', error);
                }
            });
        });

        fetchCarts();
    </script>
</body>
</html>
