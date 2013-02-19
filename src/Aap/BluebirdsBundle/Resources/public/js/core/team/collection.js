/*global define*/

define(['jquery', 'backbone', 'core/team/model'], function ($, Backbone, TeamModel) {
    'use strict';

    var Collection;

    Collection = Backbone.Collection.extend({
        model: TeamModel,

        url: 'admin/Team',

        parse: function (response) {
            return response.result;
        }
    });

    return Collection;
});