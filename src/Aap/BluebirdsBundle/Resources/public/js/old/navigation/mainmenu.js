/*global define, window*/

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

            this.checkState();

            this.router.on('route', this.checkState, this);
        },

        checkState: function () {
            var name = window.location.hash ? window.location.hash.split('/')[0] : '';

            if (name === this.data.url) {
                this.$el.addClass('active');
            } else {
                this.$el.removeClass('active');
            }
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
            _.each(this.menuItems, this.createMenuItem, this);

            return this;
        },

        createMenuItem: function (menuItem) {
            var view = new MenuItem({
                data: menuItem,
                router: this.router
            });
            this.$el.append(view.render().el);
        }
    });

    return Menu;
});