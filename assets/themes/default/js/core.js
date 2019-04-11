/**
 * Global core functions
 */
$(document).ready(function() {


	
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