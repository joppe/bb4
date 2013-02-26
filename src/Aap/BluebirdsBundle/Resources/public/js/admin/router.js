/*global define*/

define(
    ['backbone', 'admin/club/list', 'admin/team/list', 'admin/position/list'],
    function (Backbone, ClubList, TeamList, PositionList) {
        'use strict';

        var Router;

        Router = Backbone.Router.extend({
            routes: {
                '': 'showClubs',
                'clubs': 'showClubs',
                'clubs/:id': 'showClub',
                'teams': 'showTeams',
                'positions': 'showPositions'
            },

            initialize: function (options) {
                this.$container = options.$container;
            },

            showClubs: function () {
                var list = new ClubList();
                this.$container.html(list.render().el);
            },

            showClub: function (id) {
//                var list = new ClubList();
//                this.$container.html(list.render().el);
            },

            showTeams: function () {
                var list = new TeamList();
                this.$container.html(list.render().el);
            },

            showPositions: function () {
                var list = new PositionList();
                this.$container.html(list.render().el);
            }
        });

        return Router;
    }
);