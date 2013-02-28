/*global define, window*/

define(
    ['core/club/collection', 'admin/club/form', 'admin/common/list-page', 'core/view/list'],
    function (ClubCollection, ClubForm, CoreListPage, CoreList) {
        'use strict';

        var List;

        List = CoreListPage.extend({
            id: 'club-list',

            initialize: function () {
                this.collection = new ClubCollection();

                this.templateData = {
                    entityName: 'Club',
                    headers: ['Name', ''],
                    detailUrl: 'clubs'
                };

                this.list = new CoreList({
                    collection: this.collection,
                    templateData: this.templateData,
                    itemTemplateSelector: '#tmpl-list-item-with-detial'
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