/*global define, window*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Form;

    Form = Backbone.View.extend({
        id: 'position-form',

        template: _.template($('#tmpl-position-form').html()),

        events: {
            'click a.btn-primary': 'save',
            'click a.btn': 'cancel',
            'click button.close': 'cancel'
        },

        unrender: function () {
            this.$el.modal('hide');
            this.remove();
        },

        initialize: function (options) {
            this.collection = options.collection;
        },

        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            this.$el.modal({
                keyboard: true,
                show: true
            });
            return this;
        },

        save: function (event) {
            var self = this;

            event.preventDefault();

            this.model.set('name', $('#field-name').val());
            this.model.set('field_number', $('#field-field_number').val());
            this.model.set('rating_weight', $('#field-rating_weight').val());

            this.model.save(this.model.attributes, {
                success: function (model, response) {
                    self.collection.add(response.result);
                    self.unrender();
                },
                error: function () {
                    window.console.log('error');
                }
            });
        },

        cancel: function (event) {
            event.preventDefault();

            this.unrender();
        }
    });

    return Form;
});