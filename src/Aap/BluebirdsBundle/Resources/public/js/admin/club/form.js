/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Form;

    Form = Backbone.View.extend({
        id: 'club-form',

        template: _.template($('#tmpl-club-form').html()),

        events: {
            'keyup #field-name': 'updateName',
            'click button[type="submit"]': 'save',
            'click button[type="button"]': 'cancel'
        },

        unrender: function () {
            this.$el.remove();
        },

        initialize: function (options) {
            this.collection = options.collection;
        },

        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },

        updateName: function () {
            this.model.set('name', $('#field-name').val());
        },

        save: function (event) {
            var self = this;

            event.preventDefault();

            this.model.save(this.model.attributes, {
                success: function () {
                    self.collection.add(self.model);
                    self.unrender();
                },
                error: function () {
                    console.log('error');
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