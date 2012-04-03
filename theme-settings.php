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

  // Return the additional form widgets
  return $form;
}