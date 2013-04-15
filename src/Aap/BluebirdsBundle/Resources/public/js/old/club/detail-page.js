/*global define*/

define(
    ['jquery', 'backbone', 'underscore', 'core/club/model', 'admin/team/list', 'admin/member/list'],
    function ($, Backbone, _, ClubModel, TeamList, MemberList) {
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
                            }),
                            memberList = new MemberList({
                                collection: self.model.collections.members,
                                club: self.model
                            });

                        self.$el.find('ul.breadcrumb li.active').text(self.model.get('name'));
                        self.$el.find('#teams').append(teamList.render().el);
                        self.$el.find('#members').append(memberList.render().el);
                    }
                });
            },

            render: function () {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            }
        });

        return Detail;
    }
);