/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Confirm;

    Confirm = Backbone.View.extend({
        events: {
            'click a.proceed': 'proceed',
            'click a.cancel': 'cancel'
        },

        template: _.template($('#tmpl-confirm').html()),

        render: function () {
            this.$el.html(this.template({
                entityName: this.options.entityName
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

        proceed: function () {
            if (this.options.proceed) {
                this.options.proceed();
            }
            this.unrender();
        },

        cancel: function () {
            if (this.options.cancel) {
                this.options.cancel();
            }
            this.unrender();
        }
    });

    return Confirm;
});