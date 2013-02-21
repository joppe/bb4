/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'core/club/model', 'admin/club/form', 'core/view/list'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubModel, ClubForm, CoreList) {
        'use strict';

        var List;

        List = CoreList.extend({
            id: 'club-list',

            initialize: function () {
                CoreList.prototype.initialize.call(this, {
                    headers: ['Name', ''],
                    entityName: 'Club',
                    collection: new ClubCollection(),
                    modelClass: ClubModel,
                    formClass: ClubForm
                });
            }
        });

        return List;
    }
);