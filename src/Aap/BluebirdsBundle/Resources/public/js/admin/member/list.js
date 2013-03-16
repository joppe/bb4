/*global define*/

define(
    ['admin/common/list', 'admin/member/list-item', 'admin/member/form'],
    function (AdminList, MemberListItem, MemberForm) {
        'use strict';

        var MemberList;

        MemberList = AdminList.extend({
            templateData: {
                entityName: 'Member',
                headers: [
                    '#',
                    'Name',
                    ''
                ]
            },

            createForm: function (member) {
                var form = new MemberForm({
                        model: member
                    });

                return form;
            },

            createListItem: function (member) {
                return new MemberListItem({
                    model: member
                });
            }
        });

        return MemberList;
    }
);