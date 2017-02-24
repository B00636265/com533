$(document).ready(function(){
    $.ajax({
    type: 'DELETE',
    dataType: "application/json",
    url: "api.php/staffs/13",
    });
    
    alert("Successfully deleted!");
});

















