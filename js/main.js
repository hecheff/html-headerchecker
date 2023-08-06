function getHTML() {
    var input_html      = $("#target_url").eq(0).val();
    var actionButton    = $("#button_exec").eq(0);
    
    var textarea_output = $("textarea#output_html").eq(0);
    var input_useragent_type = $("#useragent_type").eq(0).find(":selected").val();

    actionButton.prop('disabled', true);

    $.ajax({
        url:            "/php/getHTML.php",
        type:           "POST",
        dataType:       "JSON",
        data:   {
            url: input_html, 
            useragent_type: input_useragent_type, 
        },
        success: function (data) {
            if (!data.html.startsWith('[')) {
                textarea_output.html(data.html);
            } else {
                alert("ERROR: Data retrieval failed. ERROR: " + data.html);
            }
            actionButton.prop('disabled', false);
        },
        error: function () {
            alert("ERROR: Data retrieval failed.");
            actionButton.prop('disabled', false);
        }
    });
}