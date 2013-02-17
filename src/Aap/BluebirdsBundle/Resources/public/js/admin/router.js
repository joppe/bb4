/*global define*/

define(['backbone', 'admin/club/list'], function (Backbone, ClubList) {
    'use strict';

    var Router;

    Router = Backbone.Router.extend({
        routes: {
            '': 'showClubs',
            'clubs': 'showClubs',
            'teams': 'showTeams'
        },

        initialize: function (options) {
            this.$container = options.$container;
        },

        showClubs: function () {
            console.log('Router: showClubs');
            var list = new ClubList();
            this.$container.html(list.render().el);
        },

        showTeams: function () {
            console.log('Router: showTeams');
        }
    });

    return Router;
});