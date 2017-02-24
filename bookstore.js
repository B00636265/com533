$(document).ready(function(){
    $.ajax({
        type: 'GET',
        dataType: "json",
        url: "api.php/books",
        success: showAllBooks,
        error: showError   
      
        });

    
    
    
    $("#btnPost").click(function(){
        document.location.href = "book_post.html";
            })
    
    $("#btnPut").click(function(){
        document.location.href = "book_put.html";
            })
    
    $("#btnDelete").click(function(){
        document.location.href = "book_delete.html";
            })

});
  


function showAllBooks(responseData) {
    $.each(responseData.book,function(index,book){
        $("#book_list").append("<li type='square'> book ID: "+book.bookID+", bookName: "+book.bookName+", bookAuthor:"+book.bookAuthor+", bookPrice: "+book.bookPrice);
        $("#book_list").append("</li>");
    });
}


function showError(e){
    alert("Sorry, there was a problem:" + e); 
}
        






    
    