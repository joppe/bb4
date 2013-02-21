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
                this.model.on('change:name', this.updateName, this);
            },

            render: function () {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            },

            updateName: function () {
                this.$el.find('td.name').text(this.model.get('name'));
            },

            unrender: function () {
                this.remove();
            }
        });

        return ListItem;
    }
);