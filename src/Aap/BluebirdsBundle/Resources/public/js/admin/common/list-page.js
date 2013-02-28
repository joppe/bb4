/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/view/list', 'core/view/confirm'],
    function ($, Bootstrap, Backbone, _, CoreList, Confirm) {
        'use strict';

        var List;

        List = Backbone.View.extend({
            events: {
                'click a.add': 'create',
                'click a.edit': 'edit',
                'click a.remove': 'remove'
            },

            initialize: function (options) {
                this.collection = options.collection;
                this.templateData = options.templateData;

                this.list = new CoreList({
                    collection: this.collection,
                    templateData: this.templateData
                });
            },

            render: function () {
                this.$el.html(this.list.render().el);
                return this;
            },

            getForm: function (model) {
                window.console('the getForm() method must be implemented', model);
            },

            create: function (event) {
                event.preventDefault();

                var ModelClass = this.collection.model,
                    form = this.getForm(new ModelClass());

                this.$el.prepend(form.render().el);
            },

            edit: function (event) {
                event.preventDefault();

                var $anchor = $(event.currentTarget),
                    model = this.collection.get($anchor.data('id')),
                    form = this.getForm(model);

                this.$el.prepend(form.render().el);
            },

            remove: function (event) {
                event.preventDefault();

                var self = this,
                    $anchor = $(event.currentTarget),
                    message = new Confirm({
                        templateData: this.templateData,
                        confirm: function () {
                            var model = self.collection.get($anchor.data('id'));

                            model.destroy({
                                error: function () {
                                    window.console.log('error while deleting model');
                                }
                            });
                        }
                    });

                this.$el.append(message.render().el);
            }
        });

        return List;
    }
);