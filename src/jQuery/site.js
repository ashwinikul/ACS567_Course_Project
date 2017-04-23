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


//Function for submitting custom Questionaire
function submitAsses(str) {
    
    var options = new Array();
    
    var testname = document.getElementById("txtAssessName").value;
    var questdesc = document.getElementById("txtEnterQ").value;
    var ansoption = document.getElementsByClassName("options");
    var selections = document.getElementsByClassName("selection");
    var correctAnswer = "";
    
        for(var i = 0; i < ansoption.length; i++)
        {
            options.push(ansoption.item(i).value);
            if(selections[i].checked) {
                correctAnswer = ansoption.item(i).value;
            }
            else {
                alert("Choose a radio button that represents a correct choice");
                event.preventdefault();
            }
        }

    var control = document.getElementById("styled");
    
    if (control.value == '' || control.value== null) {
        alert("Enter value for all fields!!");
        event.preventdefault();
    }
    
    else {
        var str = "testname="+testname+"&questdesc="+ questdesc + "&options=" + options+"&correctAnswer="+correctAnswer;
        chkAssessName(str);
       //alert("Values saved to DB!!");
      // alert("Proceed to add more questions!!");
       document.getElementById("txtEnterQ").value = "";
        event.preventdefault();
    }
}

//AJAX Call for checking if the Testname already exists in DB 

// Reusing AJAX for submitting values to DB

var xmlhttp = null;
function chkAssessName(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        
        if(!str.includes("options")) {
            var str = "testname="+str;
        }

        xmlhttp.open("POST","getassessName.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Content-length", str.length);
        xmlhttp.setRequestHeader("Connection", "close");
        xmlhttp.send(str);
}
}
