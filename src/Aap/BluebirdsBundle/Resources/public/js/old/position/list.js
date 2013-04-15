/*global define*/

define(
    ['admin/common/list', 'admin/position/list-item', 'admin/position/form'],
    function (AdminList, PositionListItem, PositionForm) {
        'use strict';

        var PositionList;

        PositionList = AdminList.extend({
            templateData: {
                entityName: 'Position',
                headers: [
                    'Name',
                    ''
                ]
            },

            createForm: function (position) {
                var form = new PositionForm({
                        model: position
                    });

                return form;
            },

            createListItem: function (position) {
                return new PositionListItem({
                    model: position
                });
            }
        });

        return PositionList;
    }
);