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

        <section class="content md:flex justify-center p-1 gap-[3%]">
            <div class="md:w-2/5 p-10 rounded-xl">
                <h3 class="text-center text-xl mb-3 text-white">Previous Rounds</h3>
                <div class="">
                    <div id="loadPrevRounds">
                    </div>
                </div>
            </div>
            <div class="md:w-3/5 rounded-xl" style = "min-height: 100vh;">
                <div class="text-center w-full p-5 py-10 rounded-lg text-white" style="background:transparent;">
                    <div style = "position: absolute;z-index:1;opacity:0.5;" class="hidden" id="flyingPlane">
                        <img src="/img/plane.png" style = "width:15%;height:auto;filter:invert(100%); animation: animate_plane 25s ease-in-out infinite">
                    </div>
                    <div style = "z-index:100;position:relative;">
                        <p id="roundStatus">Starting Round</p>
                        <h3 class="text-2xl">Flew Away At</h3>
                        <h1 class="font-bold" style="font-size:100px"><span id="multiplierText">0.00</span><span>x</span></h1>
                        <div class="md:flex gap-5 justify-center">
                            <div>
                                <input type="number" min="10" max="10000" value="10" id="input1" class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                                <button id="stakeBtn1" class="text-white text-center font-bold py-2 px-8 bg-red-700 w-60 hover:bg-red-500 rounded-lg" onclick="stake1('input1')">
                                    STAKE
                                    <div class="flex items-center justify-center gap-2 mt-2">
                                        <img src="/img/coin_single.png" style="width: 20%;height:auto">
                                        <div class="text-xl">
                                            <span id="stake1-potential" class="text-center">10</span>
                                        </div>
                                    </div>     
                                </button>
                                <button id="cashoutBtn1" class="hidden text-white text-center w-60 font-bold py-2 px-8 bg-orange-700 rounded-lg" onclick="cashout1()">
                                    CASHOUT
                                    <div class="flex items-center justify-center gap-2 mt-2">
                                        <img src="/img/coin_single.png" style="width: 20%;height:auto">
                                        <div class="text-xl">
                                            <span id="cashoutPotential1" class="text-center"></span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="mt-10 hidden text-center" id="loadingRound">
                            <h5 class="mb-3">Loading...</h5>
                            <div class="w-full bg-red-500 h-2" style="animation: loading 3s ease-in-out infinite">
                            </div>
                        </div>

                    </div>
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
        <script>
            const stakeBtn1 = document.querySelector("#stakeBtn1");
            const stakeBtn2 = document.querySelector("#stakeBtn2");
            const stake1Potential = document.querySelector("#stake1-potential");
            const cashoutBtn1 = document.querySelector("#cashoutBtn1");
            const cashoutPotential1 = document.querySelector("#cashoutPotential1");
            const roundStatus = document.querySelector("#roundStatus");
            const flyingPlane = document.querySelector("#flyingPlane");
            const loadingRound = document.querySelector("#loadingRound");
            let roundCode = '';
            let fRandomNumber = '';
            let userBalance = document.querySelector("#userBalance");
            //console.log(cashoutPotential1)
            //console.log(stake1Potential)

            stake1Potential.textContent = document.querySelector("#input1").value
            document.querySelector("#input1").onchange = function(){
                stake1Potential.textContent = document.querySelector("#input1").value;
            }

            let stake1PotentialWin = 0;
            let roundOngoing = "End";
            let stake1_status = false;
            let stake2_status = false;
            let cashout1_status = false;
            const multiplierText = document.querySelector("#multiplierText");
            let win_stake = false;

            
            const generateRandom_under100 = () => (Math.floor((Math.random() * 1000)/10) + Math.random()).toFixed(2);
            const generateRandom_under10 = () => (Math.floor((Math.random() * 10)) + Math.random()).toFixed(2);
            const generateRandom_over100  = () => (Math.floor((Math.random() * 1000)) + Math.random()).toFixed(2);

            setInterval(function(){
                if(cashout1_status === true && roundOngoing == 'Start'){
                    roundStatus.textContent = "Cashed Out, Round In Progress";
                    stakeBtn1.disabled = true;
                    stakeBtn1.style.cursor = "not-allowed";
                
                }else if(cashout1_status === true && roundOngoing == 'End'){
                    roundStatus.textContent = "Cashed Out, End of Round";
                    cashout1_status = false;
                    stakeBtn1.disabled = false;
                    stakeBtn1.style.cursor = 'pointer';
                }else if(cashout1_status === false && roundOngoing === "Start"){
                    roundStatus.textContent = "Round In Progress";
                }else if(roundOngoing === "End" && multiplierText.textContent == "0.00"){
                    roundStatus.textContent = "Stating Round";
                }else{
                    roundStatus.textContent = "End of Round";
                }
            }, 10)

            function cashout1(){
                stakeBtn1.classList.remove('hidden');
                cashoutBtn1.classList.add('hidden');
                cashout1_status = true;
                win_stake = true;

                //add to balance
                userBalance.textContent = (Number(userBalance.textContent) + Number(stake1PotentialWin)).toFixed(2)

                //record to the database
                const logRound = fetch("{{ route('logRound') }}", {
                    method: "POST",
                    body: JSON.stringify({
                        'stake': stake1Potential.textContent,
                        'win_status': win_stake,
                        'multiplier': multiplierText.textContent,
                        'exp_multiplier': fRandomNumber,
                        'amount':stake1PotentialWin,
                        'code': roundCode,
                        '_token': "{{ csrf_token() }}",
                        'balance': userBalance.textContent,
                    }),
                    headers: {
                        "Content-type": "application/json",
                    },
                }).then(response => {
                    return response.json();
                }).then(json => {
                    console.log(json);
                });
                //end recording;

                iziToast.show({
                    title: `Cashed Out ${stake1PotentialWin} at ${multiplierText.textContent}x`,
                    backgroundColor: 'green',
                    titleColor: 'white',
                    messageColor: 'white',
                    position: 'topCenter',
                });
            }

            function stake1(inputElement){
                if(Number($("#input1").val()) > Number(userBalance.textContent)){

iziToast.show({
    title: `Insufficient Balance`,
    backgroundColor: 'orange',
    titleColor: 'white',
    messageColor: 'white',
    position: 'topCenter',
});

return false;

}
                if(stake1_status === true){
                    stakeBtn1.classList.add('bg-red-700');
                    stakeBtn1.classList.add('hover:bg-red-500');
                    stakeBtn1.classList.remove('bg-yellow-700');
                    stake1_status = false;
                }else{
                    loadingRound.classList.remove('hidden');
                    stakeBtn1.style.cursor = 'not-allowed';
                    setTimeout(function(){
                        loadingRound.classList.add('hidden');
                        const elem = document.getElementById(inputElement).value
                        //console.log(elem);
                        stakeBtn1.classList.add('hidden');
                        cashoutBtn1.classList.remove('hidden');
                        stake1_status = true;
                        //roundOngoing = true;
                        multiplierText.textContent = "0.00"
                        let randomNumber = [
                            generateRandom_under100(), 
                            generateRandom_over100(),
                            Math.random().toFixed(2),
                            generateRandom_under10(),
                            generateRandom_under10(), 
                            generateRandom_under10(),
                            generateRandom_under10(),
                            generateRandom_under10(),
                            generateRandom_under10(),
                            generateRandom_under10(),
                            generateRandom_under10(),
                            generateRandom_under10(),
                            generateRandom_under10(),  
                            1, 1, 1, 1, 1, 1, 1, 1, 1, 1
                        ];
                        
                        //fetch Round Code
                        const fetchRound = fetch("{{ route('roundCode') }}")
                        .then(response => { return response.json()})
                        .then(json => {
                            roundCode = json.data;
                            console.log(roundCode);
                        });

                        userBalance.textContent = (userBalance.textContent - $("#input1").val()).toFixed(2);



                        randomNumber = randomNumber[Math.floor(Math.random() * randomNumber.length)]
                        fRandomNumber = randomNumber;
                        console.log(randomNumber); //multiplier
                        let timer = setInterval(function(){
                            multiplierText.textContent = (Number(multiplierText.textContent) + 0.01).toFixed(2)
                            cashoutPotential1.textContent = (Number(elem * multiplierText.textContent)).toFixed(2)
                            stake1PotentialWin = cashoutPotential1.textContent
                            roundOngoing = "Start";
                            flyingPlane.classList.remove('hidden');
                            //console.log(multiplierText.textContent);
                            if(randomNumber == Number(multiplierText.textContent)){
                                
                                console.log(stake1PotentialWin); //potentialwin
                                console.log(`Flew Away At ${randomNumber}`); //total multiplier
                                console.log(`Win? ${win_stake}`); //win/loss

                                //record to the database
                const logRound = fetch("{{ route('logRound') }}", {
                    method: "POST",
                    body: JSON.stringify({
                        'stake': stake1Potential.textContent,
                        'win_status': win_stake,
                        'multiplier': multiplierText.textContent,
                        'exp_multiplier': fRandomNumber,
                        'amount':stake1PotentialWin,
                        'code': roundCode,
                        '_token': "{{ csrf_token() }}",
                        'balance': userBalance.textContent,
                    }),
                    headers: {
                        "Content-type": "application/json",
                    },
                }).then(response => {
                    return response.json();
                }).then(json => {
                    console.log(json);
                });
                //end recording;
                                
                                roundOngoing = "End";
                                flyingPlane.classList.add('hidden');
                                stopGeneration();
                                win_stake = false;
                            }
                        }, 10)

                        function stopGeneration(){
                        clearInterval(timer);
                        //cashoutBtn1.disabled=true;
                        //cashoutBtn1.style.cursor = 'not-allowed';
                        setTimeout(function(){
                            //stake1Potential.textContent = 0.00
                            stakeBtn1.style.cursor = 'pointer';
                            stakeBtn1.classList.remove('hidden');
                            cashoutBtn1.classList.add('hidden');
                            stake1_status=false;
                            iziToast.show({
                                title: `Flew Away at ${multiplierText.textContent}x`,
                                backgroundColor: 'red',
                                titleColor: 'white',
                                messageColor: 'white',
                                position: 'topCenter',
                            });
                            $("#loadPrevRounds").load("{{ route('loadPrevRounds') }}")

                        }, 10)
                    }

                    }, 3000)

                    //display loading animation and wait.
                }
                
            }
        </script>
        <script>
            setInterval(function(){
                $("#loadWinnings").load("{{ route('loadWinnings') }}")
            }, 1000);
        </script>

    </body>
</html>