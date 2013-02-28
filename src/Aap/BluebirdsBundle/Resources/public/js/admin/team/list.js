/*global define, window*/

define(
    ['core/team/collection', 'admin/team/form', 'admin/common/list-page', 'core/view/list'],
    function (TeamCollection, TeamForm, CoreListPage, CoreList) {
        'use strict';

        var List;

        List = CoreListPage.extend({
            id: 'team-list',

            initialize: function (options) {
                this.collection = new TeamCollection();

                this.templateData = {
                    entityName: 'Team',
                    headers: ['Name', '']
                };

                this.list = new CoreList({
                    collection: this.collection,
                    templateData: this.templateData
                });

                this.collection.fetch();
            },

            getForm: function (team) {
                return new TeamForm({
                    collection: this.collection,
                    model: team
                });
            }
        });

        return List;
    }
);