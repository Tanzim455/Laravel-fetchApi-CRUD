<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
   $(document).ready(function () {
    $(document).on('submit', '.form', function (e) {
          e.preventDefault();
          var data = {
                'title': $('.title').val(),
                'description': $('.description').val(),
                'price': $('.price').val(),
                
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/products/store",
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    console.log(response);
                    if (response.status == 400) {
                      if(response.errors.title){
                        $('.errortitlemessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400');
                        $('.errortitlemessage').text(response.errors.title[1]);
                      }
                      if(response.errors.description){
                        $('.errordescriptionmessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400');
                        $('.errordescriptionmessage').text(response.errors.description[1]);
                      }
                      if(response.errors.price){
                        $('.errorpricemessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400');
                        $('.errorpricemessage').text(response.errors.price[0]);
                      }
                       if(response.errors.title && response.errors.description && response.errors.price){
                        $('.errortitlemessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400');
                      $('.errordescriptionmessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400');
                      $('.errorpricemessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400');
                      $('.errortitlemessage').text(response.errors.title[1]);
                      $('.errordescriptionmessage').text(response.errors.description[1]);
                      $('.errorpricemessage').text(response.errors.price[0])
                       }
                      
                    } 
                    if(response.status==200){
                      $('.successmessage').addClass('p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400');
                      $('.successmessage').text(response.message);
                      $('.title').val('');
                      $('.description').val('');
                      $('.price').val('')

                    }
                }
            });
    });


   });
   
</script>
</body>
</html>