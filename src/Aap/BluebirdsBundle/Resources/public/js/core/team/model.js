/*global define*/

define(
    ['jquery', 'backbone', 'core/model'],
    function ($, Backbone, CoreModel) {
        'use strict';

        var Team;

        Team = CoreModel.extend({
            defaults: {
                name: null,
                club_id: null
            },

            url: function () {
                return 'admin/Team/' + (this.isNew() ? 0 : this.get('id'));
            },

            initialize: function () {
    //            this.collections = {
    //                team_members: [],
    //                home_games: [],
    //                away_games: []
    //            };
            }
        });

        return Team;
    }
);