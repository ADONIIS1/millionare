
<?php
    require_once("entities/question.class.php");

?>
<?php
    $Question = Questions::List_Question();
  
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AI LÀ TRIỆU PHÚ</title>
    <link rel="icon" href='/images/logo.png' type='image/jpg', sizes='16x16'>
    <link rel="stylesheet" href="css/question.css">
    <link rel="stylesheet" href="css/popup.css">
    <script src="https://kit.fontawesome.com/57045c6330.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=Lato:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <div id="container">
        <header>
            <h1 id="category"></h1>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </header>
        <section>
            <article>
                <div id="questionBoard">
                    <h2 id="countQuestion" style="margin-bottom: -150px;"></h2>
                    <h2 id="question"></h2>
                    <button id="reset">Chơi Lại</button>
                    <div id="lifelines">
                        <button id="callToFriend"><i class="fas fa-phone-alt"></i></button>
                        <button id="questionToTheCrowd"><i class="fas fa-users"></i></button>
                        <button id="halfOnHlf">50:50</button>
                        <div id="tip"></div>
                    </div>
                </div>

                    <div class="popup" id="popup">
                        <img src="https://img.thuthuatphanmem.vn/uploads/2018/09/22/hinh-mat-cuoi-ngo-nghinh-dep_020029140.jpg" alt="">
                        <h2>Chào</h2>
                        <p id="tips">Your details has been successfully submitted. Thanks!</p>
                        <!-- <button type="button" style="background: #ff0000;" onclick="closePopup()">Canel</button> -->
                        <button type="button"  onclick="closePopup()">OK</button>
                    </div>
                
                <div id="answers">
                    <button id="answer1" class="answerButton hoverButton" data-answer="0">A</button>
                    <button id="answer2" class="answerButton hoverButton" data-answer="1">B</button>
                    <button id="answer3" class="answerButton hoverButton" data-answer="2">C</button>
                    <button id="answer4" class="answerButton hoverButton" data-answer="3">D</button>
                </div>
            </article>
            <aside class="hide">
                <div class="closeAside"><i class="fas fa-times"></i></div>
                <div>15.&emsp;&emsp;150.000.000</div>
                <div>14.&emsp;&emsp;85.000.000</div>
                <div>13.&emsp;&emsp;60.000.000</div>
                <div>12.&emsp;&emsp;40.000.000</div>
                <div>11.&emsp;&emsp;30.000.000</div>
                <div class="quaranteed">10.&emsp;&emsp;22.000.000</div>
                <div>9.&emsp;&emsp;14.000.000</div>
                <div>8.&emsp;&emsp;10.000.000</div>
                <div>7.&emsp;&emsp;6.000.000</div>
                <div>6.&emsp;&emsp;3.000.000</div>
                <div class="quaranteed">5.&emsp;&emsp;2.000.000 </div>
                <div>4.&emsp;&emsp;1000.000</div>
                <div>3.&emsp;&emsp;600.000</div>
                <div>2.&emsp;&emsp;400.000</div>
                <div class="current">1.&emsp;&emsp;200.000</div>
                <!-- <button type="submit" class="btn-popup" onclick="openPopup()">Click me</button> -->

            </aside>
        </section>
   
    </div>





    <audio autoplay id="fail"><source src='/audio/fail.mp3'></audio>
    <audio autoplay ><source src='/audio/audience.mp3'></audio>
    <audio autoplay><source src='/audio/Intro.mp3'></audio>
    <audio autoplay><source src='/audio/wrong.mp3'></audio>
    <audio autoplay id="correct"><source src='/audio/correct.mp3'></audio>
    <audio autoplay id="main_theme" ><source src='/audio/main_theme.mp3'></audio>

</body>
</html>
<script>

    let popup = document.getElementById("popup");
    function openPopup(){
        popup.classList.add("open-popup")
    }
    
    function closePopup(){
        popup.classList.remove("open-popup")
        
    }

</script>

<script>

    const question = document.querySelector('#question');
    const countQuestion = document.querySelector('#countQuestion');
    const answer1 = document.querySelector('#answer1');
    const answer2 = document.querySelector('#answer2');
    const answer3 = document.querySelector('#answer3');
    const answer4 = document.querySelector('#answer4');
    const answers = document.querySelectorAll('.answerButton');
    const resetButton = document.querySelector('#reset');
    const h2 = document.querySelector('#question');
    const callFriend = document.querySelector('#callToFriend');
    const halfOnHalf = document.querySelector('#halfOnHlf');
    const questionToTheCrowd = document.querySelector('#questionToTheCrowd');
    const prizeDivs = document.querySelectorAll('aside div');
    let questions= JSON.parse(JSON.stringify(<?php echo json_encode($Question);?>));
    let questionIndex = 0;
    let data ;
    let goodAnswers = 0;
    let chooser = randomNoRepeats(questions); ;
    let counter;
    let counterLine;
    let numberCorrectAnswer;

    


    const showNextQuestion = () => {
        
        
        data = chooser();
        for (const button of answers) {
            button.style.opacity = 1;
        }
        countQuestion.innerText = "Câu "+(goodAnswers+1)+"/15 :   ";
        question.innerText = data.Question;
        answer1.innerText = data.Answer1;
        answer1.setAttribute("onclick", "optionSelected(this)");
        answer2.innerText = data.Answer2;
        answer2.setAttribute("onclick", "optionSelected(this)");
        answer3.innerText = data.Answer3;
        answer3.setAttribute("onclick", "optionSelected(this)");
        answer4.innerText = data.Answer4;
        answer4.setAttribute("onclick", "optionSelected(this)");
    }
    showNextQuestion();


    //if user clicked on option
    function optionSelected(answer){
        document.querySelector('#tip').innerText = "";
        let userAns = answer.textContent;
       
        let correcAns = data.CorrectAnswer;

        
        for (const button of answers) {
            if(button.innerText === data.CorrectAnswer){
                numberCorrectAnswer = button.dataset.answer;
            }
        }
        

        for (const button of answers) {
            button.setAttribute("onclick", "");
            
        }
        console.log(answer.dataset.answer);
        console.log(numberCorrectAnswer);
        if(answer.dataset.answer == numberCorrectAnswer){
                    
            goodAnswers += 1;
            if(goodAnswers == 15){
                
                answer.classList.remove('correctAnswer');
                answer.classList.add('hoverButton');
                h2.innerText = 'Bạn thật Tài Giỏi Bạn là một triệu phú nhận được  150.000.000 Đồng';
                countQuestion.innerText= "";
                resetButton.addEventListener('click', () => {
                    clearPrizeList(goodAnswers)
                    resetGame(data)
                })
                setTimeout(function(){ 
                    resetButton.style.display = 'flex'
                    for (const button of answers) {
                        button.classList.add('hoverButton');
                        button.classList.remove('wrongAnswer');
                        button.classList.remove('correctAnswer');
                    }
                    return;
                }, 2000);
            }else{ 
                if(goodAnswers == 5){
                    
                }
                document.getElementById('correct').play()
                setTimeout(function(){ 
                    answer.classList.remove('correctAnswer');
                    answer.classList.add('hoverButton');
                    showNextQuestion();
                }, 3000);
                preparePrizeList(goodAnswers)
            }
            answer.classList.add('correctAnswer');
            answer.classList.remove('hoverButton');
        }else{
                    
            for (const button of answers) {
                if(button.innerText === data.CorrectAnswer){
                    answer.classList.add('wrongAnswer');
                    answer.classList.remove('hoverButton');
                    button.classList.add('correctAnswer');
                    button.classList.remove('hoverButton');
                    break;
                }
            }
            console.log(document.getElementById('fail').play());
            
            setTimeout(function(){ 
                resetButton.addEventListener('click', () => {
                    clearPrizeList(goodAnswers)
                    resetGame(data)
                })
                showResult(goodAnswers)
            }, 1000);
           
        }
        
    }

    function showResult(goodAnswers){
 
        if (goodAnswers < 5){
                h2.innerText = 'Bạn đen quá hãy chơi lại đi';
                countQuestion.innerText= "";
                
            }
            if (goodAnswers >= 5 && goodAnswers < 10){
                h2.innerText = 'Bạn nhận được 2.000.000 Đồng';
                countQuestion.innerText= "";
            }
            if(goodAnswers >= 10){
                h2.innerText = 'Bạn nhận được 22.000.000 Đồng';
                countQuestion.innerText= "";
            }
          
            setTimeout(function(){ 
                resetButton.style.display = 'flex'
                for (const button of answers) {
                    button.classList.add('hoverButton');
                    button.classList.remove('wrongAnswer');
                    button.classList.remove('correctAnswer');
                }
            }, 2000);
            
            
            return;
    }
    const resetGame = (data) => {
        h2.style.height = '85%';
        callFriend.disabled = false;
        questionToTheCrowd.disabled = false;
        halfOnHalf.disabled = false;
        resetButton.style.display = 'none';
        goodAnswers = 0;
        showNextQuestion();
    }

    const preparePrizeList = (questionIndex) => {
        const currentQuestion = prizeDivs.length;
        if (questionIndex>0) {
          
            prizeDivs[currentQuestion - questionIndex].classList.add('previous');
            prizeDivs[currentQuestion - questionIndex].classList.remove('current');
            if (currentQuestion > questionIndex)
                prizeDivs[currentQuestion - questionIndex -1].classList.add('current');
        }
    }
    const clearPrizeList = (questionIndex) => {
        const length = prizeDivs.length-1;
        prizeDivs[length - questionIndex].classList.remove('current');
        prizeDivs[length].classList.add('current');
        for(let i = length ; i>length-questionIndex ; i--)
            prizeDivs[i].classList.remove('previous')
    }
    function randomNoRepeats(array) {
        var copy = array.slice(0);
        return function() {
            if (copy.length < 1) { copy = array.slice(0); }
            var index = Math.floor(Math.random() * copy.length);
            var item = copy[index];
            copy.splice(index, 1);
            return item;
        };
    }

    const callToFriend = () => {
        const doesFriendKnowAnswer = Math.random() > 0.5;
        console.log(doesFriendKnowAnswer);
       const text = doesFriendKnowAnswer?`Tôi nghĩ đáp án là: ${data.CorrectAnswer}` : `Xin Lỗi, Câu hỏi này khó với tôi quá`;
       console.log(text);

        handleFriendAnswer(text)
    }
    const handleFriendAnswer = (tip) => {
        document.querySelector('#tips').innerText = tip;
        popup.classList.add("open-popup")
        callFriend.disabled = true;
    }

    const halfOnHaldHelp = () => {
        let numberCorrectAnswer;
        for (const button of answers) {
            if(button.innerText === data.CorrectAnswer){
                numberCorrectAnswer = button.dataset.answer;
            }
        }

        let secondOption = Math.floor(Math.random() * 4)
        while (secondOption === Number(numberCorrectAnswer)){
            secondOption = Math.floor(Math.random() * 4)
        }

        const index1 = numberCorrectAnswer;
         const   index2 = secondOption;

        handleHalfOnHalf(index1,index2)
        console.log("numberCorrectAnswer"+numberCorrectAnswer);
        console.log("secondOption"+secondOption);
    }

    const handleHalfOnHalf = (tip,index) => {
        const index1 = tip;
        const index2 = index;
        console.log("numberCorrectAnswer"+index1);
        console.log("secondOption"+index2);
        for (const button of answers) {
            if (Number(button.dataset.answer) != index1 && Number(button.dataset.answer) !== index2) {
                button.style.opacity = 0;
            }
        }
        halfOnHalf.disabled = true
    }


    const questionToTheCrowdHelp = () => {

     
        const chart = [10, 20, 30, 40];

        for (let i = chart.length-1 ; i>0 ; i--){
            const changeRate = Math.floor(Math.random()*20 - 10);
            chart[i] += changeRate;
            chart[i - 1] -= changeRate;
        };

        
        for (const button of answers) {
            if(button.innerText === data.CorrectAnswer){
                numberCorrectAnswer = button.dataset.answer;
            }
        }
        [chart[3], chart[numberCorrectAnswer]] = [chart[numberCorrectAnswer], chart[3]];
        
        handleQuestionToTheCrowd(chart)

    }

    const handleQuestionToTheCrowd = (tip) => {
        for (const button of answers) {
            button.innerText += ` (${tip[button.dataset.answer]}%)`
        }
        questionToTheCrowd.disabled = true;
    }


    callFriend.addEventListener('click', callToFriend);
    halfOnHalf.addEventListener('click', halfOnHaldHelp);
    questionToTheCrowd.addEventListener('click', questionToTheCrowdHelp)
</script>