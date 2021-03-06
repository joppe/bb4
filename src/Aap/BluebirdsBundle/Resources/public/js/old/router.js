/*global define*/

define(
    ['backbone', 'admin/club/list-page', 'admin/club/detail-page', 'admin/member/detail-page', 'admin/team/list-page', 'admin/position/list-page'],
    function (Backbone, ClubList, ClubDetail, MemberDetail, TeamList, PositionList) {
        'use strict';

        var Router;

        Router = Backbone.Router.extend({
            routes: {
                '': 'showClubs',
                'clubs': 'showClubs',
                'clubs/:id': 'showClub',
                'clubs/:club_id/member/:member_id': 'showMember',
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
                var detail = new ClubDetail({
                    id: id
                });
                this.$container.html(detail.render().el);
            },

            showMember: function (club_id, member_id) {
                var detail = new MemberDetail({
                    id: member_id
                });
                this.$container.html(detail.render().el);
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