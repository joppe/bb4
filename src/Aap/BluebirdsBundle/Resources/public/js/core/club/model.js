/*global define*/

define(['jquery', 'backbone', 'core/model'], function ($, Backbone, CoreModel) {
    'use strict';

    var Club;

    Club = Backbone.Model.extend({
        defaults: {
            name: '',
            members: '', // TODO mode to collections property of Core.Model
            teams: '' // TODO mode to collections property of Core.Model
        },

        url: function () {
            return 'admin/Club/' + (this.isNew() ? 0 : this.get('id'));
        }
    });

    return Club;
});