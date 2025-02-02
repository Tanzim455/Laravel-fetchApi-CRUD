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
                    <th class="py-2 px-4 border-b">Id</th>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Price</th>
                </tr>
            </thead>
            <tbody class="tbody">
            </tbody>
        </table>
        <div class="pagination-links mt-4"></div>
    </div>
    <script>
        let product_tbody = document.querySelector('.tbody');
        let pagination_links = document.querySelector('.pagination-links');

        async function fetchProducts(url) {
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async function displayProducts(url) {
            let productsJson = await fetchProducts(url);
            product_tbody.innerHTML = ''; // Clear previous content
            productsJson.data.forEach(product => {
                product_tbody.innerHTML += `
                <tr>
                    <td class="py-2 px-4 border-b">${product.id}</td>
                    <td class="py-2 px-4 border-b">${product.title}</td>
                    <td class="py-2 px-4 border-b">${product.description}</td>
                    <td class="py-2 px-4 border-b">${product.price}</td>
                </tr>
                `;
            });
            displayPagination(productsJson.links);
        }

        function displayPagination(links) {
            pagination_links.innerHTML = ''; // Clear previous links
            links.forEach(link => {
                pagination_links.innerHTML += `
                <a href="${link.url}" class="pagination-anchors cursor-pointer text-blue-500 hover:text-blue-700 font-bold py-2 px-4">${link.label}</a>
                `;
            });
        }

        pagination_links.addEventListener('click', function(e) {
            if (e.target.classList.contains('pagination-anchors')) {
                e.preventDefault();
                let url = e.target.getAttribute('href');
                displayProducts(url);
            }
        });

        // Initial fetch
        displayProducts('http://127.0.0.1:8000/productsJson');
    </script>
</body>
</html>
