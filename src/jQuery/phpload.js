function phpLoad() {
    
    var container = $('#res');
    
    //ar $this = $(this),
    //target = $this.data('target');
    
    //Load target page into container
    container.load('testresult.php');
            
    //Stop normal link behavior
    return false;

};


