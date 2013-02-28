/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'admin/club/form', 'core/view/list', 'admin/club/list-item'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubForm, CoreList, ListItem) {
        'use strict';

        var List;

        List = Backbone.View.extend({
            id: 'club-list',

            events: {
                'click a.add': 'create',
                'click a.edit': 'edit',
                'click a.remove': 'remove'
            },

            initialize: function () {
                this.clubs = new ClubCollection();
                this.list = new CoreList({
                    collection: this.clubs,
                    templateData: {
                        entityName: 'Club',
                        headers: ['Name', '']
                    }
                });

                this.clubs.fetch();
            },

            render: function () {
                this.$el.html(this.list.render().el);
                return this;
            },

            create: function (event) {
                event.preventDefault();
            },

            edit: function (event) {
                event.preventDefault();
            },

            remove: function (event) {
                event.preventDefault();
            }

//            getForm: function (club) {
//                return new ClubForm({
//                    collection: this.collection,
//                    model: club
//                });
//            },
//
//            showCreateForm: function (event) {
//                var ModelClass = this.collection.model,
//                    form = this.getForm(new ModelClass());
//
//                event.preventDefault();
//
//                this.$el.prepend(form.render().el);
//            }
        });

        return List;
    }
);