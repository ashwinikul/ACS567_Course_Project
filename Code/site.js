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
    if(ansCnt>=2){
         document.getElementById("button").disabled="";
    }
    else{
        document.getElementById("button").disabled="disabled";
    }
}

function nextButton(m) {
        $("#set"+m).show();
        $("#next"+m).show();
}

function hideSet(n) {
        $("#set"+n).hide();
        $("#next"+n).hide();
}

function disableSubmit() {
        document.getElementById("button").disabled="disabled";
}