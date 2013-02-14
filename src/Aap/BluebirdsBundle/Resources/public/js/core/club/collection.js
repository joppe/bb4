/*global define*/

define(['jquery', 'backbone', 'core/club/model'], function ($, Backbone, ClubModel) {
    'use strict';

    var Collection;

    Collection = Backbone.Collection.extend({
        model: ClubModel,

        url: 'admin/Clubs'
    });

    return Collection;
});