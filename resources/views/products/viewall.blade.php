

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


async function fetchallProducts(){
    let products=await fetch('http://127.0.0.1:8000/products')
// console.log(products);


    let tbody=document.querySelector('tbody');
    let data=await products.json();
    console.log(data);
  
   
    data.forEach(d=> {
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
         let tr=document.createElement('tr');
         let td=document.createElement('td');
         let button=document.createElement('button');
         let editBtn=document.createElement('button');
         button.textContent='Delete';
          editBtn.textContent='Edit';
         td.textContent=`${d.id}`;
         td.classList.add('px-6', 'py-4')
         let td2=document.createElement('td');
          td2.textContent=`${d.title}`;
          td2.classList.add('px-6', 'py-4')
          let td3=document.createElement('td');
          td3.textContent=`${d.description}`;
          td3.classList.add('px-6', 'py-4')
          button.classList.add('dlt-button','focus:outline-none','text-white','bg-red-700','hover:bg-red-800','focus:ring-4', 'focus:ring-red-300','font-medium','rounded-lg','text-sm','px-5','py-2.5','me-2','mb-2','dark:bg-red-600', 'dark:hover:bg-red-700','dark:focus:ring-red-900')
          editBtn.classList.add('edit-btn', 'text-gray-900', 'bg-white', 'border', 'border-gray-300', 'focus:outline-none', 'hover:bg-gray-100', 'focus:ring-4', 'focus:ring-gray-100', 'font-medium', 'rounded-lg', 'text-sm', 'px-5', 'py-2.5', 'me-2', 'mb-2', 'dark:bg-gray-800', 'dark:text-white', 'dark:border-gray-600', 'dark:hover:bg-gray-700', 'dark:hover:border-gray-600', 'dark:focus:ring-gray-700');


          button.addEventListener('click',async (e)=>{
               e.preventDefault();
            let response=await fetch(`http://127.0.0.1:8000/products/${d.id}`,{
                method:"DELETE",
                headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': csrfToken,
      },
               })  
               
               let deleteData=await response.json();
           
            let successmessage=document.querySelector('.successmessage')
            successmessage.textContent=`${deleteData.message}`
            successmessage.classList.add('p-4','mb-4','text-sm','text-green-800','rounded-lg','bg-green-50','dark:bg-gray-800', 'dark:text-green-400')
            tr.remove();
           
           
            
          })
         
            
          editBtn.addEventListener('click', (e)=>{
            e.preventDefault();
            window.location.href=`http://127.0.0.1:8000/products/${d.id}/edit`
            
            })
           
            
            
         tr.appendChild(td)
         tr.appendChild(td2)
         tr.appendChild(td3)
         tr.appendChild(button)
         tr.appendChild(editBtn)
         tbody.appendChild(tr)

    });
    
}
fetchallProducts();
 

  





  
    </script>
</body>
</html>

