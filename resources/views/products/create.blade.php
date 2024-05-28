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
    
<form   class="form max-w-sm mx-auto">
    
    <div class="successmessage"></div>
    <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <input type="text" name="title" class="title bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <div class="errortitlemessage"></div>
    </div>
    <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <input type="text" name="description" class="description bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <div class="errordescriptionmessage"></div>
    </div>
    <div class="mb-5">
      <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
      <input type="number" name="price" class="price bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
      <div class="errorpricemessage"></div>
  </div>
    
    <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

<script>
    const form = document.querySelector('.form');
    const title = document.querySelector('.title');
    const description = document.querySelector('.description');
    const price = document.querySelector('.price');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const successmessage = document.querySelector('.successmessage');
    const errortitlemessage = document.querySelector('.errortitlemessage');
    const errordescriptionmessage = document.querySelector('.errordescriptionmessage');
    const errorpricemessage=document.querySelector('.errorpricemessage');
    
   // Assuming you have an HTML form with input fields for title and description
// const form = document.querySelector('#your-form-id'); // Replace with your actual form ID

form.addEventListener('submit',  async (e) => {
  e.preventDefault();

 
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  
    const response =await fetch('http://127.0.0.1:8000/products/store', {
      method: 'POST',
      headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify({
        title: title.value,
        description: description.value,
        price:price.value
      }),
    });
  
    let message=await response.json();
  
     
    if(message.status===400){
      
      console.log(message.errors.price[0]);
      if(message.errors.title){
        errortitlemessage.textContent=`${message.errors.title[1]}`
        errortitlemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
      }
      if(message.errors.price){
        errorpricemessage.textContent=`${message.errors.price[0]}`
        errorpricemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
      }
      if(message.errors.description){
        errordescriptionmessage.textContent=`${message.errors.description[1]}`
        errordescriptionmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
       
      }
      if(message.errors.title && message.errors.description){
        errortitlemessage.textContent=`${message.errors.title[1]}`
        errordescriptionmessage.textContent=`${message.errors.description[1]}`
         errorpricemessage.textContent=`${message.errors.price[0]}`
        errortitlemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
        
        errordescriptionmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
        // errorpricemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
      }
      title.value = '';
  description.value = '';

      
    }
    if(message.status===200){
      successmessage.textContent=`${message.message}`;
      successmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400')
      title.value = '';
  description.value = '';
    }
  })
  
  
    

  // Clear input fields



    //  axios.post('http://127.0.0.1:8000/products').then(data=>{
        //     console.log(data);
        //  })
</script>
</body>
</html>