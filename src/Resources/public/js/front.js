require.config({
  "baseUrl": "/bundles/mmcfestival/js",
  "locale": "fr-FR",
  "paths": {
    "bootstrap": "lib/bootstrap.min",
    "bootstrap-dialog": "lib/bootstrap-dialog.min",
    "bootstrap-toggle": "lib/bootstrap-toggle.min",
    "jquery": "lib/jquery.min",
    "jquery-ui": "lib/jquery-ui.min",
    "card": "../../../bundles/mmccard/js/card.min",
    "jquery-ui-widget-card-toolbox": "../../../bundles/mmccard/js/jquery-ui-widget-card-toolbox.min",
    "jquery-ui-widget-card": "../../../bundles/mmccard/js/jquery-ui-widget-card.min"
  },
  "shim" : {
    "bootstrap": { "deps": ["jquery"] },
    "bootstrap-dialog" : { "deps": ["jquery", "bootstrap"] },
    "bootstrap-toggle": { "deps": ["jquery"] },
    "jquery-ui": { "deps": ["jquery"] }
  }
});

require(['jquery', 'jquery-ui', 'bootstrap', 'bootstrap-dialog', 'bootstrap-toggle', 'card'], function(
    $, ui, bs, bsd, bst, card
){
});
