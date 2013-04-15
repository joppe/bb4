/*global define*/

define(
    ['admin/common/list', 'admin/club/list-item', 'admin/club/form'],
    function (AdminList, ClubListItem, ClubForm) {
        'use strict';

        var ClubList;

        ClubList = AdminList.extend({
            templateData: {
                entityName: 'Club',
                headers: [
                    'Name',
                    ''
                ]
            },

            createForm: function (club) {
                var form = new ClubForm({
                        model: club
                    });

                return form;
            },

            createListItem: function (club) {
                return new ClubListItem({
                    model: club
                });
            }
        });

        return ClubList;
    }
);