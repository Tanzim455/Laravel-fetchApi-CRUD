<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developers Table</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Developers Table</h1>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Price</th>
               
                </tr>
            </thead>
            <tbody class="tbody">
               
                    
            </tbody>
           
        </table>
        <div class="pagination-links"></div>
    </div>
    <script>
        let product_tbody=document.querySelector('.tbody');
        let pagination_links=document.querySelector('.pagination-links');
        async function fetchallProducts() {
    let products = await fetch('http://127.0.0.1:8000/productsJson');
    let productsJson = await products.json();
      console.log(productsJson.data);
      console.log(productsJson.links);
      product_tbody.innerHTML='';
    productsJson.data.forEach(product => {
        console.log(product.title);
        
        product_tbody.innerHTML+=`
        <tr>
        <td>${product.title}</td>
        <td>${product.description}</td>
        <td>${product.price}</td>
        </tr>
        `
    });
        }
      
        async function fetchPaginatedProducts() {
            let products = await fetch('http://127.0.0.1:8000/productsJson');
    let productsJsonPaginate = await products.json();
    pagination_links.innerHTML='';
    productsJsonPaginate.links.forEach(link=>{
        pagination_links.innerHTML+=
        `<a href="${link.url}" class="pagination-anchors cursor-pointer text-blue-500 hover:text-blue-700 font-bold py-2 px-4">${link.label}</a>`
    });
        let pagination_anchors=document.querySelectorAll('.pagination-anchors');

        pagination_anchors.forEach(a=>{
            a.addEventListener('click',function(e){
                e.preventDefault();
                 console.log("Anchor clicked");
                 const linkAttribute=a.getAttribute('href');
                 async function pagninatedroduct(){
                    let paginated_product = await fetch(`${linkAttribute}`)
                   let paginatedJson=await paginated_product.json();
                   paginatedJson.data.forEach(product => {
        console.log(product.title);
        
        product_tbody.innerHTML=`
        <tr>
        <td>${product.title}</td>
        <td>${product.description}</td>
        <td>${product.price}</td>
        </tr>
        `
    });
                   
                 }

                 pagninatedroduct();
                 
            })
        })
        }
        fetchallProducts();
        fetchPaginatedProducts();
    </script>
</body>
</html>
