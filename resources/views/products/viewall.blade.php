

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
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
console.log(tbody);
products.then(response => response.json())
  .then(data =>{
    data.forEach(d=> {
        console.log(d);
         let tr=document.createElement('tr');
         let td=document.createElement('td');
         td.textContent=`${d.id}`;
         td.classList.add('px-6', 'py-4')
         let td2=document.createElement('td');
          td2.textContent=`${d.title}`;
          td2.classList.add('px-6', 'py-4')
          let td3=document.createElement('td');
          td3.textContent=`${d.description}`;
          td3.classList.add('px-6', 'py-4')
         tr.appendChild(td)
         tr.appendChild(td2)
         tr.appendChild(td3)
         tbody.appendChild(tr)

    });
  })
  .catch(error => console.error('Error:', error));

    </script>
</body>
</html>

