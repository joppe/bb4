/*global define*/

define(['jquery', 'backbone', 'core/model'], function ($, Backbone, CoreModel) {
    'use strict';

    var Club;

    Club = CoreModel.extend({
        defaults: {
            name: ''
        },

        url: function () {
            return 'admin/Club/' + (this.isNew() ? 0 : this.get('id'));
        },

        initialize: function () {
            this.collections = {
                members: [],
                teams: []
            };
        }
    });

    return Club;
});