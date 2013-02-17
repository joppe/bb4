/*global requirejs, require, window*/

requirejs.config({
    urlArgs: 'bust=' + (new Date()).getTime(),
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

require(
    ['jquery', 'backbone', 'admin/router', 'admin/navigation/mainmenu'],
    function ($, Backbone, Router, Mainmenu) {
        'use strict';

        var router,
            mainmenu;

        router = new Router({
            $container: $('#content')
        });

        Backbone.history.start();

        mainmenu = new Mainmenu({
            menuItems: [
                {
                    title: 'Clubs',
                    url: '#clubs'
                },
                {
                    title: 'Teams',
                    url: '#teams'
                }
            ],
            router: router
        });
        $('div.navbar div.container').append(mainmenu.render().el);

//        window.console.log('hello bb4!');
    }
);