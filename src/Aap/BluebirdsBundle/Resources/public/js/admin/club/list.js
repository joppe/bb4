/*global define*/

define(
    ['jquery', 'backbone', 'underscore', 'core/club/collection', 'core/club/model', 'admin/club/form'],
    function ($, Backbone, _, ClubCollection, ClubModel, ClubForm) {
        'use strict';

        var List,
            ListItem;

        ListItem = Backbone.View.extend({
            tagName: 'tr',

            template: _.template($('#tmpl-list-item').html()),

            render: function () {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            }
        });

        List = Backbone.View.extend({
            id: 'club-list',

            template: _.template($('#tmpl-list').html()),

            events: {
                'click a.add': 'showForm'
            },

            initialize: function (options) {
                this.clubs = new ClubCollection();
                this.clubs.on('reset', this.addClubs, this);
                this.clubs.on('add', this.addClub, this);
                this.clubs.fetch();
            },

            render: function () {
                this.$el.html(this.template({
                    headers: ['Name']
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

            showForm: function (event) {
                event.preventDefault();

                var club = new ClubModel(),
                    form = new ClubForm({
                        collection: this.clubs,
                        model: club
                    });

                this.$el.prepend(form.render().el);
            }
        });

        return List;
    }
);