

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



async function fetchallProducts() {
    let products = await fetch('http://127.0.0.1:8000/products');
    let data = await products.json();
    console.log(data);
  
    let tbody = document.querySelector('tbody');
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let rows = '';

    data.forEach(d => {
        rows += `
            <tr>
                <td class="px-6 py-4">${d.id}</td>
                <td class="px-6 py-4">${d.title}</td>
                <td class="px-6 py-4">${d.description}</td>
                <td>
                    <button class="dlt-button focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" data-id="${d.id}">Delete</button>
                    <button class="edit-btn text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" data-id="${d.id}">Edit</button>
                </td>
            </tr>
        `;
    });

    tbody.innerHTML = rows;

    document.querySelectorAll('.dlt-button').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = button.getAttribute('data-id');
            let response = await fetch(`http://127.0.0.1:8000/products/${id}`, {
                method: "DELETE",
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            let deleteData = await response.json();
            let successmessage = document.querySelector('.successmessage');
            successmessage.textContent = `${deleteData.message}`;
            successmessage.classList.add('p-4', 'mb-4', 'text-sm', 'text-green-800', 'rounded-lg', 'bg-green-50', 'dark:bg-gray-800', 'dark:text-green-400');

            button.closest('tr').remove();
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const id = button.getAttribute('data-id');
            window.location.href = `http://127.0.0.1:8000/products/${id}/edit`;
        });
    });
}



    
fetchallProducts();
 

  





  
    </script>
</body>
</html>

