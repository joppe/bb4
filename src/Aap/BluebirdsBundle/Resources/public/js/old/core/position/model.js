/*global define*/

define(['jquery', 'backbone', 'core/model'], function ($, Backbone, CoreModel) {
    'use strict';

    var Position;

    Position = CoreModel.extend({
        defaults: {
            name: null,
            field_number: null,
            rating_weight: null
        },

        url: function () {
            return 'admin/Position/' + (this.isNew() ? 0 : this.get('id'));
        },

        initialize: function () {
            this.collections = {
                preferred_positon: [],
                player_positions: []
            };
        }
    });

    return Position;
});