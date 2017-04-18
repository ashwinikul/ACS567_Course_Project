/* 
	Developer: Sindhu Balakrishnan
	Description: Javascript/jQuery script file for MBTI and Custom Questionaire. 

*/
var i=0;
$(".tagline").click(function() {
    
    var container = $('#content1');
    
    var $this = $(this),
    target = $this.data('target');
    
    //Load target page into container
    container.load(target + '.php');
            
    //Stop normal link behavior
    return false;

});

$(".toggle").click(function() {
    alert("Sucess");
});


var ansCnt=0;

function answeredCounter() {
    ansCnt++;
    if(ansCnt>=42){
         document.getElementById("button").disabled="";
    }
    else{
        document.getElementById("button").disabled="disabled";
    }
}

function nextButton(m) {
        $("#set"+m).slideDown();
        $("#next"+m).slideDown();
}

function hideSet(n) {
        $("#set"+n).hide();
        $("#next"+n).hide();
}

function disableSubmit() {
        document.getElementById("button").disabled="disabled";
}

function createQuestion() {
   $("#createQ").show();

}

$(".chosen-select").change(function(){
    var optionCount = $(this).val().charAt(0);
    var binddiv = $(this).next("div.bind-answer");
    
    binddiv.empty();
    for (i=1; i <= optionCount; i++) {
        var txt1 = "<br><br>";               // Create element with HTML  
        var txt2 = "<textarea id='styled' name='styled"+i+"' placeholder='Enter answer choice "+i+"' style='height: 20px;' />"; 
        binddiv.append(txt1,txt2);
    }
    i=1;
});
