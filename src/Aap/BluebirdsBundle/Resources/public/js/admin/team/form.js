/*global define, window*/

define(
    ['jquery', 'backbone', 'underscore'],
    function ($, Backbone, _) {
        'use strict';

        var Form;

        Form = Backbone.View.extend({
            id: 'team-form',

            template: _.template($('#tmpl-team-form').html()),

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
                this.clubs = options.clubs;
            },

            render: function () {
                var attributes = this.model.toJSON();
                attributes.clubs = this.clubs;
console.log(attributes);
                this.$el.html(this.template(attributes));
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
                this.model.set('club_id', $('#field-club').val());

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
    }
);