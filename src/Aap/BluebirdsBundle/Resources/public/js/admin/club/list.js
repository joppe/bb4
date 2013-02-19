/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/club/collection', 'core/club/model', 'admin/club/form', 'core/view/confirm'],
    function ($, Bootstrap, Backbone, _, ClubCollection, ClubModel, ClubForm, Confirm) {
        'use strict';

        var List,
            ListItem;

        ListItem = Backbone.View.extend({
            tagName: 'tr',

            template: _.template($('#tmpl-list-item').html()),

            initialize: function () {
                this.model.on('destroy', this.unrender, this);
                this.model.on('change:name', this.updateName, this);
            },

            render: function () {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            },

            updateName: function () {
                this.$el.find('td.name').text(this.model.get('name'));
            },

            unrender: function () {
                this.remove();
            }
        });

        List = Backbone.View.extend({
            id: 'club-list',

            template: _.template($('#tmpl-list').html()),

            events: {
                'click a.add': 'showCreateForm',
                'click a.edit': 'showEditForm',
                'click a.remove': 'showRemovePopup'
            },

            initialize: function () {
                this.clubs = new ClubCollection();
                this.clubs.on('reset', this.addClubs, this);
                this.clubs.on('add', this.addClub, this);
                this.clubs.fetch();
            },

            render: function () {
                this.$el.html(this.template({
                    headers: ['Name', '']
                }));
                return this;
            },

            addClubs: function () {
                var self = this;

                this.$el.find('tbody').empty();
                this.clubs.each(function (club) {
                    self.addClub(club);
                });
            },

            addClub: function (club) {
                var view = new ListItem({
                        model: club
                    });

                this.$el.find('tbody').append(view.render().el);
            },

            showCreateForm: function (event) {
                var club = new ClubModel(),
                    form = new ClubForm({
                        collection: this.clubs,
                        model: club
                    });

                event.preventDefault();

                this.$el.prepend(form.render().el);
            },

            showRemovePopup: function (event) {
                var self = this,
                    $anchor = $(event.currentTarget),
                    message = new Confirm({
                        entityName: 'Club',
                        proceed: function () {
                            var club = self.clubs.get($anchor.data('id'));
                            club.destroy({
                                error: function () {
                                    window.console.log('error while deleting layer group');
                                }
                            });
                        }
                    });

                event.preventDefault();

                this.$el.append(message.render().el);
            },

            showEditForm: function (event) {
                var $anchor = $(event.currentTarget),
                    club = this.clubs.get($anchor.data('id')),
                    form = new ClubForm({
                        collection: this.clubs,
                        model: club
                    });

                event.preventDefault();

                this.$el.prepend(form.render().el);
            }

        });

        return List;
    }
);