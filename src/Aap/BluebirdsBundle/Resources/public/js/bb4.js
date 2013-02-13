/*global requirejs, require, window*/

requirejs.config({
    paths: {
        jquery: '3rd-party/jquery-1.9.0.min',
        backbone: '3rd-party/backbone-min',
        underscore: '3rd-party/underscore-min',
        json: '3rd-party/json2'
    },
    shim: {
        backbone: {
            deps: ['underscore', 'jquery', 'json'],
            exports: 'Backbone'
        },
        underscore: {
            exports: '_'
        },
        json: {
            exports: 'JSON'
        }
    }
});

require(['jquery'], function ($) {
    "use strict";

    window.console.log('hello bb4!');

    window.console.log($(window).height());
});