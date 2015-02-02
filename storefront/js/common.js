$(document).ready(function() {
    $('#createAccount').click(function() {
    	$("#step1").addClass("hidden");
        $("#step2").toggleClass("hidden");
    });
    $('.step1header').click(function() {
    	$("#step2").addClass("hidden");
        $("#step1").toggleClass("hidden");

    });
    $('.step2header').click(function() {
    	$("#step2").toggleClass("hidden");
        $("#step1").addClass("hidden");

    });	


    $('#choose-cat').change(function(){
        $.ajax({

            type: "GET",
            url: "product_categories.php",
            data: 'catId=' + $('.category').val()
            //success: function(){
               // window.location.href = "product_categories.php"
           // }

        }); // Ajax Call
    }); //event handler




});