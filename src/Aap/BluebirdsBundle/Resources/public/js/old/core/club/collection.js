/*global define*/

define(['jquery', 'backbone', 'core/club/model'], function ($, Backbone, ClubModel) {
    'use strict';

    var Collection;

    Collection = Backbone.Collection.extend({
        model: ClubModel,

        url: '/admin/Club',

        parse: function (response) {
            return response.result;
        }
    });

    return Collection;
});