/*global define*/

define(['jquery', 'backbone', 'core/position/model'], function ($, Backbone, PositionModel) {
    'use strict';

    var Collection;

    Collection = Backbone.Collection.extend({
        model: PositionModel,

        url: 'admin/Position',

        parse: function (response) {
            return response.result;
        }
    });

    return Collection;
});