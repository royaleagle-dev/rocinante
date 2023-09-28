<!DOCTYPE html>
<html>
    <head>
        <title>Aviator Clone</title>
        <link rel="stylesheet" href="/css/tail-output.css">
        <link rel="stylesheet" href="/vendor/iziToast/dist/css/iziToast.min.css">
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body class="bg-gray-200">

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

        <section class="md:flex justify-center p-5 gap-[3%]">
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
                //console.log(stake1PotentialWin);
                stakeBtn1.classList.remove('hidden');
                cashoutBtn1.classList.add('hidden');
                cashout1_status = true;
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
                        //stakeBtn1.classList.remove('bg-red-700');
                        //stakeBtn1.classList.remove('hover:bg-red-500');
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
                            1, 1, 1, 1, 1, 1, 1, 1, 1,
                        ];
                        randomNumber = randomNumber[Math.floor(Math.random() * randomNumber.length)]
                        //console.log(randomNumber);
                        let timer = setInterval(function(){
                            multiplierText.textContent = (Number(multiplierText.textContent) + 0.01).toFixed(2)
                            cashoutPotential1.textContent = (Number(elem * multiplierText.textContent)).toFixed(2)
                            stake1PotentialWin = cashoutPotential1.textContent
                            roundOngoing = "Start";
                            flyingPlane.classList.remove('hidden');
                            //console.log(multiplierText.textContent);
                            if(randomNumber == Number(multiplierText.textContent)){
                                console.log(stake1PotentialWin);
                                roundOngoing = "End";
                                flyingPlane.classList.add('hidden');
                                stopGeneration();
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

                        }, 10)
                    }

                    }, 3000)

                    //display loading animation and wait.
                }
                
            }

            function stake2(inputElement){
                if(stake2_status === true){
                    stakeBtn2.classList.add('bg-red-700');
                    stakeBtn2.classList.add('hover:bg-red-500');
                    stakeBtn2.classList.remove('bg-yellow-700');
                    return false;
                }
                const elem = document.getElementById(inputElement).value
                //console.log(elem);
                stakeBtn2.classList.remove('bg-red-700');
                stakeBtn2.classList.remove('hover:bg-red-500');
                stakeBtn2.classList.add('bg-yellow-700')
                stake2_status = true;
            }

        </script>

    </body>
</html>