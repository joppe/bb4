/*global define*/

define(
    ['jquery', 'backbone', 'underscore'],
    function ($, Backbone, _) {
        'use strict';

        var ListItem;

        ListItem = Backbone.View.extend({
            tagName: 'tr',

            template: _.template($('#tmpl-list-item').html()),

            templateData: {},

            initialize: function () {
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