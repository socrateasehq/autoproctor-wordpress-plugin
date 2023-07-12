<?php
$autoproctor_plugin_settings = get_option('autoproctor_settings');
$clientId                    = $autoproctor_plugin_settings['client_id'];
$clientSecret                = $autoproctor_plugin_settings['client_secret'];
$isDevelopmentMode           = $autoproctor_plugin_settings['development_mode'];
$domain                      = $isDevelopmentMode ? "https://staging.autoproctor.co" : "https://autoproctor.co/";
$attemptLabel                = get_query_var('attempt_label');
$hashedTestAttemptId         = get_query_var('hashed_test_attempt_id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Attempts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://ap-development.s3.amazonaws.com/autoproctor.2.7.9.min.css" />
	<script defer src="https://ap-development.s3.amazonaws.com/autoproctor.2.7.9.min.js"></script>
</head>
<body>
    <div class="container mx-auto mt-8 max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">Test Attempts Report <?php echo $attemptLabel; ?> </h1>
        <div id="ap-test-report-overview" class="max-w-5xl mx-auto"></div>
            <div class="flex ">
              <button id="tab-1" class="px-4 py-2 mr-2 bg-blue-300 text-gray-700 tab-button rounded-md">Proctoring Summary</button>
              <button id="tab-2" class="px-4 py-2 text-gray-700 tab-button rounded-md">Session Recording</button>
            </div>

            <div id="tab-1-content">
              <div id="ap-proctor-summary" class="p-4"></div>
            </div>

            <div id="tab-2-content">
              <div id="ap-session-recording" class="p-4">
              </div>
            </div>
        </div>
    </div>

          <script>
            // Get references to the tab buttons and tab content
            const primaryTabButtonMain = document.getElementById('tab-1');
            const secondaryTabButtonMain = document.getElementById('tab-2');
            const primaryContentMain = document.getElementById('tab-1-content');
            const secondaryContentMain = document.getElementById('tab-2-content');

            // Add click event listeners to the tab buttons
            primaryTabButtonMain.addEventListener('click', () => {
              if (!primaryTabButtonMain.classList.contains('bg-gray-500')) {
                toggleMainTabs('tab-1');
              }
            });

            secondaryTabButtonMain.addEventListener('click', () => {
              if (!secondaryTabButtonMain.classList.contains('bg-gray-500')) {
                toggleMainTabs('tab-2');
              }
            });

            // Function to toggle the tabs
            function toggleMainTabs(activeTab) {
              if (activeTab === 'tab-1') {
                primaryTabButtonMain.classList.add('bg-blue-300');
                primaryTabButtonMain.classList.remove('text-gray-700');
                secondaryTabButtonMain.classList.remove('bg-blue-300');
                secondaryTabButtonMain.classList.add('text-gray-700');
                primaryContentMain.style.display = 'block';
                secondaryContentMain.style.display = 'none';
              } else if (activeTab === 'tab-2') {
                primaryTabButtonMain.classList.remove('bg-blue-300');
                primaryTabButtonMain.classList.add('text-gray-700');
                secondaryTabButtonMain.classList.add('bg-blue-300');
                secondaryTabButtonMain.classList.remove('text-gray-700');
                primaryContentMain.style.display = 'none';
                secondaryContentMain.style.display = 'block';
              }
            }
            // Select the default tab (Primary Device)
            toggleTabs('tab-1');
          </script>

    </body>
<script>
    window.addEventListener('load', async function() {
        const apReportSettings =
                {tenantId: '<?php echo $clientId; ?>', testAttemptId: '<?php echo $attemptLabel; ?>', hashedTestAttemptId: '<?php echo $hashedTestAttemptId; ?>', domain: 'http://127.0.0.1:5002'};
        try {
            autoProctorTest = await initAutoProctorReport(apReportSettings);
            autoProctorTest.renderProctoringSummary({
                renderOverview: true,
                proctorOverviewCtrId: "ap-test-report-overview",
                renderSummaryTable: true,
                proctorSummaryCtrId: "ap-proctor-summary",
                renderSessionRecording: true,
                sessionRecordingCtrId: "ap-session-recording",
                userDetails: {
                    name: "First Last",
                    email: "useremail@gmail.com",
                },
            });
        } catch (err) {
            console.log(err);
        }
    });
</script>
</html>


