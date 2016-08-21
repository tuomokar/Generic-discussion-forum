$(document).ready(function(){
    $('form.destroy-form').on('submit', function(submit){
        var confirm_message = "Are you sure? Object will be removed permanently.";
        if(!confirm(confirm_message)){
            submit.preventDefault();
        }
    });
});