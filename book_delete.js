$(document).ready(function(){
    $.ajax({
    type: 'DELETE',
    dataType: "application/json",
    url: "api.php/books/13",
    });
    
    alert("Successfully deleted!");
    
    document.location.href="bookstore.html";
    
});