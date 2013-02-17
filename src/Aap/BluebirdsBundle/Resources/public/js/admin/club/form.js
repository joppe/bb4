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

            this.model.save({
                success: function () {
                    console.log('__');
                    console.log(arguments);
//                    self.collection.add();
                },
                error: function () {
                    console.log('error');
                }
            });
            //this.unrender();
        },

        cancel: function (event) {
            event.preventDefault();

            this.unrender();
        }
    });

    return Form;
});