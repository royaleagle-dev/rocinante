<!DOCTYPE html>
<html>
    <head>
        <title>Aviator Clone</title>
        <link rel="stylesheet" href="/css/tail-output.css">
        <link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body style="background-image: url('/img/av_bg.gif');background-size:cover;background-repeat:no-repeat">

        <section class="flex items-center justify-around bg-blue-900 p-4 text-white">
            <p>Aviator Clone</p>
            <div class="flex items-center justify-between gap-10">
                <a href="">Home</a>
                <a href="">Logout</a>
                <a href="">15000p</a>
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

        <section class="content md:flex justify-center p-3 gap-[3%]">
            <div class="md:w-2/5 p-10 bg-white rounded-xl">
                <h3 class="text-center text-xl mb-2">Previous Rounds</h3>
                <div class="">
                    <div id="loadWinnings">
                    </div>
                </div>
            </div>
            <div class="md:w-3/5 bg-blue-900 rounded-xl" style = "min-height: 100vh;">
                <div class="text-center w-full p-5 py-10 rounded-lg text-white" style="min-height: 50%;background: linear-gradient(180deg, rgba(7,4,123,0.3), rgba(5,34,101,2.3)), url('/img/av_bg_1.jpg')">
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

            <div class="md:w-2/5 bg-white rounded-xl p-10">
                <h3 class="text-center text-xl mb-3">Highest Multipliers</h3>
                <div class="text-white">
                    <div class="p-3 bg-blue-500 md:flex items-center justify-around mb-3 rounded-md">
                        <div>
                            <span class="text-sm block">Multiplier</span>
                            <strong>12000</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Time</span>
                            <strong>12:09PM</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Status</span>
                            <strong>Won</strong>
                        </div>
                    </div>
                    <div class="p-3 bg-blue-500 md:flex items-center justify-around mb-3 rounded-md">
                        <div>
                            <span class="text-sm block">Multiplier</span>
                            <strong>156</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Time</span>
                            <strong>12:09PM</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Status</span>
                            <strong>Lost</strong>
                        </div>
                    </div>
                    <div class="p-3 bg-blue-500 md:flex items-center justify-around mb-3 rounded-md">
                        <div>
                            <span class="text-sm block">Multiplier</span>
                            <strong>20</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Time</span>
                            <strong>12:08PM</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Status</span>
                            <strong>Won</strong>
                        </div>
                    </div>
                    <div class="p-3 bg-blue-500 md:flex items-center justify-around mb-3 rounded-md">
                        <div>
                            <span class="text-sm block">Multiplier</span>
                            <strong>6.89</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Time</span>
                            <strong>12:09PM</strong>
                        </div>
                        <div>
                            <span class="text-sm block">Status</span>
                            <strong>Won</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="/vendor/iziToast/dist/js/iziToast.min.js">
        </script>
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
            //console.log(cashoutPotential1)
            //console.log(stake1Potential)

            stake1Potential.textContnt = document.querySelector("#input1").value
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
                        '_token': "{{ csrf_token() }}"
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
                        '_token': "{{ csrf_token() }}"
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
                            $("#loadWinnings").load("{{ route('loadWinnings') }}")

                        }, 10)
                    }

                    }, 3000)

                    //display loading animation and wait.
                }
                
            }
        </script>
        <script src="/vendor/jquery-3.6.3.min.js"></script>

    </body>
</html>