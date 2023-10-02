<!DOCTYPE html>
<html>
    <head>
        <title>Aviator Clone</title>
        <link rel="stylesheet" href="/css/tail-output.css">
        <link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body style="background: linear-gradient(180deg, rgb(0 0 0 / 73%), rgb(0 0 0)), url(/img/av_bg_3.gif); background-size:cover;background-repeat:no-repeat">

        <section class="flex items-center justify-around p-4 text-white" style="background:transparent;">
            <p>Aviator Clone</p>
            <div class="flex items-center justify-between gap-10">
                <a href="">Home</a>
                <a href="{{ route('logout') }}">Logout</a>
                <a href="" id="userBalance" style="font-weight:bold">{{ Auth::user()->balance }}</a>
            </div>
        </section>

        <!--
        <section class="hero md:flex items-center justify-around bg-red-800 p-5 mb-3 mt-3">
            <div class="text-xl text-white">
                <h3>Highest Win</h3>
                <p>User #1104</p>
            </div>
            <div class="text-xl text-white">
                <h3>Top Players</h3>
                <p>Ayotunde, July Mao, Openheimer</p>
            </div>
        </section>
        -->

        <section class="content md:flex justify-center p-1 gap-[3%] mt-5">
            <div class="md:w-2/5 p-10 rounded-xl">
                <h3 class="text-center text-xl mb-3 text-white">Previous Rounds</h3>
                <div class="">
                    <div id="loadPrevRounds">
                    </div>
                </div>
            </div>

            <div class="md:w-3/5 rounded-xl" style = "min-height: 100vh;">
                <div class="w-full p-5 py-10 rounded-lg text-white" style="background:rgba(0, 255, 0, 0.1);backdrop-filter:blur(100px);backdrop-filter: invert(20%)">
                <form id="depositForm">
                    <h3 class="text-2xl mb-6">Fund Your Account</h3>
  <div class="relative z-0 w-full mb-6 group">
      <input type="number" name="floating_email" id="depositAmount" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none dark:text-white dark:border-gray-600 dark:focus:border-yellow-500 focus:outline-none focus:ring-0 focus:border-yellow-300 peer" placeholder=" " required />
      <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6" min="1000" max="10000">Amount</label>
      <p class="text-sm mt-3 text-gray-400">Minimum: NGN100 Maximum: NGN100000</p>
  </div>
  <button type="submit" class="text-white bg-green700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add Funds</button>
</form>
                </div>
            </div>

            <div class="md:w-2/5 rounded-xl p-10">
                <h3 class="text-center text-xl mb-3 text-white">Winnings</h3>
                <div id="loadWinnings">
                </div>
            </div>
        </section>

        <script src="/vendor/iziToast/dist/js/iziToast.min.js"></script>
        <script src="/vendor/jquery-3.6.3.min.js"></script>
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <script>

            const paymentForm = document.getElementById('depositForm');
            paymentForm.addEventListener("submit", payWithPaystack, false);

            function payWithPaystack(e){
                e.preventDefault();
                const amount = Number($("#depositAmount").val())
                if(amount < 1 || amount > 100000){
                    iziToast.show({
                        title: `Invalid Amount. (Minimum of 500 and Maximum of 1000)`,
                        backgroundColor: 'orangered',
                        titleColor: 'white',
                        messageColor: 'white',
                        position: 'bottomCenter',
                    });
                }else{
                    //amount is in valid range
                    const fetchPaymentCode = fetch("{{ route('roundCode') }}")
                    .then(response => { return response.json()})
                    .then(json => {
                        paymentCode = json.data;

                        let handler = PaystackPop.setup({
                    key: 'pk_test_74f8905d054f97b79b99c168f6b532e75218bccd', // Replace with your public key
                    email: "{{ $userEmail }}",
                    amount: document.getElementById("depositAmount").value * 100,
                    //ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    ref: paymentCode,
                    // label: "Optional string that replaces customer email"
                    onClose: function(){
                        alert('Window closed.');
                    },
                    callback: function(response){
                        let message = 'Payment complete! Reference: ' + response.reference;
                        alert(message);
                        const url = "{{ route('payment.verifyDeposit') }}";
                        const data = {
                            reference: paymentCode,
                            _token: "{{ csrf_token() }}"
                        }      
                    
                        $.post(url, data, function(response){
                            if(response.status == 'success'){
                                iziToast.show({
                                    title: response.status,
                                    message: response.message,
                                    backgroundColor: response.color,
                                    titleColor: 'white',
                                    messageColor: 'white',
                                    position: 'bottomCenter',
                                })                    
                                setTimeout(function(){
                                    window.location = "{{ route('index') }}";
                                }, 2000);
                            }else{
                                iziToast.show({
                                    title: response.status,
                                    message: response.message,
                                    backgroundColor: response.color,
                                    titleColor: 'white',
                                    messageColor: 'white',
                                    position: 'bottomCenter',
                                })
                            }
                        })
                    }
                });
                handler.openIframe();
                            
                            
                    });                    
                }
            
            }

        </script>
    </body>
</html>