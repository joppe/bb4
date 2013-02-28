/*global define, window*/

define(
    ['jquery', 'backbone', 'underscore', 'core/view/list-item'],
    function ($, Backbone, _, ListItem) {
        'use strict';

        var List,
            defaults = {
                templateSelector: '#tmpl-list',
                itemTemplateSelector: null,
                templateData: null
            };

        List = Backbone.View.extend({
            initialize: function (options) {
                _.defaults(options, defaults);

                this.template = _.template($(options.templateSelector).html());
                this.templateData = options.templateData;
                this.itemTemplateSelector = options.itemTemplateSelector;

                this.collection = options.collection;
                this.collection.on('reset', this.addListItems, this);
                this.collection.on('add', this.addListItem, this);
            },

            render: function () {
                this.$el.html(this.template({
                    data: this.templateData
                }));

                this.addListItems();

                return this;
            },

            addListItems: function () {
                this.$el.find('tbody').empty();
                this.collection.each(this.addListItem, this);
            },

            addListItem: function (model) {
                var view = this.createListItem(model);
                this.$el.find('tbody').append(view.render().el);
            },

            createListItem: function (model) {
                return new ListItem({
                    model: model,
                    templateSelector: this.itemTemplateSelector,
                    templateData: this.templateData
                });
            }
        });

        return List;
    }
);