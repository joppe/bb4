/*global define*/

define(
    ['jquery', 'underscore', 'admin/common/list-item', 'admin/club/form'],
    function ($, _, AdminListItem, ClubForm) {
        'use strict';

        var ListItem;

        ListItem = AdminListItem.extend({
            templateData: {
                detailUrl: 'clubs'
            },

            template: _.template($('#tmpl-list-item-with-detial').html()),

            createForm: function (club) {
                var form = new ClubForm({
                        model: club
                    });

                return form;
            }
        });

        return ListItem;
    }
);