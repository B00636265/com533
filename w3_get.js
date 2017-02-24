$(document).ready(function(){
    $.ajax({
        type: 'GET',
        dataType: "json",
        url: "api.php/staffs",
        success: showAllStaffs,
        error: showError   
    });  
});


function showAllStaffs(responseData) {
    $.each(responseData.staff,function(index,staff){
        $("#staff_list").append("<li type='square'> Staff Id: "+staff.Staff_Id+", FullName: "+staff.FirstName+" "+staff.LastName+", Campus: "+staff.Campus);
        $("#staff_list").append("</li>");
    });
}


function showError(e){
    alert("Sorry, there was a problem:" + e); 
}
