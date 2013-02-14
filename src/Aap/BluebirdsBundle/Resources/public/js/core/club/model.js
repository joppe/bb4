/*global define*/

define(['jquery', 'backbone', 'core/model'], function ($, Backbone, CoreModel) {
    'use strict';

    var Club;

    Club = CoreModel.extend({
        defaults: {
            name: '',
            memebers: '',
            teams: ''
        }
    });

    return Club;
});