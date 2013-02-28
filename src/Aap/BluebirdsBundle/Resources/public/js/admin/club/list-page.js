/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'admin/club/form', 'core/view/list', 'core/view/confirm'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubForm, CoreList, Confirm) {
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
                this.collection = new ClubCollection();
                this.list = new CoreList({
                    collection: this.collection,
                    templateData: {
                        entityName: 'Club',
                        headers: ['Name', '']
                    }
                });

                this.collection.fetch();
            },

            render: function () {
                this.$el.html(this.list.render().el);
                return this;
            },

            getForm: function (club) {
                return new ClubForm({
                    collection: this.collection,
                    model: club
                });
            },

            create: function (event) {
                event.preventDefault();

                var ModelClass = this.collection.model,
                    form = this.getForm(new ModelClass());

                this.$el.prepend(form.render().el);
            },

            edit: function (event) {
                event.preventDefault();

                var $anchor = $(event.currentTarget),
                    model = this.collection.get($anchor.data('id')),
                    form = this.getForm(model);

                this.$el.prepend(form.render().el);
            },

            remove: function (event) {
                event.preventDefault();

                var self = this,
                    $anchor = $(event.currentTarget),
                    message = new Confirm({
                        templateData: {
                            entityName: this.entityName
                        },
                        confirm: function () {
                            var model = self.collection.get($anchor.data('id'));

                            model.destroy({
                                error: function () {
                                    window.console.log('error while deleting model');
                                }
                            });
                        }
                    });

                this.$el.append(message.render().el);
            }
        });

        return List;
    }
);