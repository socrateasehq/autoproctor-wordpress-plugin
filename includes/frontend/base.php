<?php require_once 'ti.php' ?>

<?php
$testAttemptId = generateRandomString();
$autoproctor_plugin_settings = get_option('autoproctor_settings');
$clientId                    = $autoproctor_plugin_settings['client_id'];
$clientSecret                = $autoproctor_plugin_settings['client_secret'];
$isDevelopmentMode           = $autoproctor_plugin_settings['development_mode'];
$domain                      = $isDevelopmentMode ? "https://staging.autoproctor.co" : "https://autoproctor.co/";
$test_id                     = get_query_var('test_id');
$ajax_url                    = admin_url('admin-ajax.php');
$result                      = get_test_attempt_result($testAttemptId, $test_id);
$results                     = getAllAttemptsDataByTestId($test_id);
$is_finished                 = false;

$attemptLabel = get_query_var('attempt_label');
$hashedTestAttemptId = getHashedTestAttemptId($testAttemptId);

$test_url   = $test_id === '1' ? "https://docs.google.com/forms/d/e/1FAIpQLSfcy9oLz_Phz_3bpEOgD9Qj2fk-Axeo_ZDcBy23fEyczdR__A/viewform?usp=sf_link" : "https://docs.google.com/forms/d/e/1FAIpQLScPtvVxyzk6BamQ77tJlZSPHoPFyvdCQrPdKgAErFGTV6hTbg/viewform?usp=sf_link";
$report_url = home_url() . '/ap/report/' . $testAttemptId . '/?hashed_test_attempt_id=' . $hashedTestAttemptId;

if ($result) {
 if ($result->finished === "true") {
  $is_finished = true;
 }
} else {
 createTestAttempt($testAttemptId, $test_id);
}

if ($results) {
    foreach ($results as $row) {
     $hashedLabel     = getHashedTestAttemptId($row->test_attempt_label);
     $row->report_url = home_url() . '/ap/report/' . $row->test_attempt_label . '/?hashed_test_attempt_id=' . $hashedLabel;
    }
}

?>

<html>
    <?php startblock('head') ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
            <title>
               <?php startblock('title') ?>
                <?php endblock() ?>
            </title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
    <?php endblock() ?>

        <!-- BODY -->
        <?php startblock('body') ?>
        <?php endblock() ?>
        <!-- BODY END -->

</html>