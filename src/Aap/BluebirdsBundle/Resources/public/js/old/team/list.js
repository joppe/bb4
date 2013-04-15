/*global define*/

define(
    ['admin/common/list', 'admin/team/list-item', 'admin/team/form'],
    function (AdminList, TeamListItem, TeamForm) {
        'use strict';

        var TeamList;

        TeamList = AdminList.extend({
            templateData: {
                entityName: 'Team',
                headers: [
                    'Name',
                    ''
                ]
            },

            createForm: function (team) {
                var form = new TeamForm({
                        model: team
                    });

                return form;
            },

            createListItem: function (team) {
                return new TeamListItem({
                    model: team
                });
            }
        });

        return TeamList;
    }
);