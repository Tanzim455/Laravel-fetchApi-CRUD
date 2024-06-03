

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
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
                    Action
                 </th>
                 
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be dynamically added here -->
           
        </tbody>
    <script>
//    

$(document).ready(function () {
     fetchProducts();
    function fetchProducts(){
    $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/products",
                dataType: "json",
                
                success: function (response) {
                    $('tbody').html("");
                    $.each(response, function (key, item) {
                        
                        $('tbody').append('<tr>\
                       <td>' + item.id + '</td>\
                       <td>' + item.title + '</td>\
                      <td>' + item.description+ '</td>\
                      <td><button value="' + item.id + '" class="dltButton">Delete</button> <button value="' + item.id + '" class="editButton">Edit</button></td>\
                      \</tr>');
                      $('td').addClass('px-6 py-4');
                      $('.dltButton').addClass('focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900');
                      $('.editButton').addClass('edit-btn text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700');

                     

                    })
                }
});
    }
    
$(document).on('click', '.dltButton', function (e){
    e.preventDefault();
    let deleteId= $('.dltButton').val();
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "http://127.0.0.1:8000/products/" + deleteId,
                dataType: "json",
                success: function (response) {
                    
                    $('.successmessage').text(response.message);
                    $('.successmessage').addClass()

                    $('.successmessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400');

                    fetchProducts();
                        
                }
                });
    

                     

})


$(document).on('click', '.editButton', function (e){
    e.preventDefault();
    let editId= $(this).val();
    
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/products/" + editId,
                
                success: function (response) {
                    
                    window.location.href=`http://127.0.0.1:8000/products/${editId}/edit`
                        
                }
                });
    
                
                     

});

            

            
})







  
    </script>
</body>
</html>

