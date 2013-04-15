/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Confirm,
        defaults = {
            confirm: function () {},
            cancel: function () {}
        };

    Confirm = Backbone.View.extend({
        events: {
            'click a.confirm': 'confirm',
            'click a.cancel': 'cancel'
        },

        template: _.template($('#tmpl-confirm').html()),

        initialize: function (options) {
            _.defaults(options, defaults);

            this.templateData = options.templateData;
            this.confirmCallback = options.confirm;
            this.cancelCallback = options.cancel;
        },

        render: function () {
            this.$el.html(this.template({
                data: this.templateData
            }));

            this.$el.modal({
                keyboard: true,
                show: true
            });
            return this;
        },

        unrender: function () {
            this.$el.modal('hide');
            this.$el.remove();
        },

        confirm: function (event) {
            event.preventDefault();

            this.unrender();
            this.confirmCallback();
        },

        cancel: function (event) {
            event.preventDefault();

            this.unrender();
            this.cancelCallback();
        }
    });

    return Confirm;
});