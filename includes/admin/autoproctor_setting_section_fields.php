<?php

$autoproctor_settings = get_option('autoproctor_settings');

$wp_pages_array = get_pages();

add_settings_field(
 'enable_development_mode',
 __('Enable Development Mode', 'autoproctor-elearning'),
 'show_checkbox_type_field_ap',
 'autoproctor',
 'autoproctor_setting',
 [
  'id'    => 'autoproctor_login_development_mode',
  'name'  => 'autoproctor_settings[development_mode]',
  'label' => __('', 'autoproctor-elearning'),
  'value' => isset($autoproctor_settings['development_mode']) ? $autoproctor_settings['development_mode'] : 0,
 ]
);

add_settings_field(
 'autoproctor_client_id',
 __('Tenant Client Id', 'autoproctor-elearning'),
 'show_text_type_field_ap',
 'autoproctor',
 'autoproctor_setting',
 [
  'id'    => 'autoproctor_setting_client_id',
  'name'  => 'autoproctor_settings[client_id]',
  'value' => isset($autoproctor_settings['client_id']) ? $autoproctor_settings['client_id'] : '',
 ]
);

add_settings_field(
 'autoproctor_client_secret',
 __('Tenant Client Secret', 'autoproctor-elearning'),
 'show_text_type_field_ap',
 'autoproctor',
 'autoproctor_setting',
 [
  'id'    => 'autoproctor_setting_client_secret',
  'name'  => 'autoproctor_settings[client_secret]',
  'value' => isset($autoproctor_settings['client_secret']) ? $autoproctor_settings['client_secret'] : '',
 ]
);
