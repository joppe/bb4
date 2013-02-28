/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Confirm;

    Confirm = Backbone.View.extend({
        events: {
            'click a.confirm': 'confirm',
            'click a.cancel': 'cancel'
        },

        template: _.template($('#tmpl-confirm').html()),

        initialize: function (options) {
            this.templateData = options.templateData;
            this.confirm = options.confirm;
            this.cancel = options.cancel;
        },

        render: function () {
            this.$el.html(this.template(this.templateData));
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

        proceed: function (event) {
            event.preventDefault();

            if (typeof this.confirm === 'function') {
                this.confirm();
            }
            this.unrender();
        },

        cancel: function (event) {
            event.preventDefault();

            if (typeof this.cancel === 'function') {
                this.cancel();
            }
            this.unrender();
        }
    });

    return Confirm;
});