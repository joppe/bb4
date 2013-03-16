/*global define*/

define(
    ['jquery', 'underscore', 'admin/common/list-item', 'admin/member/form'],
    function ($, _, AdminListItem, MemberForm) {
        'use strict';

        var ListItem;

        ListItem = AdminListItem.extend({
            template: _.template($('#tmpl-member-list-item').html()),

            createForm: function (member) {
                var form = new MemberForm({
                        model: member
                    });

                return form;
            }
        });

        return ListItem;
    }
);