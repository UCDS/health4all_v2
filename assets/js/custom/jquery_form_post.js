$(document).ready(function(){
    // click on button submit
    $("#primary_filter").submit(function(event){
        // send ajax
        console.log('Submit clicked');
        $('#ajax_notification').text("Query submitted please wait...");
        $.ajax({
            url: '/health4all_v2/generic_report/json_data',     // url where to submit the request
            type : "POST",                                      // type of action POST || GET
            dataType : 'json',                                  // data type
            data : $("#primary_filter").serialize(),                      // post data || get data
            success : function(result) {
                // you can see the result from the console
                // tab of the developer tools
                $('#ajax_notification').text("Got Result");
                draw_table(result);
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
                $('#ajax_notification').text("Something went wrong");
            }
        });
        event.preventDefault();
    });
});