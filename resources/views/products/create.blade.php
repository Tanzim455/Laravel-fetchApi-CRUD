
<html>
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
    
<form class="form max-w-sm mx-auto">
    @csrf
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
    
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('.form');
        const title = document.querySelector('.title');
        const description = document.querySelector('.description');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const successmessage=document.querySelector('.successmessage');
        const titlemessage=document.querySelector('.titlemessage');
        const errortitlemessage=document.querySelector('.errortitlemessage');
        const errordescriptionmessage=document.querySelector('.errordescriptionmessage');
        form.addEventListener('submit', (e) => {
             e.preventDefault(); // Prevent the default form submission

//             fetch('http://127.0.0.1:8000/products', {
//                 method: 'POST',
//                 body: JSON.stringify({
//                     title: title.value,
//                     description: description.value
//                 }),
//                 headers: {
//                     'Content-type': 'application/json',
//                     'X-CSRF-TOKEN': csrfToken
//                 },
               
//             }).then((response) =>{
//                 console.log(response.status);
//                 // if(response.status===200){
//                 //   return response.json();
//                 // }
//                 // if(response.status===422)
//                 // {
//                 //     console.log("422 error");
//                 // }
//             })
//   .then((json) =>{
//         successmessage.textContent=`${json.message}`
//         successmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-green-50', 'dark:bg-gray-800', 'dark:text-green-400');

        
//   })
// let formObj=JSON.stringify({
//                      title: title.value,
//                      description: description.value
//                 })
                axios.post('http://127.0.0.1:8000/products', {
    title:title.value,
    description:description.value
  })
  .then(function (response) {
    
    if(response.status===200){
        console.log(response);
        successmessage.textContent=`${response.data.message}`
        successmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-green-50', 'dark:bg-gray-800', 'dark:text-green-400');
    }
  })
  .catch(function (error) {
    console.log();
     errortitlemessage.textContent=`${error.response.data.errors.title[1]}`
    errordescriptionmessage.textContent=`${error.response.data.errors.description[1]}`
    errortitlemessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-red-50', 'dark:bg-red-800', 'dark:text-red-400')
  });
        // axios.post('http://127.0.0.1:8000/products',formObj)
        // .then(data=>console.log(data))
            description.value='';
            title.value='';



           
         })
        })
</script>
</body>
</html>
