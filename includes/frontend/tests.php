<?php include 'base.php' ?>

<?php startblock('title') ?>
    AutoProctor Test
<?php endblock() ?>

<?php startblock('head') ?>
    <?php superblock() ?>
    
    <?php
    echo '<script src="' . esc_url( plugins_url( 'utils/utilities.js', dirname(__FILE__) ) ) . '" ></script> ';
    ?>

    <?php
        if (!$is_finished) {
            ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://ap-development.s3.amazonaws.com/autoproctor.2.7.8.min.css" />
    <script defer src="https://ap-development.s3.amazonaws.com/autoproctor.2.7.8.min.js"></script>
    <?php
        }
        ?>
<?php endblock() ?>

<?php startblock('body') ?>

    <body class="min-h-screen bg-gradient-to-b from-blue-200 to-white" style="font-family: lato">
        <?php

        if ($is_finished) {
        ?>
        <div class="container mx-auto mt-8 text-center">
            <h1 class="text-3xl font-bold mb-4">You have already finished the test.</h1>
            <p class="mb-4">Click on <a href="<?php echo $report_url; ?>" target="_blank"
                    class="text-blue-500 hover:text-blue-600">View Report</a> to see the summary.</p>
        </div>
        <?php
        } else {
        ?>
        <div id="ap-test-main" class="mt-8">
            <div class="w-11/12 md:w-10/12 mx-auto shadow-bottom">
                <h1 class="text-3xl md:text-5xl text-center font-bold mb-3 text-blue-900">Test <?php echo $test_id; ?></h1>

            </div>
            <div class="w-11/12 md:w-10/12 mx-auto flex flex-col justify-start items-center my-5 ">
                <div class="mx-auto mt-8 mb-2">
                    <button id="testStart"
                    class="mb-2 md:mb-0 bg-none border-2 border-green-600 rounded-full hover:bg-green-600 hover:text-white transition-all text-green-600 text-xs md:text-sm lg:text-base font-normal py-2 px-4 mx-1 md:mx-3 rounded uppercase tracking-wide">Start</button>
                    <button id="testEnd"
                    class="mb-2 md:mb-0 bg-none border-2 border-red-700 rounded-full hover:bg-red-700 hover:text-white transition-all text-red-700 text-xs md:text-sm lg:text-base font-normal md:ml-3 py-2 px-4 mx-1 md:mx-3 rounded uppercase tracking-wide">Stop</button>
                    <button id="testReload"
                    class="mb-2 md:mb-0 bg-none border-2 border-blue-900 rounded-full hover:bg-blue-900 hover:text-white transition-all text-blue-900 text-xs md:text-sm lg:text-base font-normal md:ml-3 py-2 px-4 mx-1 md:mx-3 rounded uppercase tracking-wide">Reload</button>
                </div>
                <button id="testLabel"
                    class="mb-2 bg-none border-2 border-black rounded-full hover:bg-black hover:text-white transition-all text-black text-xs md:text-sm lg:text-base font-normal md:ml-3 py-2 px-4 rounded uppercase tracking-wide hidden">Show
                    Passcode</button>

                    <div class="flex flex-row">
                        <div id="ap-test-proctoring-status" class=" mb-2 md:mb-0 text-3xl text-blue-900 font-bold md:ml-14 animate-pulse"></div>
                        <div id="proctor-feedback"
                        class="mb-2  bg-none rounded-full transition-all text-yellow-600 text-bolder text-xs md:text-sm lg:text-base font-normal md:ml-3 py-2 px-4 rounded uppercase tracking-wide ">
                    </div>
                </div>
            </div>

            <div id="ap-test-ctr-main" style="display:none;">
                <iframe id="google-form-iframe" importance="high" width="100%" height="100%"
                    frameborder="0" marginheight="0" marginwidth="0" class="w-full h-full">
                    Loading…
                </iframe>
            </div>
            <div id="aux-device-ctr">

            </div>

            <div class="container mx-auto mt-8 text-center" id="test-completed-ctr" style="display:none;">
                <h1 class="text-3xl font-bold mb-4">Test Completed</h1>
                <p class="mb-4" id="report-url-ctr">Click on <a href="<?php echo $report_url; ?>" target="_blank"
                        class="text-blue-500 hover:text-blue-600">View Report</a> to see the summary.</p>
            </div>
        </div>

        <script>
        var allowSameDeviceasPrimarySecondary = true;
        window.addEventListener("load", function() {
            const clientID = '<?php echo $clientId ?>';

            let testAttemptId = '<?php echo $testAttemptId; ?>';

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
                    preventMultipleScreens: true,
                    testTakerPhoto: true,
                    forceCaptureSwitchedTab: true,
                    forcePreventMultipleScreens: true,
                    forceFullScreen: false,
                    previewVideo: false,
                    forceDesktop: true,
                    showCamPreview: false,
                    auxiliaryDevice: <?php echo $test_id; ?> == 1? false: true,
                },
                restrictConsole: false,
                evidencePushInterval: 5,
                auxiliaryDeviceRandomPhotoPushInterval: 10,
                userDetails: {},
                testDuration: 60,
                domain: '<?php echo $domain; ?>',
                showHowToVideo: false
            };
            console.log(apSettings)
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
                        markTestAsStarted(testAttemptId, '<?php echo $ajax_url; ?>');
                        document.getElementById('ap-test-ctr-main').style.display = "block";
                        document.getElementById('google-form-iframe').setAttribute('src', '<?php echo $test_url; ?>')
                        $("#testEnd").prop("disabled", false);
                        $("#testStart").prop("disabled", true);
                        $("#ap-test-proctoring-status").html("Proctoring...");
                    });

                    window.addEventListener("apStopMonitoring", async () => {
                        document.getElementById('ap-test-ctr-main').style.display = "none";
                        document.getElementById('test-completed-ctr').style.display = "block";
                        $("#testEnd").prop("disabled", true);
                        $("#testStart").prop("disabled", false);
                        $("#ap-test-proctoring-status").html("");

                        if (typeof isAuxDevice !== "undefined" && isAuxDevice) {
                            document.getElementById('report-url-ctr').style.display = "none";
                            return;
                        }
                        markTestAttemptAsFinished(testAttemptId, '<?php echo $ajax_url; ?>');
                    });
                    document.getElementById("testReload").addEventListener("click", () => {
                        window.location.reload();
                    });
                } catch (err) {}
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
            console.log('Aux Device Confirmed');
        });

        </script>
        <?php
        }
        ?>
    </body>
<?php endblock() ?>