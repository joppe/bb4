/*global define*/

define(['backbone', 'admin/club/list', 'admin/team/list'], function (Backbone, ClubList, TeamList) {
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
            var list = new TeamList();
            this.$container.html(list.render().el);
        }
    });

    return Router;
});