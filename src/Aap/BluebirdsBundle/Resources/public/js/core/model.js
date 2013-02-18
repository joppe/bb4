/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Model;

    Model = Backbone.Model.extend({
        collections: null
    });

    return Model;
});