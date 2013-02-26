/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/view/list-item', 'core/view/confirm'],
    function ($, Bootstrap, Backbone, _, ListItem, Confirm) {
        'use strict';

        var List;

        List = Backbone.View.extend({
            entityName: 'Generic',

            getColumns: function () {
                return [];
            },

            getForm: function (model) {
                alert('implement getForm!');
            },

            template: _.template($('#tmpl-list').html()),

            events: {
                'click a.add': 'showCreateForm',
                'click a.edit': 'showEditForm',
                'click a.remove': 'showRemovePopup'
            },

            initialize: function (options) {
                this.collection = options.collection;
                this.collection.on('reset', this.addListItems, this);
                this.collection.on('add', this.addListItem, this);
                this.collection.fetch();
            },

            render: function () {
                this.$el.html(this.template({
                    headers: this.getColumns(),
                    entityName: this.entityName
                }));
                return this;
            },

            addListItems: function () {
                var self = this;

                this.$el.find('tbody').empty();
                this.collection.each(function (model) {
                    self.addListItem(model);
                });
            },

            createListItem: function (model) {
                return new ListItem({
                    model: model
                });
            },

            addListItem: function (model) {
                var view = this.createListItem(model);
                this.$el.find('tbody').append(view.render().el);
            },

            showCreateForm: function (event) {
                var ModelClass = this.collection.model,
                    form = this.getForm(new ModelClass());

                event.preventDefault();

                this.$el.prepend(form.render().el);
            },

            showRemovePopup: function (event) {
                var self = this,
                    $anchor = $(event.currentTarget),
                    message = new Confirm({
                        entityName: this.entityName,
                        proceed: function () {
                            var model = self.collection.get($anchor.data('id'));

                            model.destroy({
                                error: function () {
                                    window.console.log('error while deleting model');
                                }
                            });
                        }
                    });

                event.preventDefault();

                this.$el.append(message.render().el);
            },

            showEditForm: function (event) {
                var $anchor = $(event.currentTarget),
                    model = this.collection.get($anchor.data('id')),
                    form = this.getForm(model);

                event.preventDefault();

                this.$el.prepend(form.render().el);
            }

        });

        return List;
    }
);