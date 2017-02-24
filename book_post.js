//Adding a new book information
$(document).ready(function(){
    $("#btnSave").click(function(){
        var book=new Book($("#bookName").val(),
                          $("#bookAuthor").val(),
                          $("#bookPrice").val());
        
    $.ajax({
        type: 'POST',
        dataType: "json",
        url: "api.php/books",
        data: JSON.stringify(book),
        success: showResponse,
        error: showError   
        });
        
});
    

$("#btnBack").click(function(){
    document.location.href = "bookstore.html";
        });
        
});
 
function Book(bookName, bookAuthor, bookPrice){
    this.bookName=bookName;
    this.bookAuthor=bookAuthor;
    this.bookPrice=bookPrice;
}

function showResponse(responseData){
    alert("Successfully Added!");
}

function showError(){
    alert("Sorry, there was a problem trying to add a new book!");
}




