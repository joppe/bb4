/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/team/collection', 'core/team/model', 'admin/team/form', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, TeamCollection, TeamModel, TeamForm, CoreList) {
        'use strict';

        var List;

        List = CoreList.extend({
            id: 'team-list',

            initialize: function () {
                CoreList.prototype.initialize.call(this, {
                    headers: ['Name', ''],
                    entityName: 'Team',
                    collection: new TeamCollection(),
                    modelClass: TeamModel,
                    formClass: TeamForm
                });
            }
        });

        return List;
    }
);