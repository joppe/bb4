/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/position/collection', 'admin/position/form', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, PositionCollection, PositionForm, CoreList) {
        'use strict';

        var List;

        List = CoreList.extend({
            id: 'position-list',

            entityName: 'Position',

            getColumns: function () {
                return ['Name', ''];
            },

            getForm: function (position) {
                return new PositionForm({
                    collection: this.collection,
                    model: position
                });
            },

            initialize: function () {
                CoreList.prototype.initialize.call(this, {
                    collection: new PositionCollection()
                });
            }
        });

        return List;
    }
);