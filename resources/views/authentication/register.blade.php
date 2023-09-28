<!DOCTYPE html>
<html style="height:100%;">
    <head>
        <title>Aviator Clone</title>
        <link rel="stylesheet" href="/css/tail-output.css">
        <link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body style="margin:0;padding:0;background: linear-gradient(180deg, rgb(0 0 0 / 73%), rgb(0 0 0)), url(/img/av_bg2.gif); background-size:cover;background-repeat:no-repeat;height:100vh;">
    

        <section class = "py-20 flex items-center justify-center" style="">
            <div class="text-white rounded-lg" style="width:30%;background:transparent;background-filter:blur(100px);padding:1%;border: 2px solid white;">
                <form class="" id="loginForm">
                        <div>
                            <h1 class="text-2xl">Registration</h1>
                            <div class="mt-5">
                                <span class="text-sm bg-green-700 text-white p-2" style="font-size:0.7rem;">Fill in the Forms Below</span>
                            </div>
                        </div>
                        <div class="mb-4 mt-10">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <input type="submit" class="bg-green-900 w-full py-3 px-5 text-white hover:bg-green-700" required value="Sign In">
                        </div>
                    </form>

            </div>
        </section>

        <script src="/vendor/iziToast/dist/js/iziToast.min.js"></script>
        <script src="/vendor/jquery-3.6.3.min.js"></script>

        <script>
            $("#loginForm").submit(function(e){
                e.preventDefault();
                const url = "{{ route('registerProcessor') }}";
                const data = {
                    'username': $("#username").val(),
                    'email': $("#email").val(),
                    'password': $("#password").val(),
                    '_token': "{{ csrf_token() }}"
                }
                $.post(url, data, function(response){
                    if(response.status == 'success'){
                        iziToast.show({
                            title: response.message, 
                            backgroundColor: response.color,
                            titleColor: 'white',
                            messageColor: 'white',
                            position: 'bottomCenter',
                        });
                        setTimeout(function(){
                            window.location = "{{ route('login') }}"
                        }, 3000)
                    }
                })
            })
        </script>

    </body>
</html>