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
  
    
    
        
        
        <div class="flex space-x-2">
            @foreach ($products as $product)
           
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$product->title}}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price-{{$product->price}}</p>
               
                <form class="form">
                    
                <input  type="text" class="product_id" name="product_id" value="{{$product->id}}"     id="">
                <div class="mb-5">
                    <label for="quantity">Quantity:</label>
              <input type="number" class="quantity bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
               name="quantity"  min="1" max="100">
              
                  </div>
                <button  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add to Cart
                    
                </a>
                </form>

                
            </div>
            @endforeach
            
        </div>
        <div class="flex flex-col max-w-3xl p-6 space-y-4 sm:p-10 dark:bg-gray-50 dark:text-gray-800">
            <h2 class="text-xl font-semibold">Your cart-Total items in cart -{{$cartLength}}</h2>
            @foreach($carts as $cart)
            <ul class="flex flex-col divide-y dark:divide-gray-300">
                <li class="flex flex-col py-6 sm:flex-row sm:justify-between">
                    <div class="flex w-full space-x-2 sm:space-x-4">
                        <img class="flex-shrink-0 object-cover w-20 h-20 dark:border- rounded outline-none sm:w-32 sm:h-32 dark:bg-gray-500" src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80" alt="Polaroid camera">
                        <div class="flex flex-col justify-between w-full pb-4">
                            <div class="flex justify-between w-full pb-2 space-x-2">
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold leading-snug sm:pr-8">{{$cart->title}}</h3>
                                    <p class="text-sm dark:text-gray-600">{{$cart->description}}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold">{{$cart->price}}</p>
                                    
                                </div>
                            </div>
                            <div class="flex text-sm divide-x">
                                <button type="button" class="flex items-center px-2 py-1 pl-0 space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
                                        <path d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z"></path>
                                        <rect width="32" height="200" x="168" y="216"></rect>
                                        <rect width="32" height="200" x="240" y="216"></rect>
                                        <rect width="32" height="200" x="312" y="216"></rect>
                                        <path d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z"></path>
                                    </svg>
                                    <span>Remove</span>
                                </button>
                                <button type="button" class="flex items-center px-2 py-1 space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
                                        <path d="M453.122,79.012a128,128,0,0,0-181.087.068l-15.511,15.7L241.142,79.114l-.1-.1a128,128,0,0,0-181.02,0l-6.91,6.91a128,128,0,0,0,0,181.019L235.485,449.314l20.595,21.578.491-.492.533.533L276.4,450.574,460.032,266.94a128.147,128.147,0,0,0,0-181.019ZM437.4,244.313,256.571,425.146,75.738,244.313a96,96,0,0,1,0-135.764l6.911-6.91a96,96,0,0,1,135.713-.051l38.093,38.787,38.274-38.736a96,96,0,0,1,135.765,0l6.91,6.909A96.11,96.11,0,0,1,437.4,244.313Z"></path>
                                    </svg>
                                    <span>Add to favorites</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
                
            </ul>
            
            <div class="space-y-1 text-right">
                <p>Total amount:
                    <span class="font-semibold">Quantity-{{$cart->quantity}} * Price-{{$cart->price}}={{$cart->total_price}}</span>
                </p>
                <p class="text-sm dark:text-gray-600">Not including taxes and shipping costs</p>
            </div>
            
            @endforeach
            <div class="flex justify-end space-x-4">
                <button type="button" class="px-6 py-2 border rounded-md dark:border-violet-600">Back
                    <span class="sr-only sm:not-sr-only">to shop</span>
                </button>
                <button type="button" class="px-6 py-2 border rounded-md dark:bg-violet-600 dark:text-gray-50 dark:border-violet-600">
                    <span class="sr-only sm:not-sr-only">Continue to</span>Checkout
                </button>
            </div>
        </div>
   
    <script>
       const allForm = document.querySelectorAll('.form');
allForm.forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target; // The form being submitted
        console.log(form);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const quantity = form.querySelector('.quantity').value; // Get the quantity within the form
        const productId = form.querySelector('.product_id').value; // Get the product_id within the form

        

        try {
            const singleProductResponse = await fetch(`http://127.0.0.1:8000/products/${productId}`);
            const singleProduct = await singleProductResponse.json();
            const price = parseFloat(singleProduct.price);
            

            const allCartsResponse = await fetch(`http://127.0.0.1:8000/carts`);
            const allCarts = await allCartsResponse.json();
            console.log(allCarts);

            const cartIds = allCarts.map(c => c.product_id);
            const convertToIntProductId = parseFloat(productId);
            const isProductId = cartIds.includes(convertToIntProductId);

          if (isProductId) {
  console.log("Product Id is there in cart");

  const singleProduct = allCarts.find(cart => cart.product_id === convertToIntProductId);
  // console.log("Single product is",singleProduct);
  const currentCartQuantity = parseFloat(singleProduct.quantity);
  console.log("Current quantity", currentCartQuantity);
  
  let inputQuantity=parseFloat(quantity);
  
  inputQuantity+currentCartQuantity;
  
  const updatedPrice=inputQuantity * price;

  

let Obj={
    quantity:inputQuantity,
    total_price:updatedPrice,
    product_id: productId
}
  console.log(Obj);





  const res=await axios.post('http://127.0.0.1:8000/addTo/Cart',{
    quantity:inputQuantity,
    total_price:updatedPrice,
    product_id: productId
  });



            } else {
                console.log("Product not there in cart");
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
                    //  console.log(response);
                
            }

        }catch(error){
            console.log(error);
        }

    })
})
 




</script>

       
                
                
                 
                
           
             

        

       
        
         
   


            
           
                    
            
            
       
        
    
    



</body>
</html>