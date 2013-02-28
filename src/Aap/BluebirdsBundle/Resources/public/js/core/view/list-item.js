/*global define*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore'],
    function ($, Bootstrap, Backbone, _) {
        'use strict';

        var ListItem,
            defaults = {
                templateSelector: '#tmpl-list-item',
                templateData: null
            };

        ListItem = Backbone.View.extend({
            tagName: 'tr',

            initialize: function (options) {
                _.defaults(options, defaults);

                this.template = _.template($(options.templateSelector).html());
                this.templateData = options.templateData;

                this.model.on('destroy', this.unrender, this);
                this.model.on('change', this.render, this);
            },

            getTemplateData: function () {
                var data = _.clone(this.model.attributes);

                _.defaults(data, this.templateData);

                return data;
            },

            render: function () {
                this.$el.html(this.template(this.getTemplateData()));
                return this;
            },

            unrender: function () {
                this.remove();
            }
        });

        return ListItem;
    }
);