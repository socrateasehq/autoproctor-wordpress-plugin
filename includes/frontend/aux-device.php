<?php include 'base.php' ?>

<?php startblock('title') ?>
AutoProctor Test
<?php endblock() ?>

<?php startblock('head') ?>
<?php superblock() ?>

<?php
$validate_user = $_GET['aux'] ? false : true;
?>

<?php
echo '<script src="' . esc_url(plugins_url('utils/utilities.js', dirname(__FILE__))) . '" ></script> ';
?>

<script
            src="https://browser.sentry-cdn.com/5.17.0/bundle.min.js"
            integrity="sha384-lowBFC6YTkvMIWPORr7+TERnCkZdo5ab00oH5NkFLeQUAmBTLGwJpFjF6djuxJ/5"
            crossorigin="anonymous"
        ></script>
<link rel="stylesheet" href="https://ap-development.s3.amazonaws.com/autoproctor.3.0.1.min.css?v=8" />
<script defer src="https://ap-development.s3.amazonaws.com/autoproctor.3.0.1.min.js?v=8"></script>
<style>
#pipeClickPowered-web-cam-container {
	display: none !important;
}
.soc-loader {
    background-image: url(https://cdn.socratease.co/img/ring-loader.gif);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: 50%;
    height: 100vh;
    width: auto
}
</style>
<?php endblock() ?>

<?php startblock('body') ?>

<body class="min-h-screen bg-gradient-to-b from-blue-200 to-white" style="font-family: lato">
    <div id="ap-test-main" class="mt-8">
        <div class="w-11/12 md:w-10/12 mx-auto shadow-bottom">
            <h1 class="text-3xl md:text-5xl font-bold mb-8 text-blue-900">Test</h1>
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

        </div>
    </div>

    <div id="soc-loader" class=" stw-bg-loader-icon stw-bg-no-repeat stw-w-auto stw-min-h-screen stw-bg-center soc-loader" style="display:none;"></div>


    <div id="aux-device-ctr"  style="display:none;">
        <span class="block mt-4 text-lg font-semibold mx-auto text-center mb-2 md:mb-4" >Please position your auxiliary camera like this</span>
        <img class="mx-auto mb-6" src="https://i.ibb.co/M9LWcp1/4.jpg" />
    </div>

    <div class="container mx-auto mt-8 text-center" id="test-completed-ctr" style="display:none;">
        <h1 class="text-3xl font-bold mb-4">Test Completed</h1>
        <p class="mb-4" id="report-url-ctr">Click on <a href="<?php echo $report_url; ?>" target="_blank"
                class="text-blue-500 hover:text-blue-600">View Report</a> to see the summary.</p>
    </div>
</div>

    <script>

	 var maxSentryEvents = 6;
                var numberOfCurrentSentryEvents = 0;
                const byPassedErrorsDict = [{ error: "privateSpecialRepair", reason: "Chrome mobile view error"},
                { error: "Non-Error promise rejection captured with keys", reason: ""},
                { error: "Non-Error promise rejection captured with value", reason: "https://forum.sentry.io/t/unhandledrejection-non-error-promise-rejection-captured-with-value/14062/12"},
                { error: "getReadModeExtract", reason: "Occurred in HeyTap browser (in Oppo) | 85% Oppo users affected"},
                { error: "getReadModeRender", reason: "Occurred in HeyTap browser (in Oppo) | 85% Oppo users affected" },
                { error: "getReadModeConfig", reason: "Occurred in HeyTap browser (in Oppo) | 85% Oppo users affected" },
                { error: "Identifier 'isMainframe' has already been declared", reason: "Not from our codebase" },
                { error: "runCustomize is not defined", reason: "Not from our codebase" },
                { error: "processRandomSelector is not defined", reason: "Not from our codebase" },
                { error: "zaloJSV2 is not defined", reason: "Not from our codebase : https://github.com/getsentry/sentry-javascript/issues/7842" },
                { error: "Can't find variable: zaloJSV2", reason: "Not from our codebase : https://github.com/getsentry/sentry-javascript/issues/7842" },
                { error: "ResizeObserver loop limit", reason: "Can be ignored: https://stackoverflow.com/questions/49384120/resizeobserver-loop-limit-exceeded" },
                { error: "SecurityError: Failed to read the 'contentDocument' property from 'HTMLIFrameElement'", reason: "Some browser setting issue on mobile" },
                { error: "Can't find variable: $", reason: "To avoid other important sentry errors getting ignored" },
                { error: "$ is not defined", reason: "To avoid other important sentry errors getting ignored" },
            ]

        const errorArr = byPassedErrorsDict.map(function(ped) {  return ped.error; })
        var serverErrorsRegex = new RegExp(errorArr.join("|"), "mi");


    window.addEventListener("load", function() {
		Sentry.init({
                 dsn: "https://cac61d5e1fe04b01a6409048914ff88e@o288839.ingest.sentry.io/5911954", //3
                 beforeSend(e) {
                     console.log(e);
                     return e;
                 },
                 environment: "development",
                 ignoreErrors: [serverErrorsRegex],
            });
        const clientID = '<?php echo $clientId ?>';
        let testAttemptId = '<?php echo $testAttemptId; ?>';
        const hashedTestAttemptId = '<?php echo $hashedTestAttemptId; ?>';

        const credentials = {
            clientId: clientID,
            testAttemptId,
            hashedTestAttemptId,
            domain: '<?php echo $domain; ?>',
        };

        const proctoringOptions = {
            trackingOptions: {
                audio: true,
                numHumans: true,
                tabSwitch: true,
                captureSwitchedTab: true,
                photosAtRandom: true,
                numPhotosAtRandom: 5,
                recordSession: false,
                detectMultipleScreens: true,
                testTakerPhoto: true,
                showCamPreview: false,
                auxiliaryDevice: true,
            },
            restrictConsole: false,
            evidencePushInterval: 5,
            auxiliaryDeviceRandomPhotoPushInterval: 10,
            userDetails: {
                name: "First Last",
                email: "user@autoproctor.co",
            },
            testDuration: 60,
            showHowToVideo: false
        };

        async function init() {
            try {
                <?php
if ($validate_user) {
 ?>
                let userId = prompt("Please enter user id", 1234);
                if (userId.trim() !== '1234') {
                    window.location.reload();
                }
                <?php
}
?>
                const apInst = new AutoProctor(credentials);
                await apInst.setup(proctoringOptions);

                document.getElementById("testStart").addEventListener("click", () => {
					document.getElementById('soc-loader').style.display = 'block';
                    apInst.start();
                });
                document.getElementById("testEnd").addEventListener("click", () => {
                    apInst.stop();
                });

                window.addEventListener("apMonitoringStarted", () => {
					document.getElementById('soc-loader').style.display = 'none';
						if (apInst && apInst.isAuxiliaryDeviceConfirmed === true) {
						    document.getElementById('aux-device-ctr').style.display = "block";
						}
                });

                window.addEventListener("apMonitoringStopped", async () => {
						if (apInst && apInst.isAuxiliaryDeviceConfirmed === true) {
							document.getElementById('aux-device-ctr').style.display = "none";
							document.getElementById('test-completed-ctr').style.display = "block";
							$("#testEnd").prop("disabled", true);
							$("#testStart").prop("disabled", false);
							if (typeof isAuxDevice !== "undefined" && isAuxDevice) {
								document.getElementById('report-url-ctr').style.display = "none";
								return;
							}
						}
                });
                document.getElementById("testReload").addEventListener("click", () => {
                    window.location.reload();
                });
            } catch (err) {
							console.log('error', err);
						throw new Error(err);
						}
        }

        init();
    });

    window.addEventListener('auxDeviceConfirmed', function() {
        console.log('Aux Device Confirmed');
    });
    </script>

</body>
<?php endblock() ?>