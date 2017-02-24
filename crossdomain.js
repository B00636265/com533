$(document).ready(function(){
$("#suggestion").keyup(function(e){
suggestionUrl="https://en.wikipedia.org/w/api.php?action=opensearch&format=json&search="+$("#suggestion").val();
    
    $.ajax({
    type: 'GET',
    dataType: "jsonp",
    url: suggestionUrl,
    success: function (responseData) {
        
    $("#suggestion_list").empty();
        
    $.each(responseData[1], function(key, value){
        $("#suggestion_list").append("<li> <ahref="+responseData[3][key]+">"+value+"</a></li>");
    });
    },
        
    error: function () {
    $("#suggestion_list").empty();
    alert('Fail to make cross domain request');
    }
        });
            });
                });