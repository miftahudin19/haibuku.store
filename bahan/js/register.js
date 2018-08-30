$(document).ready(function() {
   
    //Ketika di Click Signup, Sembunyikan Login dan Tampilkan Register
    $("#signup").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        });
    });
    
    //Ketika di Click Signup, Sembunyikan Login dan Tampilkan Register
    $("#signin").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        });
    });
});