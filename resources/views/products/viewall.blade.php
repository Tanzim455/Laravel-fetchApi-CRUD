

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
    <div class="successmessage"></div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
             
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                   Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete
                 </th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be dynamically added here -->
        </tbody>
    <script>
//    



let products=fetch('http://127.0.0.1:8000/products')
// console.log(products);


    let tbody=document.querySelector('tbody');
    products.then(response => response.json())
  .then(data =>{
    data.forEach(d=> {
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
         let tr=document.createElement('tr');
         let td=document.createElement('td');
         let button=document.createElement('button');
         button.textContent='Delete';
         td.textContent=`${d.id}`;
         td.classList.add('px-6', 'py-4')
         let td2=document.createElement('td');
          td2.textContent=`${d.title}`;
          td2.classList.add('px-6', 'py-4')
          let td3=document.createElement('td');
          td3.textContent=`${d.description}`;
          td3.classList.add('px-6', 'py-4')
          button.classList.add('dlt-button','focus:outline-none','text-white','bg-red-700','hover:bg-red-800','focus:ring-4', 'focus:ring-red-300','font-medium','rounded-lg','text-sm','px-5','py-2.5','me-2','mb-2','dark:bg-red-600', 'dark:hover:bg-red-700','dark:focus:ring-red-900')
          button.addEventListener('click',(e)=>{
               e.preventDefault();
               fetch(`http://127.0.0.1:8000/products/${d.id}`,{
                method:"DELETE",
                headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': csrfToken,
      },
               })  
               .then(res=>res.json())
           .then(data=>{
            let successmessage=document.querySelector('.successmessage')
            successmessage.textContent=`${data.message}`
            successmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400')
            tr.remove();
           });
           
            
          })
         tr.appendChild(td)
         tr.appendChild(td2)
         tr.appendChild(td3)
         tr.appendChild(button)
         tbody.appendChild(tr)

    });
  }).catch(error => console.error('Error:', error));
 

  





  
    </script>
</body>
</html>

