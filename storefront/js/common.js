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
});