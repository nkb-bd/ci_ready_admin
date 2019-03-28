                                                                
/**
 * Configurations
 */
var config = {
    logging : true,
    baseURL : "http://localhost/starter-master/"
};


/**
 * Bootstrap IE10 viewport bug workaround
 */
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
        document.createTextNode(
            '@-ms-viewport{width:auto!important}'
        )
    )
    document.querySelector('head').appendChild(msViewportStyle)
}


$('body').on('click', '.btn-delete-user', function(event) {

    console.log($(this).data('id'));    
    console.log('ssss');    
    event.preventDefault();
    /* Act on the event */
});
/**
 * Execute an AJAX call
 */
function executeAjax(url, data, callback) {
    $.ajax({
        type     : 'POST',
        url      : url,
        data     : data,
        dataType : 'json',
        async    : true,
        success  : function(results) {
            callback(results);
        },
        error    : function(error) {
            alert("Error " + error.status + ": " + error.statusText);
        }
    });
    // prevent default action
    return false;
}


/**
 * Global core functions
 */
$(document).ready(function() {

    /**
     * Session language selected
     */
    $('#session-language-dropdown a').click(function(e) {
        // prevent default behavior
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }

        // set up post data
        var postData = {
            language : $(this).attr('rel')
        };

        // define callback function to handle AJAX call result
        var ajaxResults = function(results) {
            if (results.success) {
                location.reload();
            } else {
                alert("There was a problem setting the language!");
            }
        };

        // perform AJAX call
        executeAjax(config.baseURL + 'ajax/set_session_language', postData, ajaxResults);
    });

});

                                                
/**
 * Global admin functions
 */
$(document).ready(function() {

    /**
     * Enable tooltips
     */
    if ($('.tooltips').length) {
        $('.tooltips').tooltip();
    }


    /**
     * Activate any date pickers
     */
    if ($(".input-group.date").length) {
        $(".input-group.date").datepicker({
            autoclose      : true,
            todayHighlight : true
        });
    }


    /**
     * Detect items per page change on all list pages and send users back to page 1 of the list
     */
    $('select#limit').change(function() {
        var limit = $(this).val();
        var currentUrl = document.URL.split('?');
        var uriParams = "";
        var separator;

        if (currentUrl[1] != undefined) {
            var parts = currentUrl[1].split('&');

            for (var i = 0; i < parts.length; i++) {
                if (i == 0) {
                    separator = "?";
                } else {
                    separator = "&";
                }

                var param = parts[i].split('=');

                if (param[0] == 'limit') {
                    uriParams += separator + param[0] + "=" + limit;
                } else if (param[0] == 'offset') {
                    uriParams += separator + param[0] + "=0";
                } else {
                    uriParams += separator + param[0] + "=" + param[1];
                }
            }
        } else {
            uriParams = "?limit=" + limit;
        }

        // reload page
        window.location.href = currentUrl[0] + uriParams;
    });


    /**
     * Enable Summernote WYSIWYG editor on any textareas with the 'editor' class
     */
    if ($('textarea.editor').length) {
        $('textarea.editor').each(function() {
            var id = $(this).attr('id');
            $('#' + id).summernote({
                height: 300
            });
        });
    }


    /**
     * Enable datepicker  'date' class
     */
    if ($('input.date').length) {
        $(".date").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
              }).datepicker('update', new Date());
    }

    /**
     * Enable date range picker  'date-range' class
     */
    // if ($('.daterange').length) {
    //   $(function() {
        
    //         var start = moment().subtract(29, 'days');
    //         var end = moment();

    //         function cb(start, end) {
    //             $('.daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    //         }

    //         $('.daterange').daterangepicker({
    //             startDate: start,
    //             endDate: end,
    //             //  locale: {
    //             //   format: 'd/m/y'
    //             // }
    //             ranges: {
    //                'Today': [moment(), moment()],
    //                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //                'This Month': [moment().startOf('month'), moment().endOf('month')],
    //                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //             }
    //         }, cb);

    //         cb(start, end);

    //     });
    // }

});

$(document).ready(function() {

    /**
     * Apply form-control class and id to timezones dropdown
     */
    $('select[name=timezones]').addClass('form-control').attr('id', "timezones");

});

