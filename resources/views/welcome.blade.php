<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
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
                    
                <input  type="hidden" class="product_id" name="product_id" value="{{$product->id}}"     id="">
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
     
        <div class="cartmessage ml-8"></div>
        <div class="maindiv flex flex-col max-w-3xl p-6 space-y-4 sm:p-10 dark:bg-gray-50 dark:text-gray-800">
            <h2 class=" text-xl font-semibold">Your cart-Total items in cart <span class="cartLength"></span></h2>
        <div class="cart_items"></div>
        </div>
    <script>
        
       const allForm = document.querySelectorAll('.form');
       
     
       async function fetchCarts(){
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       const cartResponse=await fetch('http://127.0.0.1:8000/carts')
       
       const allCarts = await cartResponse.json();

       let cartLength=allCarts.length
       
       let totalCartAmount=document.querySelector('.cartLength');

        totalCartAmount.textContent=cartLength
        let cartItems=document.querySelector('.cart_items');
        
        cartItems.innerHTML = ''; 
       
       let cartmessage=document.querySelector('.cartmessage');
        
     // Clear previous items 
       
        
                allCarts.forEach(c => {
                    cartItems.innerHTML += `
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
                                        <button class="delete-button flex items-center px-2 py-1 space-x-1 " value="${c.id}">
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
                    </ul>`;
                
       });
      let deleteButtons=document.querySelectorAll('.delete-button');
     deleteButtons.forEach(d=>{
        d.addEventListener('click',async(e)=>{
            e.preventDefault();
            let deleteId=d.value;
            let singleCartDelete=await fetch(`http://127.0.0.1:8000/cart/${deleteId}`,{
                method:"DELETE",
                headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': csrfToken,
      },
               });  
               let deletedCart=await singleCartDelete.json();
               cartmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400');
                 cartmessage.textContent=`${deletedCart.message}`;
          fetchCarts();
        });
     })
    
    }
    
         
          
          
          
        
  

allForm.forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
         
         
        const form = e.target; // The form being submitted
        console.log(form);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const quantity = form.querySelector('.quantity').value; // Get the quantity within the form
        const productId = form.querySelector('.product_id').value; // Get the product_id within the form

        

    
            const singleProductResponse = await fetch(`http://127.0.0.1:8000/products/${productId}`);
            const singleProduct = await singleProductResponse.json();
            const price = parseFloat(singleProduct.price);
            

            const allCartsResponse = await fetch(`http://127.0.0.1:8000/carts`);
            const allCarts = await allCartsResponse.json();
          

            const cartIds = allCarts.map(c => c.product_id);
            const convertToIntProductId = parseFloat(productId);
            const isProductId = cartIds.includes(convertToIntProductId);

          if (isProductId) {
                  console.log("Product there in cart");

  const singleProduct = allCarts.find(cart => cart.product_id === convertToIntProductId);
  // console.log("Single product is",singleProduct);
  const currentCartQuantity = parseFloat(singleProduct.quantity);
  console.log("Current quantity", currentCartQuantity);
  
  let inputQuantity=parseFloat(quantity);
  console.log("Input quantity",inputQuantity);
  inputQuantity+currentCartQuantity;
  console.log(inputQuantity);

//   console.log(upDatedQuantity);
   const updatedPrice=inputQuantity * price;

let CartObj={
    quantity:inputQuantity,
    total_price:updatedPrice,
    product_id: productId
}
 const response = await fetch('http://127.0.0.1:8000/addTo/Cart', {
                     method: 'POST',
                     headers: {
                         'Content-type': 'application/json; charset=UTF-8',
                         'X-CSRF-TOKEN': csrfToken,
                     },
                     body: JSON.stringify(CartObj)
                    })
                   
                    let cartAddJson=await response.json();
                    let cartmessage=document.querySelector('.cartmessage');
                    cartmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400');
                 cartmessage.textContent=`${cartAddJson.message}`;

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
                let cartUpdateJson=await response.json();
                let cartmessage=document.querySelector('.cartmessage');
                cartmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400');
                 cartmessage.textContent=`${cartUpdateJson.message}`;
                
            }
            fetchCarts(); 
            
        })
       
    
})
 fetchCarts();   
//Cart List 




</script>

       
                
                
                 
                
           
             

        

       
        
         
   


            
           
                    
            
            
       
        
    
    



</body>
</html>