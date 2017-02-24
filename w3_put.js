$(document).ready(function(){
    $("#btnUpdate").click(function(){
        var staff=new Staff($("#lastName").val(),$("#firstName").val(), $("#campus").val());
        
        $.ajax({
            type: 'PUT',
            dataType: "json",
            url: "api.php/staffs/5",
            data: JSON.stringify(staff),
            success: showResponse,
            error: showError   
        });
        
        console.log(JSON.stringify(staff));
    });
    
});

function Staff(lastName, firstName, campus){
//    this.Staff_Id=id;  
    this.LastName=lastName;
    this.FirstName=firstName;
    this.Campus=campus;
}

function showResponse(responseData){
//    console.log(responseData);
}

function showError(e){
    console.log(e);
    alert("Sorry, there was a problem trying to update staff!");
}


$(document).ready(function(){
    $("#btnUpdate").click(function(){
        alert("Successfully Updated!");
    });
});