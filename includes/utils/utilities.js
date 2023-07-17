async function markTestAsStarted(testAttemtId, ajaxUrl) {
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
            action: 'mark_test_attempt_started',
            testAttemptLabel : testAttemtId
        },
        success: function(response) {
            // Handle the AJAX response
            console.log(response);
        },
        error: function(errorThrown) {
            // Handle errors
            console.log(errorThrown);
        }
    });
}

async function markTestAttemptAsFinished(testAttemtId, ajaxUrl) {
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
            action: 'mark_test_attempt_finished',
            testAttemptLabel : testAttemtId
        },
        success: function(response) {
            // Handle the AJAX response
            console.log(response);
        },
        error: function(errorThrown) {
            // Handle errors
            console.log(errorThrown);
        }
    });
}