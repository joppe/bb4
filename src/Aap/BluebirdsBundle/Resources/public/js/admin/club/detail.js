/*global define*/

define(
    ['jquery', 'backbone', 'underscore', 'core/club/model', 'admin/team/list', 'core/team/collection'],
    function ($, Backbone, _, ClubModel, TeamList, TeamCollection) {
        'use strict';

        var Detail;

        Detail = Backbone.View.extend({
            template: _.template($('#tmpl-club-detail').html()),

            initialize: function (options) {
                this.model = new ClubModel({
                    id: options.id
                });
            },

            render: function () {
                var self = this;

                this.$el.html(this.template());

                this.model.fetch({
                    success: function () {
                        var teamList = new TeamList({
                            collection: self.model.collections.teams
                        });
                        self.$el.find('#teams').append(teamList.render().el);
                    }
                });
                return this;
            }
        });

        return Detail;
    }
);