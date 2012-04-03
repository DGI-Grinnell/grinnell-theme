<?php
/**
 * Template.php: template overrides and preprocess functions go here.
 */


/**
 * template_preprocess_page()
 */
function grinnell_preprocess_page(&$variables) {
  
  // link and logo to grinnell college site
  $variables['grinnell_home'] = l(t('Grinnell College'), 'http://www.grinnell.edu/', array('attributes' => array('class' => 'grinnell-home', 'title' => t('Grinnell College'))));
  
  // check if the option is checked and if islandora_solr_search is enabled
  if (theme_get_setting('islandora_solr') == 1 AND module_exists('islandora_solr_search')) {
    $variables['islandora_solr_search_simple'] = drupal_get_form('islandora_solr_simple_search_form');
  }
  
  // check if the option is checked and if islandora_solr_search is enabled
  if (theme_get_setting('contact_form') == 1 AND module_exists('contact')) {
    $variables['contact_form'] = _grinnell_contact_form();
  }
  
  
  //dsm($variables);
  
  
  
}



function _grinnell_contact_form() {
  // set string for contact pull down string
  $contact_string = t('Grinnell College Contact Information');
  $contact_full_string = 'v ' . $contact_string . ' v';
  
  $output = '';

  // contact form drawer
  $output .= '<div id="contact-form-drawer">';
  // include contact form file
  module_load_include('inc', 'contact', 'contact.pages');
  // get contact form
  $output .= drupal_get_form('contact_mail_page');
  $output .= '</div>';
  
  // pull down link
  $output .= '<div class="contact-form-link-wrapper">';
  $output .= l($contact_full_string, '#', array('attributes' => array('class' => 'closed')));
  $output .= '</div>';
  
  // Add the string as a js setting
  //drupal_add_js(array('grinnell-theme' => array('contact_string' => $contact_string) ), 'setting');
  
  return $output;
}