<?php require_once 'ti.php' ?>

<?php
$testAttemptId               = $_GET['testAttemptId'];
$autoproctor_plugin_settings = get_option('autoproctor_settings');
$clientId                    = $autoproctor_plugin_settings['client_id'];
$clientSecret                = $autoproctor_plugin_settings['client_secret'];
$isDevelopmentMode           = isset($autoproctor_plugin_settings['development_mode']) ? true : false;
$domain                      = $isDevelopmentMode ? "https://staging.autoproctor.co" : "https://www.autoproctor.co";
$ajax_url                    = admin_url('admin-ajax.php');
$hashedTestAttemptId = getHashedTestAttemptId($testAttemptId);
?>

<html>
    <?php startblock('head') ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
            <?php
echo '<link rel="stylesheet" href="' . esc_url(plugins_url('utils/style.css', dirname(__FILE__))) . '" >';
?>
            <title>
               <?php startblock('title') ?>
                <?php endblock() ?>
            </title>
			<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            <style>
                #frontCameraStreamHTMLElement{
                    width: 60vw !important;
                    height: auto !important;
                    margin: auto !important;
                    position: relative !important;
                    left:0 !important; bottom:0 !important;
                }
                #ap-preview-camera-close{
                    display:none !important;
                }
            </style>
        </head>
    <?php endblock() ?>

        <!-- BODY -->
        <?php startblock('body') ?>
        <?php endblock() ?>
        <!-- BODY END -->

</html>