require(['jquery', 'jquery-ui-widget-paginate'], function(
    $, paginateWidget
){
    $('#activites').paginateWidget({
        newPageSelector: '#activites',
        effect: 'fade',
        targetSelector: '.location-for-next-page',
        callback: function(new_page) {
            $('.card', new_page).cardWidget();
        }
    });
});
