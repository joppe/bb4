/*global define, window*/

define(
    ['backbone', 'core/team/collection', 'admin/team/list'],
    function (Backbone, TeamCollection, TeamList) {
        'use strict';

        var List;

        List = Backbone.View.extend({
            id: 'team-list',

            initialize: function (options) {
                this.teams = new TeamCollection();
            },

            render: function () {
                var teamList = new TeamList({
                    collection: this.teams
                });

                this.$el.append(teamList.render().el);
                this.teams.fetch();

                return this;
            }
        });

        return List;
    }
);