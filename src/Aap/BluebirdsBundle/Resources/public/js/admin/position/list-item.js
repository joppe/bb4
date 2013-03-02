/*global define*/

define(
    ['jquery', 'underscore', 'admin/common/list-item', 'admin/position/form'],
    function ($, _, AdminListItem, PositionForm) {
        'use strict';

        var ListItem;

        ListItem = AdminListItem.extend({
            createForm: function (position) {
                var form = new PositionForm({
                        model: position
                    });

                return form;
            }
        });

        return ListItem;
    }
);