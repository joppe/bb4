/*global define*/

define(['jquery', 'backbone'], function ($, Backbone, ClubCollection) {
    'use strict';

    var List;

    List = Backbone.View.extend({
        render: function () {
            return this;
        }
    });

    return List;
});