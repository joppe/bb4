/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/team/collection', 'core/team/model', 'admin/team/form', 'core/view/confirm', 'core/club/collection'],
    function ($, Bootstrap, Backbone, _, TeamCollection, TeamModel, TeamForm, Confirm, ClubCollection) {
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
            id: 'team-list',

            template: _.template($('#tmpl-list').html()),

            events: {
                'click a.add': 'showCreateForm',
                'click a.edit': 'showEditForm',
                'click a.remove': 'showRemovePopup'
            },

            initialize: function () {
                var self = this;

                this.clubs = new ClubCollection();
                this.clubs.fetch({
                    success: function () {
                        self.teams = new TeamCollection();
                        self.teams.on('reset', self.addTeams, self);
                        self.teams.on('add', self.addTeam, self);
                        self.teams.fetch();
                    }
                });
            },

            render: function () {
                this.$el.html(this.template({
                    headers: ['Name', ''],
                    entityName: 'Team'
                }));
                return this;
            },

            addTeams: function () {
                var self = this;

                this.$el.find('tbody').empty();
                this.teams.each(function (team) {
                    self.addTeam(team);
                });
            },

            addTeam: function (team) {
                var view = new ListItem({
                    model: team
                });

                this.$el.find('tbody').append(view.render().el);
            },

            showCreateForm: function (event) {
                var team = new TeamModel(),
                    form = new TeamForm({
                        collection: this.teams,
                        model: team,
                        clubs: this.clubs
                    });

                event.preventDefault();

                this.$el.prepend(form.render().el);
            },

            showRemovePopup: function (event) {
                var self = this,
                    $anchor = $(event.currentTarget),
                    message = new Confirm({
                        entityName: 'Team',
                        proceed: function () {
                            var club = self.teams.get($anchor.data('id'));
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
                    club = this.teams.get($anchor.data('id')),
                    form = new TeamForm({
                        collection: this.teams,
                        model: club,
                        clubs: this.clubs
                    });

                event.preventDefault();

                this.$el.prepend(form.render().el);
            }

        });

        return List;
    }
);