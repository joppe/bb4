/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'admin/club/form', 'admin/common/list-page', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubForm, CoreListPage, CoreList) {
        'use strict';

        var List;

        List = CoreListPage.extend({
            id: 'club-list',

            initialize: function () {
                this.collection = new ClubCollection();

                this.templateData = {
                    entityName: 'Club',
                    headers: ['Name', '']
                };

                this.list = new CoreList({
                    collection: this.collection,
                    templateData: this.templateData
                });

                this.collection.fetch();
            },

            getForm: function (club) {
                return new ClubForm({
                    collection: this.collection,
                    model: club
                });
            }
        });

        return List;
    }
);