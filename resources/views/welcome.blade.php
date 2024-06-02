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
       allCarts.forEach(c=>{
              
           let ul=document.createElement('ul');
           ul.classList.add('flex','flex-col','divide-y','dark:divide-gray-300')
            let li=document.createElement('li');
           
            li.classList.add('flex','flex-col','py-6','sm:flex-row','sm:justify-between');
            cartItems.appendChild(ul);
           ul.appendChild(li);
          
        //   //firstDiv inside li
           let firstDivInsideLi=document.createElement('div');
            firstDivInsideLi.classList.add('flex','w-full','space-x-2','sm:space-x-4');
        //    //First  Div inside first div 
        li.appendChild(firstDivInsideLi);
            let firstNestedDivInsideFirstDiv=document.createElement('div');
            firstNestedDivInsideFirstDiv.classList.add('flex','pb-2','justify-between','w-full');
        //    //first div inside the first nested div
            let firstDivInsideFirstNestedDiv=document.createElement('div');
            firstDivInsideFirstNestedDiv.classList.add('flex','justify-between','w-full','pb-2','space-x-2');
        //    //first child div inside first div inside the first nested div
             let first_child_div_inside_first_div_inside_nested_div=document.createElement('div');
             first_child_div_inside_first_div_inside_nested_div.classList.add('space-y-1');
             let second_child_div_inside_first_div_inside_nested_div=document.createElement('div');
             second_child_div_inside_first_div_inside_nested_div.classList.add('text-right');
             let heading_inside_first_child=document.createElement('div');
            
             heading_inside_first_child.classList.add('text-lg','font-semibold','leading-snug','sm:pr-8');
             heading_inside_first_child.textContent=`${c.title}`;
             console.log(heading_inside_first_child);
             let paragraph_inside_first_child=document.createElement('div');
            
            paragraph_inside_first_child.classList.add('text-sm','dark:text-gray-600');
            paragraph_inside_first_child.textContent=`${c.description}`;

             let heading_inside_second_child=document.createElement('div');
             heading_inside_second_child.classList.add('text-lg','font-semibold')
             heading_inside_second_child.textContent=`${c.price}`;
        //     console.log(heading_inside_second_child);
             first_child_div_inside_first_div_inside_nested_div.appendChild(heading_inside_first_child);
             first_child_div_inside_first_div_inside_nested_div.appendChild(paragraph_inside_first_child);
             second_child_div_inside_first_div_inside_nested_div.appendChild(heading_inside_second_child);
             firstDivInsideFirstNestedDiv.appendChild(first_child_div_inside_first_div_inside_nested_div);
             firstDivInsideFirstNestedDiv.appendChild(second_child_div_inside_first_div_inside_nested_div);
            firstNestedDivInsideFirstDiv.appendChild(firstDivInsideFirstNestedDiv);
            firstDivInsideLi.appendChild(firstNestedDivInsideFirstDiv);
          //second div inside nested div
            let secondDivInsideFirstNestedDiv=document.createElement('div');
            secondDivInsideFirstNestedDiv.classList.add('flex','text-sm','divide-x');
            let button1=document.createElement('button');
            
            button1.classList.add('flex', 'items-center', 'px-2', 'py-1', 'space-x-1');

            const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, "svg");
    svg.setAttributeNS(null, "viewBox", "0 0 512 512");
    svg.setAttributeNS(null, "class", "w-4 h-4 fill-current");

    // Create the first path element
    const path1 = document.createElementNS(svgNS, "path");
    path1.setAttributeNS(null, "d", "M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z");

    // Create the first rect element
    const rect1 = document.createElementNS(svgNS, "rect");
    rect1.setAttributeNS(null, "width", "32");
    rect1.setAttributeNS(null, "height", "200");
    rect1.setAttributeNS(null, "x", "168");
    rect1.setAttributeNS(null, "y", "216");

    // Create the second rect element
    const rect2 = document.createElementNS(svgNS, "rect");
    rect2.setAttributeNS(null, "width", "32");
    rect2.setAttributeNS(null, "height", "200");
    rect2.setAttributeNS(null, "x", "240");
    rect2.setAttributeNS(null, "y", "216");

    // Create the third rect element
    const rect3 = document.createElementNS(svgNS, "rect");
    rect3.setAttributeNS(null, "width", "32");
    rect3.setAttributeNS(null, "height", "200");
    rect3.setAttributeNS(null, "x", "312");
    rect3.setAttributeNS(null, "y", "216");

    // Create the second path element
    const path2 = document.createElementNS(svgNS, "path");
    path2.setAttributeNS(null, "d", "M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z");

    // Append all elements to the SVG
    svg.appendChild(path1);
    svg.appendChild(rect1);
    svg.appendChild(rect2);
    svg.appendChild(rect3);
    svg.appendChild(path2);
    svg.classList.add('-mt-5')
    let span=document.createElement('span');
    span.classList.add('-mt-5')
    // spanDelete.textContent='Remove';
   button1.appendChild(svg);
    button1.appendChild(span);
    button1.addEventListener('click', async(e) => {
    e.preventDefault();
   
    
   let singleCartDelete=await fetch(`http://127.0.0.1:8000/cart/${c.id}`,{
                method:"DELETE",
                headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': csrfToken,
      },
               });  
   console.log(singleCartDelete);
    let deletedCart=await singleCartDelete.json();
    
     cartmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400');
     cartmessage.textContent=`${deletedCart.message}`;
    fetchCarts();

               
   
});

    let buttontwo=document.createElement('button');
    buttontwo.classList.add('flex','items-center','px-2','py-1','space-x-1');
    let spantwo=document.createElement('span');
    spantwo.textContent='Add To Favourites';
    secondDivInsideFirstNestedDiv.appendChild(button1);
   
        //   //Appenping li
        var svgtwo = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svgtwo.setAttribute("viewBox", "0 0 512 512");
    svgtwo.setAttribute("class", "w-4 h-4 fill-current");

    var pathtwo = document.createElementNS("http://www.w3.org/2000/svg", "path");
    pathtwo.setAttribute("d", "M453.122,79.012a128,128,0,0,0-181.087.068l-15.511,15.7L241.142,79.114l-.1-.1a128,128,0,0,0-181.02,0l-6.91,6.91a128,128,0,0,0,0,181.019L235.485,449.314l20.595,21.578.491-.492.533.533L276.4,450.574,460.032,266.94a128.147,128.147,0,0,0,0-181.019ZM437.4,244.313,256.571,425.146,75.738,244.313a96,96,0,0,1,0-135.764l6.911-6.91a96,96,0,0,1,135.713-.051l38.093,38.787,38.274-38.736a96,96,0,0,1,135.765,0l6.91,6.909A96.11,96.11,0,0,1,437.4,244.313Z");      

     svgtwo.appendChild(pathtwo);
     buttontwo.appendChild(spantwo);
     buttontwo.appendChild(svgtwo);
     secondDivInsideFirstNestedDiv.appendChild(buttontwo);
     secondDivInsideFirstNestedDiv.appendChild(button1);
    firstNestedDivInsideFirstDiv.appendChild(secondDivInsideFirstNestedDiv);     
          //first nested div inside first Div Inside Li
    let secondParentDiv=document.createElement('div');
    secondParentDiv.classList.add('space-y-1','text-right');
    let secondParentDivParagrah=document.createElement('p');
    let totalPrice=`${c.price}` * `${c.quantity}`
    
    secondParentDivParagrah.textContent=`Total amount ${totalPrice}`;
    let spanInisdefirstPara=document.createElement('div');
    span.classList.add('text-semibold');
    span.textContent=`Quantity-${c.quantity} * Price-${c.price}`;

    let secondParentDivParagraphTwo=document.createElement('p');
    secondParentDivParagraphTwo.classList.add('text-sm','dark:text-gray-600');
    secondParentDiv.appendChild(spanInisdefirstPara);
    secondParentDivParagraphTwo.textContent='Not including taxes and shipping costs';
    secondParentDiv.appendChild(secondParentDivParagrah);
    secondParentDiv.appendChild(secondParentDivParagraphTwo);
    cartItems.appendChild(secondParentDiv);
         
          
          
          
        
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
                // console.log("Product not there in cart");
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