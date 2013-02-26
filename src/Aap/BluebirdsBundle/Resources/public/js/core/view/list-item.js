/*global define*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore'],
    function ($, Bootstrap, Backbone, _) {
        'use strict';

        var ListItem;

        ListItem = Backbone.View.extend({
            tagName: 'tr',

            template: _.template($('#tmpl-list-item').html()),

            initialize: function () {
                this.model.on('destroy', this.unrender, this);
                this.model.on('change', this.render, this);
            },

            getTemplateData: function () {
                return this.model.toJSON();
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