/*global define*/

define(['jquery', 'backbone', 'core/club/collection'], function ($, Backbone, ClubCollection) {
    'use strict';

    var List;

    List = Backbone.View.extend({
        id: 'club-list',

        initialize: function (options) {
            console.log('List');
            this.clubs = new ClubCollection();

            this.clubs.fetch();
        },

        render: function () {
            return this;
        }
    });

    return List;
});