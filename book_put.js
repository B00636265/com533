$(document).ready(function(){
    $("#btnUpdate").click(function(){
        var book=new Book($("#bookName").val(),
                          $("#bookAuthor").val(), 
                          $("#bookPrice").val());
        
    $.ajax({
        type: 'PUT',
        dataType: "json",
        url: "api.php/books/1",
        data: JSON.stringify(book),
        success: showResponse,
        error: showError   
        });
    
console.log(JSON.stringify(book));

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
    alert("Successfully Updated!");   
    }

function showError(e){
    console.log(e);
    alert("Sorry, there was a problem trying to update staff!");
    }

