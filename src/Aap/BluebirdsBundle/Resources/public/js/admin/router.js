/*global define*/

define(['backbone', 'admin/club/list'], function (Backbone, ClubList) {
    'use strict';

    var Router;

    Router = Backbone.Router.extend({
        routes: {
            '': 'showClubs',
            'clubs': 'showClubs',
            'club/:id': 'showClub',
            'teams': 'showTeams',
            'team/:id': 'showTeam'
        },

        initialize: function (options) {
            this.$container = options.$container;
        },

        showClubs: function () {
            console.log('showClubs');
            var list = new ClubList();
            this.$container.html(list.render().el);
        },

        showClub: function (clubId) {
            console.log('showClub ' + clubId);
        },

        showTeams: function () {
            console.log('showTeams');
        },

        showTeam: function (teamId) {
            console.log('showTeam ' + teamId);
        }
    });

    return Router;
});