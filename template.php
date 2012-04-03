<?php

function grinnell_preprocess_page(&$vars) {
  
  // link and logo to grinnell college site
  $vars['grinnell_home'] = l(t('Grinnell College'), 'http://www.grinnell.edu/', array('attributes' => array('class' => 'grinnell-home', 'title' => t('Grinnell College'))));
  
  dsm($vars);
  
  
  
}