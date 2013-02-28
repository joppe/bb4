/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'admin/club/form', 'admin/common/list-page'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubForm, CoreListPage) {
        'use strict';

        var List;

        List = CoreListPage.extend({
            id: 'club-list',

            initialize: function () {
                CoreListPage.prototype.initialize.call(this, {
                    collection: new ClubCollection(),
                    templateData: {
                        entityName: 'Club',
                        headers: ['Name', '']
                    }
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