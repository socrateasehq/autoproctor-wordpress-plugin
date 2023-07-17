<?php

function autoproctor_setting_section_text()
{

 if (isset($_REQUEST['settings-updated'])) {
  echo '<div class="notice notice-success is-dismissible">
            <p><strong>Settings has been updated successfully.</strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>';
 }
 ?>

    <script>

        var empty_client_id = "<?php echo __('Client Id can not be empty', 'autoproctor-elearning'); ?>";
        var empty_client_secret = "<?php echo __('Client Secret can not be empty', 'autoproctor-elearning'); ?>";
    </script>
    <?php
}
