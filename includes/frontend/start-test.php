
<?php
$autoproctor_plugin_settings = get_option('autoproctor_settings');
$clientId                    = $autoproctor_plugin_settings['client_id'];
$clientSecret                = $autoproctor_plugin_settings['client_secret'];
$isDevelopmentMode           = $autoproctor_plugin_settings['development_mode'];
$domain                      = $isDevelopmentMode ? "https://staging.autoproctor.co" : "https://autoproctor.co/";
$testAttemtId                = get_query_var('attempt_label');
$test_id                     = get_query_var('test_id');
$ajax_url                    = admin_url('admin-ajax.php');

$result      = get_test_attempt_result($testAttemtId, $test_id);
$is_finished = false;
if ($result) {
 if ($result->finished === "true") {
  $is_finished = true;
 }
} else {
 createTestAttempt($testAttemtId, $test_id);
}

$hashedTestAttemptId = getHashedTestAttemptId($testAttemtId);

$test_url = $test_id === '1' ? "https://docs.google.com/forms/d/e/1FAIpQLSfcy9oLz_Phz_3bpEOgD9Qj2fk-Axeo_ZDcBy23fEyczdR__A/viewform?usp=sf_link" : "https://docs.google.com/forms/d/e/1FAIpQLScPtvVxyzk6BamQ77tJlZSPHoPFyvdCQrPdKgAErFGTV6hTbg/viewform?usp=sf_link";

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Autoproctor Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php

if (!$is_finished) {

 ?>

    <link rel="stylesheet" href="https://ap-development.s3.ap-south-1.amazonaws.com/socTable.css">
    <script src="https://ap-development.s3.ap-south-1.amazonaws.com/socTable.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://ap-development.s3.amazonaws.com/autoproctor.2.7.9.min.css" />
	<script defer src="https://ap-development.s3.amazonaws.com/autoproctor.2.7.9.min.js"></script>
    <?php
}
?>
</head>

<body>
    <?php

if ($is_finished) {
 ?>
    <div class="container mx-auto mt-8 text-center">
        <h1 class="text-3xl font-bold mb-4">You have already finished the test.</h1>
        <p class="mb-4">Click on <a href="your_report_url" target="_blank" class="text-blue-500 hover:text-blue-600">View Report</a> to see the summary.</p>
    </div>
    <?php
} else {
 ?>
    <div id="ap-test-main">
        <div class="w-full h-44 bg-white" style="padding: 12px; display: flex; align-items: center; gap: 12px;">
            <button id="testStart" style="padding: 9px 18px; border-radius: 5px; font-size: 16px; border: none; outline: none; background: #1ac407; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">Start Proctoring</button>
            <button id="testEnd" style="background: white; padding: 9px 18px; border-radius: 5px; font-size: 16px; border: 1px solid red; outline: none; color: red; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">End Proctoring</button>
            <button id="testReload" style="background: white; padding: 9px 18px; border-radius: 5px; font-size: 16px; border: 1px solid #525252; outline: none; color: #525252; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">Reload</button>
            <button id="testLabel" style="background: white; padding: 9px 18px; border-radius: 5px; font-size: 16px; border: 1px solid #525252; outline: none; color: #525252; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;display:none;">Show Test Label</button>
            <div id="proctor-feedback"></div>
        </div>

		<div id="ap-test-report-overview" class="max-w-5xl mx-auto"></div>
    	<div id="ap-test-report" class="max-w-5xl mx-auto"></div>

        <div id="ap-test-ctr-main">
            <iframe id="google-form-iframe" importance="high" width="100%" height="100%"
                src="<?php echo $test_url; ?>"
                frameborder="0" marginheight="0" marginwidth="0" class="w-full h-full">
                Loading…
            </iframe>
        </div>
    </div>

    <script>
        var allowSameDeviceasPrimarySecondary = true;
        window.addEventListener("load", function () {
            const clientID = '<?php echo $clientId ?>';
            const clientSecret = '<?php echo $clientSecret ?>';

            let testAttemptId = '<?php echo $testAttemtId; ?>';

            const hashedTestAttemptId = '<?php echo $hashedTestAttemptId; ?>';

            const apSettings = {
                tenantId: clientID,
                testAttemptId: testAttemptId,
                hashedTestAttemptId: hashedTestAttemptId,
                trackingOptions: {
                    audio: true,
                    numHumans: true,
                    tabSwitch: true,
                    captureSwitchedTab: true,
                    photosAtRandom: true,
                    numPhotosAtRandom: 5,
                    recordScreen: true,
                    recordSession: false,
                    preventMultipleScreens: true,
                    testTakerPhoto: true,
                    forceCaptureSwitchedTab: true,
                    forcePreventMultipleScreens: true,
                    forceFullScreen: false,
                    previewVideo: false,
                    forceDesktop: true,
                    showCamPreview: false,
                    auxiliaryDevice: false,
                },
                restrictConsole: false,
                evidencePushInterval: 5,
                auxiliaryDeviceRandomPhotoPushInterval: 10,
                userDetails: {},
                testDuration: 60,
                domain: "http://127.0.0.1:5002",
				// domain: '<?php echo $domain; ?>', //"http://127.0.0.1:5002",
                showHowToVideo: false
            };



            async function init() {
                try {
                    autoProctorTest = await initAutoProctor(apSettings);

					document.getElementById("testStart").addEventListener("click", () => {
                        autoProctorTest.start();
                    });
                    document.getElementById("testEnd").addEventListener("click", () => {
                        autoProctorTest.stop();
                    });

                    window.addEventListener("apStartTest", () => {
                        markTestAsStarted(testAttemptId);
                        document.getElementById('ap-test-ctr-main').style.display = "block";
                        $("#testEnd").prop("disabled", false);
                        $("#testStart").prop("disabled", true);
                        $("#ap-test-report").html("Proctoring...");
                    });

                    window.addEventListener("apStopMonitoring", async () => {
                        if (typeof isAuxDevice !== "undefined" && isAuxDevice) {
                            return;
                        }
                        markTestAttemptAsFinished(testAttemptId);
                    });
                    document.getElementById("testReload").addEventListener("click", () => {
                        window.location.reload();
                    });
                } catch (err) { }
            }

            init();
        });

        window.addEventListener('auxDeviceTestAttemptLabelGenerated', function(e) {
            const testLabelElement = document.getElementById("testLabel");
            testLabelElement.addEventListener("click", () => {
                alert(`Test Label is ${e.detail.auxDeviceLabel}`);
            });
            testLabelElement.style.display = "flex";
        });

        window.addEventListener('auxDeviceConfirmed', function() {
            alert('Aux Device Confirmed');
        });

        async function markTestAttemptAsFinished(testAttemtId) {
            $.ajax({
                url: '<?php echo $ajax_url; ?>',
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

        async function markTestAsStarted(testAttemtId) {
            $.ajax({
                url: '<?php echo $ajax_url; ?>',
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
    </script>
    <?php
}
?>
</body>



