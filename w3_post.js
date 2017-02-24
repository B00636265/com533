$(document).ready(function(){
    $("#btnSave").click(function(){
        var staff=new Staff($("#firstName").val(),
                            $("#lastName").val(),
                            $("#campus").val());
        
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "api.php/staffs",
            data: JSON.stringify(staff),
            success: showResponse,
            error: showError   
        });
    });
    
});

function Staff(firstName, lastName, campus){
    this.firstname=firstName;
    this.lastname=lastName;
    this.campus=campus;
}

function showResponse(responseData){
    console.log(responseData);
}

function showError(){
    alert("Sorry, there was a problem trying to add new staff!");
}


$(document).ready(function(){
    $("#btnSave").click(function(){
        alert("Successfully Added!");
    });
});