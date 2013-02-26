/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/team/collection', 'admin/team/form', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, TeamCollection, TeamForm, CoreList) {
        'use strict';

        var List;

        List = CoreList.extend({
            id: 'team-list',

            entityName: 'Team',

            getColumns: function () {
                return ['Name', ''];
            },

            getForm: function (team) {
                return new TeamForm({
                    collection: this.collection,
                    model: team
                });
            },

            initialize: function (options) {
                var collection;

                if (options && options.collection) {
                    collection = options.collection;
                } else {
                    collection = new TeamCollection();
                }

                CoreList.prototype.initialize.call(this, {
                    collection: collection
                });
            }
        });

        return List;
    }
);