async function markTestAsStarted(testAttemtId, ajaxUrl) {
    $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
            action: "mark_test_attempt_started",
            testAttemptLabel: testAttemtId,
        },
        success: function (response) {
            // Handle the AJAX response
            console.log(response);
        },
        error: function (errorThrown) {
            // Handle errors
            console.log(errorThrown);
        },
    });
}

async function deleteTestAttempt(testAttemtId, ajaxUrl) {
    $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
            action: "delete_test_attempt",
            testAttemptLabel: testAttemtId,
        },
        success: function (response) {
            alert("Test attempt deleted successfully");
            location.reload();
        },
        error: function (errorThrown) {
            // Handle errors
            console.log(errorThrown);
        },
    });
}

async function markTestAttemptAsFinished(testAttemtId, ajaxUrl) {
    $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
            action: "mark_test_attempt_finished",
            testAttemptLabel: testAttemtId,
        },
        success: function (response) {
            // Handle the AJAX response
            console.log(response);
        },
        error: function (errorThrown) {
            // Handle errors
            console.log(errorThrown);
        },
    });
}

function convertISOStringToLocalDateTime(
    isoDateString,
    include_seconds = false,
    date_only = false,
    include_year = false
) {
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    let dateTime;
    try {
        const str2 = isoDateString.replace(" ", "T");
        dateTime = new Date(str2);
    } catch (e) {
        return isoDateString;
    }

    const date = dateTime.getDate();
    const month = monthNames[dateTime.getMonth()];
    let hours = dateTime.getHours();
    const year = dateTime.getFullYear();

    let ampm;
    ampm = hours >= 12 ? "PM" : "AM";

    if (hours > 12) {
        hours = hours - 12;
    }

    let minutes = dateTime.getMinutes();
    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    let formattedDate;
    if (include_seconds) {
        let seconds = dateTime.getSeconds();
        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        if (include_year) {
            formattedDate = date + "-" + month + "  " + year + " " + hours + ":" + minutes + ":" + seconds + " " + ampm;
        } else {
            formattedDate = date + " " + month + " " + hours + ":" + minutes + ":" + seconds + " " + ampm;
        }
    } else if (date_only) {
        const year = dateTime.getFullYear();

        if (include_year) {
            formattedDate = date + " " + month + " " + year;
        } else {
            formattedDate = date + " " + month;
        }
    } else {
        if (include_year) {
            formattedDate = date + "-" + month + "  " + year + " " + hours + ":" + minutes + " " + ampm;
        } else {
            formattedDate = date + "-" + month + "  " + hours + ":" + minutes + " " + ampm;
        }
    }

    return formattedDate;
}
