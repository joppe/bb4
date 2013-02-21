/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Model;

    Model = Backbone.Model.extend({
        collections: null,

        parse: function (response, options) {
            var attributes = response;

            if (typeof response.error === 'boolean' && typeof response.result === 'object') {
                attributes = response.result;
            }

            return attributes;
        }
    });

    return Model;
});