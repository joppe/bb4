/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/view/confirm', 'core/view/list-item'],
    function ($, Bootstrap, Backbone, _, Confirm, CoreListItem) {
        'use strict';

        var ListItem;

        ListItem = CoreListItem.extend({
            templateData: {},

            events: {
                'click a.edit': 'editItem',
                'click a.remove': 'removeItem'
            },

            createForm: function (model) {
                window.console.log('the createForm() method must be implemented');
            },

            editItem: function (event) {
                event.preventDefault();

                var form = this.createForm(this.model);

                $('body').prepend(form.render().el);
            },

            removeItem: function (event) {
                event.preventDefault();

                var self = this,
                    message = new Confirm({
                        templateData: this.templateData,
                        confirm: function () {
                            self.model.destroy({
                                error: function () {
                                    window.console.log('error while deleting model');
                                }
                            });
                        }
                    });

                $('body').append(message.render().el);
            }
        });

        return ListItem;
    }
);