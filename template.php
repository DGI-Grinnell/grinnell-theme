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
  
  if (theme_get_setting('islandora_solr') == 1) {
    $variables['islandora_solr_search_simple'] = drupal_get_form('islandora_solr_simple_search_form');
  }
  else {
    $variables['islandora_solr_search_simple'] = '';
  }
  
  
  $contact_form = theme_get_setting('contact_form');
  
  $variables['contact_form'] = 'contact_form';
  
  
  //dsm($variables);
  
  
  
}