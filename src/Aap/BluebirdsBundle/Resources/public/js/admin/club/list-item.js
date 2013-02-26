/*global define*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/view/list-item'],
    function ($, Bootstrap, Backbone, _, CoreListItem) {
        'use strict';

        var ListItem;

        ListItem = CoreListItem.extend({
            template: _.template($('#tmpl-list-item-with-detial').html()),

            getTemplateData: function () {
                var attributes = this.model.toJSON();

                attributes.detailUrl = 'clubs';

                return attributes;
            }
        });

        return ListItem;
    }
);