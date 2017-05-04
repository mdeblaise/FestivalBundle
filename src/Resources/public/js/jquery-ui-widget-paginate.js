define(['jquery', 'jquery-ui', 'i18n/fr_FR', 'bootstrap-dialog'], function(
    $, ui, lang, BootstrapDialog
) {
    $.widget( "jtf.paginateWidget", {
        link: null,
        options: {
            newPageSelector: '',
            effect: 'slow',
            callback: null,
            targetSelector: null
        },
        _create: function() {
            this.enable();
        },
        enable: function() {
            this.link = this.element.find('.see-more');

            this._on(this.link, {
                'click': '_click'
            });
        },
        disable: function() {
            this._off(this.link, 'click');
        },
        _destroy: function() {
            this.disable();
        },
        _click: function(event) {
            event.preventDefault();

            if (this.jqXHR) {
                this.jqXHR.abort();
            }

            var that = this;

            this.jqXHR = $.ajax({
                url: this.link.attr('href'),
                method: 'get',
                dataType: 'html'
            });

            this.jqXHR.done(function(data, textStatus, jqXHR) {
                that.jqXHR = null;
            });
            this.jqXHR.fail(function(jqXHR, textStatus, errorThrown) {
                BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_DANGER,
                    title: lang.paginate.error_title,
                    message: lang.paginate.error
                });
            });

            this.jqXHR.success(function(data, textStatus, jqXHR) {
                that.disable();

                var new_page = data;
                if (that.options.newPageSelector) {
                    var html = $('<div>')
                        .html(data);
                    new_page =  html.find(that.options.newPageSelector).html();
                }

                new_page = $(new_page)
                    .hide();

                var target = that.link;

                if (that.options.targetSelector) {
                    target = that.element.find(that.options.targetSelector);
                }

                target.replaceWith(new_page);

                if (that.options.callback) {
                    that.options.callback.call(that, new_page);
                }

                new_page.show(that.options.effect);

                that.enable();
            });
        }
    });
});
