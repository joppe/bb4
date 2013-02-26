/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'admin/club/form', 'core/view/list', 'admin/club/list-item'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubForm, CoreList, ListItem) {
        'use strict';

        var List;

        List = CoreList.extend({
            id: 'club-list',

            entityName: 'Club',

            getColumns: function () {
                return ['Name', ''];
            },

            getForm: function (club) {
                return new ClubForm({
                    collection: this.collection,
                    model: club
                });
            },

            initialize: function () {
                CoreList.prototype.initialize.call(this, {
                    collection: new ClubCollection()
                });
            },

            createListItem: function (model) {
                return new ListItem({
                    model: model
                });
            }
        });

        return List;
    }
);