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


    $("#register-btn").click(function (e) {
        e.preventDefault();



        var firstName = $("#first-name").val();
        var lastName = $("#last-name").val();
        var userName = $("#username").val();
        var password = $("#password").val();
        var ccType = $("#credit-card-type").val();
        var ccNumber = $("#credit_card_number").val();
        var ccExpDate = $("#credit_card_expiration_date").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var zipcode = $("#zipcode").val();
        var emailAddress = $("#email_address").val();

        if (checkIfAnyEmptyValues(firstName, lastName, userName, password, ccType, ccNumber, ccExpDate, phone, address, city, state, zipcode) || !isEmailValid(emailAddress) ) {
            $(".alert-danger").text("Please fill in all fields.");
            $(".alert-danger").removeClass("hidden");
            $(".alert-warning").text("Please enter a valid email.");
            $(".alert-warning").removeClass("hidden");
            $("html, body").animate({ scrollTop: 0 }, "fast");                           

        } 

        if ( isEmailValid(emailAddress) ) {
           $(".alert-warning").addClass("hidden");
           $("#email_address").parent().removeClass('has-error'); 
        }

        if (!checkIfAnyEmptyValues(firstName, lastName, userName, password, ccType, ccNumber, ccExpDate, phone, address, city, state, zipcode) && isEmailValid(emailAddress) ) {
            $("#register-form").submit();
        }

    });

    function isEmailValid(emailAddress) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
        if (!emailReg.test(emailAddress) || emailAddress == "" ) {
            $("#email_address").parent().addClass('has-error');
            return false;
        }
        else {
            return true;
        } 

    }

    function checkIfAnyEmptyValues(firstName, lastName, userName, password, ccType, ccNumber, ccExpDate, phone, address, city, state, zipcode) {

        
        if (firstName == "" || lastName == "" || userName == "" || password == "" || ccType  == "" || ccNumber == "" || ccExpDate  == "" || phone == "" || address  == "" || city == "" || state == "" || zipcode == "") {                       
            return true;
        }
        else {
            return false;
        }
        

    }

});


