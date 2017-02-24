$(document).ready(function(){
    $.ajax({
        type: 'GET',
        dataType: "json",
        url: "api.php/staffs/1",
        success: showResponse,
        error: showError   
    });  
});

function showResponse(responseData) {
    $("#staff_id").append("<li type='square'> Staff Id: " + responseData.Staff_Id + ", Fullname: " + responseData.FirstName + " " + responseData.LastName + ", Campus: " + responseData.Campus );
    $("#staff_id").append("</li>");
}

function showError(){
    alert("Sorry, there was a problem finding Staff ID"); 
}