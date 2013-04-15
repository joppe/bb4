/*global define*/

define(
    ['jquery', 'underscore', 'admin/common/list-item', 'admin/team/form'],
    function ($, _, AdminListItem, TeamForm) {
        'use strict';

        var ListItem;

        ListItem = AdminListItem.extend({
            createForm: function (team) {
                var form = new TeamForm({
                        model: team
                    });

                return form;
            }
        });

        return ListItem;
    }
);