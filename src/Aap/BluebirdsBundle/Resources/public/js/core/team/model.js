/*global define*/

define(['jquery', 'backbone'], function ($, Backbone) {
    'use strict';

    var Team;

    Team = Backbone.Model.extend({
        defaults: {

        },

        url: function () {
            return 'admin/Team/0';
        }
    });

    return Team;
});