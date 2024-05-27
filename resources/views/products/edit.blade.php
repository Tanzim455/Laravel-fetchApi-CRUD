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
    
<form   class="form max-w-sm mx-auto">
    
    <div class="successmessage"></div>
    
        
        <input type="hidden" name="id"
        value="{{$product->id}}"
         class="hiddenid bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        
    
    <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <input type="text" name="title"
        value="{{$product->title}}"
         class="title bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <div class="errortitlemessage"></div>
    </div>
    <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <input type="text"
        value="{{$product->description}}"
        name="description" class="description bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <div class="errordescriptionmessage"></div>
    </div>
    
    <button  class="updateBtn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    <script>
        const form = document.querySelector('.form');
    const title = document.querySelector('.title');
    const description = document.querySelector('.description');
    const id=document.querySelector('.hiddenid');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const successmessage = document.querySelector('.successmessage');
    const errortitlemessage = document.querySelector('.errortitlemessage');
    const errordescriptionmessage = document.querySelector('.errordescriptionmessage');

        form.addEventListener('submit',e=>{
             e.preventDefault();
             console.log(title.value);
            // console.log(description.value);
             fetch(`http://127.0.0.1:8000/products/${id.value}`, {
   method: 'PUT',
   body: JSON.stringify({
     id:id.value,
     title:title.value,
     description:description.value
   }),
   headers: {
         'Content-type': 'application/json; charset=UTF-8',
         'X-CSRF-TOKEN': csrfToken,
       },
 })
  .then((response) => response.json())
   .then((json) => {
    if(json.status===400){
        if(json.errors.title){
        errortitlemessage.textContent=`${json.errors.title[1]}`
        errortitlemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
      }
      if(json.errors.description){
        errordescriptionmessage.textContent=`${json.errors.description[1]}`
        errordescriptionmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
       
      }
        if(json.errors.title && json.errors.description){
        errortitlemessage.textContent=`${json.errors.title[1]}`
        errordescriptionmessage.textContent=`${json.errors.description[1]}`
        errortitlemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
        errordescriptionmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
      }
    }
    
    if(json.status===200){
      successmessage.textContent=`${json.message}`;
      successmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400')
      
    }
   });
   
         });
         
     </script>
</form>
