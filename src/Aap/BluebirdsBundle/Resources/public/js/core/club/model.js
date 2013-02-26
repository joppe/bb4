/*global define*/

define(
    ['jquery', 'backbone', 'core/model', 'core/team/collection'],
    function ($, Backbone, CoreModel, TeamCollection) {
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
//                    members: new MemberCollection(),
                    teams: new TeamCollection()
                };
            }
        });

        return Club;
    }
);