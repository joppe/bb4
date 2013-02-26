/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'admin/club/form', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubForm, CoreList) {
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
            }
        });

        return List;
    }
);