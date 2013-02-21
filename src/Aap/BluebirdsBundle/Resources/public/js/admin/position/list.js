/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/position/collection', 'core/position/model', 'admin/position/form', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, PositionCollection, PositionModel, PositionForm, CoreList) {
        'use strict';

        var List;

        List = CoreList.extend({
            id: 'position-list',

            initialize: function () {
                CoreList.prototype.initialize.call(this, {
                    headers: ['Name', ''],
                    entityName: 'Position',
                    collection: new PositionCollection(),
                    modelClass: PositionModel,
                    formClass: PositionForm
                });
            }
        });

        return List;
    }
);