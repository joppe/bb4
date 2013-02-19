/*global define*/

define(['jquery', 'backbone'], function ($, Backbone) {
    'use strict';

    var Team;

    Team = Backbone.Model.extend({
        defaults: {
            name: null,
            club_id: null
        },

        url: function () {
            return 'admin/Team/' + (this.isNew() ? 0 : this.get('id'));
        },

        initialize: function () {
            this.collections = {
                team_members: [],
                home_games: [],
                away_games: []
            };
        }
    });

    return Team;
});