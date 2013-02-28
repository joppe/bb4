/*global define, window*/

define(
    ['core/position/collection', 'admin/position/form', 'admin/common/list-page', 'core/view/list'],
    function (PositionCollection, PositionForm, CoreListPage, CoreList) {
        'use strict';

        var List;

        List = CoreListPage.extend({
            id: 'position-list',

            initialize: function () {
                this.collection = new PositionCollection();

                this.templateData = {
                    entityName: 'Position',
                    headers: ['Name', '']
                };

                this.list = new CoreList({
                    collection: this.collection,
                    templateData: this.templateData
                });

                this.collection.fetch();
            },

            getForm: function (position) {
                return new PositionForm({
                    collection: this.collection,
                    model: position
                });
            }
        });

        return List;
    }
);