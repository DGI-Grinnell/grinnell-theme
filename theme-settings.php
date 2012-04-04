<?php

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/
function grinnell_settings($saved_settings) {
  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the template.php file.
   */
  $defaults = array(
    'contact_form' => 1,
    'islandora_solr' => 1,
    'color_override' => '#cf2c27',
  );

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  // Create the form widgets using Forms API
  $form['grinnell'] = array(
    '#type' => 'fieldset',
    '#title' => t('Grinnell theme settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['grinnell']['contact_form'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable contact form in footer'),
    '#default_value' => $settings['contact_form'],
    '#description' => t('Enables the contact form in the footer like the one on <a href="!url">http://www.grinnell.edu/</a> . This requires the contact module to be enabled.', array('!url' => 'http://www.grinnell.edu/'))
  );
  $form['grinnell']['islandora_solr'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Islandora simple search'),
    '#default_value' => $settings['islandora_solr'],
    '#description' => t('Enables the Islandora solr simple search form in the navigation bar. This requires islandora_solr_search to be enabled.')
  );

  $form['grinnell']['banner'] = array(
    '#type' => 'fieldset',
    '#title' => t('Banner'),
    '#description' => t("A banner image replaces the default logo and site name."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['grinnell']['banner']['use_banner'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use a banner'),
    '#default_value' => $settings['use_banner'],
  );
  $form['grinnell']['banner']['stretch_banner'] = array(
    '#type' => 'checkbox',
    '#title' => t('Stretch banner'),
    '#default_value' => $settings['stretch_banner'],
    '#description' => t('Stretch the banner to full width (100%). This could be useful when the banner is 960px wide and the layout mode is fluid. Or when the banner is a bit smaller than 960px wide and needs to be stretched to full width.')
  );
  $form['grinnell']['banner']['banner_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to banner'),
    '#default_value' => $settings['banner_path'],
    '#description' => t('Use a relative path without a prefix slash when not using the upload form below.')
  );

  $form['grinnell']['banner']['banner_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload banner image'),
  );
  
  
  // Add Farbtastic color picker
  drupal_add_css('misc/farbtastic/farbtastic.css');
  drupal_add_js('misc/farbtastic/farbtastic.js');

  $form['grinnell']['color'] = array(
    '#type' => 'fieldset',
    '#title' => t('Color'),
    '#description' => t("Override the color of links and the islandora solr submit button."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['grinnell']['color']['use_color'] = array(
    '#type' => 'checkbox',
    '#title' => t('Override color'),
    '#default_value' => $settings['use_color'],
  );
  $form['grinnell']['color']['color_override'] = array(
    '#type' => 'textfield',
    '#title' => t('Color override'),
    '#default_value' => $settings['color_override'],
    '#description' => '<div id="colorpicker"></div>' .
      "<script type='text/javascript'>
        $(document).ready(function() {
          $('#colorpicker').farbtastic('#edit-color-override');
        });
       </script>",
  );

  
  
  $form['#submit'][] = 'grinnell_settings_submit';
  $form['grinnell']['banner']['banner_upload']['#element_validate'][] = 'grinnell_settings_submit';
  
  
  // Return the additional form widgets
  return $form;
}

/**
* Capture theme settings submissions and update uploaded image
*/
function grinnell_settings_submit($form, &$form_state) {
  // Check for a new uploaded file, and use that if available.
  if ($file = file_save_upload('banner_upload')) {
    $parts = pathinfo($file->filename);
    $filename = (! empty($key)) ? str_replace('/', '_', $key) .'_banner.'. $parts['extension'] : 'banner.'. $parts['extension'];

    // The image was saved using file_save_upload() and was added to the
    // files table as a temporary file. We'll make a copy and let the garbage
    // collector delete the original upload.
    if (file_copy($file, $filename)) {
      $_POST['use_banner'] = $form_state['values']['use_banner'] = TRUE;
      $_POST['banner_path'] = $form_state['values']['banner_path'] = $file->filepath;
    }
  }
}