/*global define*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Model;

    Model = Backbone.Model.extend({
        collections: {},

        parse: function (response, options) {
            var attributes = response;

            if (typeof response.error === 'boolean' && typeof response.result === 'object') {
                attributes = response.result;
            }

            _.each(this.collections, function (collection, name) {
                if (attributes[name]) {
                    _.each(attributes[name], function (data) {
                        var ModelClass = collection.model,
                            model = new ModelClass();

                        model.set(model.parse(data));
                        collection.add(model);
                    });

                    delete attributes[name];
                }
            });

            return attributes;
        }
    });

    return Model;
});