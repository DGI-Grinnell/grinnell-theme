// Adds placeholder text in the islandora solr simple search form
Drupal.behaviors.islandoraSearchVal = function (context) {
  
  $('.islandora-solr-search-simple input.form-text', context).val(Drupal.t('Repository Search'));

  $('.islandora-solr-search-simple input.form-text', context).focus(function() {

      if ($(this).val() == Drupal.t('Repository Search')) $(this).val('');

  });

  $('.islandora-solr-search-simple input.form-text', context).blur(function() {

      if ($(this).val() == '') $(this).val(Drupal.t('Repository Search'));

  });
};

// Footer contact form slide functionality
Drupal.behaviors.contactToggle = function (context) {
  
  var contactString = Drupal.t('Grinnell College Contact Information');
  var contactStringUp = '^ ' + contactString + ' ^';
  var contactStringDown = 'v ' + contactString + ' v';
  
  $('.contact-form-link-wrapper a', context).click(function (e) {
    $('#contact-form-drawer').slideToggle('normal');
    
    if ($(this).html() == contactStringUp) {
      $(this).html(contactStringDown);
    }
    else {
      $(this).html(contactStringUp);
    }
    
    e.preventDefault();
  });
  
  
  
};