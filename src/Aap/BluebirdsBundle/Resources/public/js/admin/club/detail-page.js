/*global define*/

define(
    ['jquery', 'backbone', 'underscore', 'core/club/model', 'admin/club/team-list', 'core/team/collection'],
    function ($, Backbone, _, ClubModel, TeamList, TeamCollection) {
        'use strict';

        var Detail;

        Detail = Backbone.View.extend({
            template: _.template($('#tmpl-club-detail').html()),

            initialize: function (options) {
                var self = this;

                this.model = new ClubModel({
                    id: options.id
                });

                this.model.fetch({
                    success: function () {
                        var teamList = new TeamList({
                            collection: self.model.collections.teams,
                            club: self.model
                        });
                        self.$el.find('#teams').append(teamList.render().el);
                    }
                });
            },

            render: function () {
                this.$el.html(this.template());
                return this;
            }
        });

        return Detail;
    }
);