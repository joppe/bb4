/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Menu,
        MenuItem;

    MenuItem = Backbone.View.extend({
        tagName: 'li',

        template: _.template($('#tmpl-menu-item').html()),

        initialize: function (options) {
            this.data = options.data;
            this.router = options.router;
        },

        render: function () {
            this.$el.html(this.template(this.data));
            return this;
        }
    });

    Menu = Backbone.View.extend({
        tagName: 'ul',

        className: 'nav',

        initialize: function (options) {
            this.menuItems = options.menuItems;
            this.router = options.router;
        },

        render: function () {
            var self = this;

            _.each(this.menuItems, function (menuItem) {
                var view = new MenuItem({
                    data: menuItem,
                    router: self.router
                });
                self.$el.append(view.render().el);
            });

            return this;
        }
    });

    return Menu;
});