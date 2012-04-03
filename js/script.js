Drupal.behaviors.islandoraSearchVal = function (context) {
  
  $('.islandora-solr-search-simple #edit-islandora-simple-search-query', context).val(Drupal.t('Repository Search'));

  $('.islandora-solr-search-simple #edit-islandora-simple-search-query', context).focus(function() {

      if ($(this).val() == Drupal.t('Repository Search')) $(this).val('');

  });

  $('.islandora-solr-search-simple #edit-islandora-simple-search-query', context).blur(function() {

      if ($(this).val() == '') $(this).val(Drupal.t('Repository Search'));

  });
};