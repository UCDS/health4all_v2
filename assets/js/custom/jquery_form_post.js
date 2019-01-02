$(document).ready(function(){
    // click on button submit
    $("#form").submit(function(event){
        // send ajax
        console.log('Submit clicked');
        var url = $(location).attr('host');        //window.location.href;
        $.ajax({
            url: '/health4all_v2/generic_report/json_data',     // url where to submit the request
            type : "POST",                                      // type of action POST || GET
            dataType : 'json',                                  // data type
            data : $("#form").serialize(),                      // post data || get data
            success : function(result) {
                // you can see the result from the console
                // tab of the developer tools
                alert("Success");
                $('#ajax_notification').text("ajax post done");
                draw_table();
                console.log(result);
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
                $('#ajax_notification').text("ajax post done");
                alert('Fail');
                draw_table();
            }
        });
        event.preventDefault();
    });
});