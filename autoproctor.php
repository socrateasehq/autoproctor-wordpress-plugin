<?php
/**
 * Plugin Name: AutoProctor
 * Plugin URI: https://www.autoproctor.co/
 * Description:
 * Version: 1.0.0
 * Author: AutoProctor
 * Author URI: https://www.autoproctor.co/
 * Developer: AutoProctor
 * Developer URI: https://www.autoproctor.co/
 * Text Domain: autoproctor-proctoring
 * Domain Path: /languages
 */

define('AUTOPROCTOR_SETTING', 'AUTOPROCTOR_CONFIG');
require_once ABSPATH . "wp-includes/query.php";
require_once ABSPATH . "wp-includes/post-template.php";

if (!defined('ABSPATH')) {
 exit;
}

// Register activation hook
register_activation_hook(__FILE__, 'activate_ap_plugin');

function activate_ap_plugin()
{
 flush_rewrite_rules();
 autoproctor_create_table();
}

function generateRandomString($length = 10)
{
 $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $charactersLength = strlen($characters);
 $randomString     = '';
 for ($i = 0; $i < $length; $i++) {
  $randomString .= $characters[random_int(0, $charactersLength - 1)];
 }
 return $randomString;
}

function get_test_attempt_result($attempt_label, $test_id)
{
 global $wpdb;
 // Prepare the SQL query
 $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}ap_test_attempts WHERE test_attempt_label = %s AND test_num = %d", $attempt_label, $test_id);
 // Execute the query
 $result = $wpdb->get_row($query);
 // Return the result
 return $result;
}

// Activation hook callback function
function autoproctor_create_table()
{
 // Get access to the WordPress database
 global $wpdb;

 // Set the table name
 $table_name = $wpdb->prefix . 'ap_test_attempts';

 // SQL query to create the table
 $sql = "CREATE TABLE $table_name (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    test_num INT(11) NOT NULL,
    test_attempt_label VARCHAR(15) NOT NULL,
    started_at DATETIME DEFAULT NULL,
    finished_at DATETIME DEFAULT NULL,
    finished ENUM('true', 'false') NOT NULL DEFAULT 'false'
)";

 // Execute the query
 require_once ABSPATH . 'wp-admin/includes/upgrade.php';
 dbDelta($sql);
}

function createTestAttempt($testAttemptLabel, $testNum)
{
 global $wpdb;

// Set the table name
 $table_name = $wpdb->prefix . 'ap_test_attempts';

// Prepare the data for insertion
 $data = array(
  'test_num'           => $testNum,
  'test_attempt_label' => $testAttemptLabel,
 );

// Insert the data into the table
 $wpdb->insert($table_name, $data);
}

function markAttemptAsFinished($test_attempt_label)
{
 // Get access to the WordPress database
 global $wpdb;
 $current_datetime = date('Y-m-d H:i:s');
// Set the table name
 $table_name = $wpdb->prefix . 'ap_test_attempts';

 $wpdb->update($table_name, array('finished' => 'true', 'finished_at' => $current_datetime), array('test_attempt_label' => $test_attempt_label));

}

function markAttemptAsStarted($test_attempt_label)
{
 // Get access to the WordPress database
 global $wpdb;
// Set the table name
 $table_name = $wpdb->prefix . 'ap_test_attempts';

 $query = $wpdb->prepare("
 SELECT
     IF(started_at IS NULL, 'null', 'not null') AS started_at_status
 FROM
     $table_name
 WHERE
     test_attempt_label = %s
", $test_attempt_label);

// Execute the query
 $started_at_status = $wpdb->get_var($query);

// Check the result
 if ($started_at_status === 'null') {
  // Set the test_attempt_label value for the row you want to update
  $current_datetime = date('Y-m-d H:i:s');
  // Update the 'finished' column to 'true' for the specific test_attempt_label
  $wpdb->update($table_name, array('started_at' => $current_datetime), array('test_attempt_label' => $test_attempt_label));
 }

}

function getAllAttemptsDataByTestId($test_num)
{
 // Get access to the WordPress database
 global $wpdb;

 $table_name = $wpdb->prefix . 'ap_test_attempts';

 // Prepare the SQL query with the test_num condition
 $query = $wpdb->prepare("SELECT * FROM {$table_name} WHERE test_num = %d AND id > %d", $test_num, 3325);

 // Execute the query
 $results = $wpdb->get_results($query);

// Process the results
 $autoproctor_plugin_settings = get_option('autoproctor_settings');
 $clientId                    = $autoproctor_plugin_settings['client_id'];
 $clientSecret                = $autoproctor_plugin_settings['client_secret'];
 $isDevelopmentMode           = isset($autoproctor_plugin_settings['development_mode']) ? true : false;
 $url                         = $isDevelopmentMode ? "http://www.staging.autoproctor.co/api/v1/test-results/" : 'https://www.autoproctor.co/api/v1/test-results/';
 $tenantTestAttemptIds        = [];
 if (count($results)) {
  foreach ($results as $data) {
   if ($data->started_at) {
    $tenantTestAttemptIds[] = $data->test_attempt_label;
   }
  }

  if (count($tenantTestAttemptIds)) {
   $post_data = array(
    "tenantTestAttemptIds" => $tenantTestAttemptIds,
   );

   $credentials_string = $clientId . ":" . $clientSecret;
   $base64_string      = base64_encode($credentials_string);
   $result_scores      = wp_remote_post(
    $url,
    array(
     'body'    => wp_json_encode($post_data),
     'headers' => "Content-Type: application/json\r\n" . "Authorization: AP " . $base64_string . "\r\n",
    )
   );

   $json_body    = json_decode($result_scores['body']);
   $test_results = [];
   if ($json_body->status === "success") {
    $test_results = $json_body->results;
   } elseif ($json_body->status === "error") {
    die($json_body->errorMsg);
   }
   return $test_results;
  } else {
   return [];
  }
 } else {
  return $results;
 }
}

// AJAX action callback function
function mark_test_attempt_finished_callback()
{
 // Retrieve the passed parameter
 $attempt_label = $_POST['testAttemptLabel']; // Replace 'param1' with the actual parameter name

 markAttemptAsFinished($attempt_label);
 // Process the AJAX request and generate a response
 $response = array(
  'message' => 'Attempt Marked As Finished!',
 );

 // Send the JSON-encoded response
 wp_send_json($response);
}

add_action('wp_ajax_mark_test_attempt_finished', 'mark_test_attempt_finished_callback');
add_action('wp_ajax_nopriv_mark_test_attempt_finished', 'mark_test_attempt_finished_callback');

function mark_test_attempt_started_callback()
{
 // Retrieve the passed parameter
 $attempt_label = $_POST['testAttemptLabel']; // Replace 'param1' with the actual parameter name

 markAttemptAsStarted($attempt_label);
 // Process the AJAX request and generate a response
 $response = array(
  'message' => 'Attempt Marked As Started!',
 );

 // Send the JSON-encoded response
 wp_send_json($response);
}
add_action('wp_ajax_mark_test_attempt_started', 'mark_test_attempt_started_callback');
add_action('wp_ajax_nopriv_mark_test_attempt_started', 'mark_test_attempt_started_callback');

add_action('init', 'autoproctor_register_routes');

function autoproctor_register_routes()
{
 global $wp_rewrite;
 add_rewrite_rule('^ap/instructions/?$', 'index.php?my_custom_route=1', 'top');
 add_rewrite_rule('^ap/dummy-tests/([^/]+)/([^/]+)/?$', 'index.php?my_custom_route=2&test_id=$matches[1]&attempt_label=$matches[2]', 'top');
 add_rewrite_rule('^ap/results/([^/]+)/?$', 'index.php?my_custom_route=4&test_id=$matches[1]', 'top');
 add_rewrite_rule('^ap/report/([^/]+)/?$', 'index.php?my_custom_route=5&attempt_label=$matches[1]', 'top');
 add_rewrite_rule('^ap-docs?$', 'index.php?my_custom_route=6', 'top');
 flush_rewrite_rules();

}

add_filter('query_vars', function ($query_vars) {
 $query_vars[] = 'my_custom_route';
 $query_vars[] = 'test_id';
 $query_vars[] = 'attempt_label';
 $query_vars[] = 'hashed_test_attempt_id';
 return $query_vars;
});

add_filter('template_include', 'renderAutoProctorTemplate', 99);

function renderAutoProctorTemplate($template)
{
 $custom_route  = get_query_var('my_custom_route');
 $attempt_label = get_query_var('attempt_label');
 $test_id       = get_query_var('test_id');

 if ($custom_route === '1') {
  $new_template = plugin_dir_path(__FILE__) . '/includes/frontend/instructions.php';

  if (file_exists($new_template)) {
   return $new_template;
  }
 } elseif ($custom_route === '2') {
  $new_template = plugin_dir_path(__FILE__) . '/includes/frontend/tests.php';

  if (file_exists($new_template)) {
   return $new_template;
  }
 } elseif ($custom_route === '4' && $test_id) {
  $new_template = plugin_dir_path(__FILE__) . '/includes/frontend/results.php';
  if (file_exists($new_template)) {
   return $new_template;
  }
 } elseif ($custom_route === "5") {
  $new_template = plugin_dir_path(__FILE__) . '/includes/frontend/report.php';
  if (file_exists($new_template)) {
   return $new_template;
  }
 } elseif ($custom_route === "6") {
  $new_template = plugin_dir_path(__FILE__) . '/includes/frontend/ap-docs.php';
  if (file_exists($new_template)) {
   return $new_template;
  }
 }

 return $template;
}

function autoproctor_add_settings_menu()
{
 add_menu_page(
  'Configuration',
  __('AutoProctor', 'autoproctor-proctoring'),
  'manage_options', // User Capability
  'autoproctor_setting', // Page slug
  'autoproctor_setting_call', // Call to this page for the content of the page
  'dashicons-admin-tools',
  100
 );
}

add_action('admin_menu', 'autoproctor_add_settings_menu');

function show_checkbox_type_field_ap($args)
{
 ?>
       <input type="checkbox" id=<?php echo $args['id']; ?> name=<?php echo $args['name']; ?> <?php if ($args['value'] == 1) {
  echo 'checked';
 }
 ?> value="1">
       <label for=<?php echo $args['id']; ?>><?php echo $args['label']; ?></label>
   <?php
}

function show_text_type_field_ap($args)
{
 ?>
       <input type="text" style="width:60%" id=<?php echo $args['id']; ?> name=<?php echo $args['name']; ?> value="<?php echo $args['value'] ?>">
   <?php
}

function autoproctor_register_settings()
{
 include plugin_dir_path(__FILE__) . 'includes/admin/setting_sections.php';

 include plugin_dir_path(__FILE__) . 'includes/admin/autoproctor_setting_section_fields.php';

 register_setting(
  'autoproctor_settings',
  'autoproctor_settings'
 );
}

add_action('admin_init', 'autoproctor_register_settings');

function autoproctor_general_setting_section_text()
{
 echo '';
}

include plugin_dir_path(__FILE__) . 'includes/admin/autoproctor_setting_fields.php';

function autoproctor_menus_setting_call()
{
 ?>
    <form method="post" action="options.php" enctype='multipart/form-data'>
            <?php settings_fields('autoproctor_menu_settings'); ?>
            <?php do_settings_sections('autoproctor_menu'); ?>
            <?php submit_button(__('Save Changes', 'autoproctor-proctoring'), 'primary', 'autoproctor-save-menu-settings', true, array('id' => 'autoproctor-save-menu-settings')); ?>
    </form>
    <?php
}

function autoproctor_setting_call()
{
 ?>
    <form method="post" action="options.php" enctype='multipart/form-data'>
            <?php settings_fields('autoproctor_settings'); ?>
            <?php do_settings_sections('autoproctor'); ?>
            <?php submit_button(__('Save Changes', 'autoproctor-proctoring'), 'primary', 'autoproctor-save-autoproctor-login-settings', true, array('id' => 'autoproctor-save-autoproctor-login-settings')); ?>
    </form>
    <?php
}

function getHashedTestAttemptId($test_attempt_id)
{
 $autoproctor_plugin_settings = get_option('autoproctor_settings');
 $clientSecret                = $autoproctor_plugin_settings['client_secret'];
 $string_to_hash              = $test_attempt_id . $clientSecret;
 $string_to_hash              = mb_convert_encoding($string_to_hash, 'UTF-8');
 $hashed_string               = hash('sha256', $string_to_hash);
 return $hashed_string;
}