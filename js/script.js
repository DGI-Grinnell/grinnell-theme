// Adds placeholder text in the islandora solr simple search form
Drupal.behaviors.islandoraSearchVal = function (context) {
  
  $('.islandora-solr-search-simple #edit-islandora-simple-search-query', context).val(Drupal.t('Repository Search'));

  $('.islandora-solr-search-simple #edit-islandora-simple-search-query', context).focus(function() {

      if ($(this).val() == Drupal.t('Repository Search')) $(this).val('');

  });

  $('.islandora-solr-search-simple #edit-islandora-simple-search-query', context).blur(function() {

      if ($(this).val() == '') $(this).val(Drupal.t('Repository Search'));

  });
};

// Footer contact form slide functionality
Drupal.behaviors.islandoraSearchVal = function (context) {
  
  var contactString = Drupal.t('Grinnell College Contact Information');
  var contactStringUp = '^ ' + contactString + ' ^';
  var contactStringDown = 'v ' + contactString + ' v';
  
  $('.contact-form-link-wrapper a', context).click(function () {
    $('#contact-form-drawer').slideToggle('normal');
    
    if ($(this).html() == contactStringUp) {
      $(this).html(contactStringDown);
    }
    else {
      $(this).html(contactStringUp);
    }
    
    return false;
  });
  
  
  
};