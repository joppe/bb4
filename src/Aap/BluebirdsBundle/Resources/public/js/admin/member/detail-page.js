/*global define*/

define(
    ['jquery', 'backbone', 'underscore', 'core/member/model', 'core/club/model'],
    function ($, Backbone, _, MemberModel, ClubModel) {
        'use strict';

        var Detail;

        Detail = Backbone.View.extend({
            template: _.template($('#tmpl-member-detail').html()),

            initialize: function (options) {
                var self = this;

                this.model = new MemberModel({
                    id: options.id
                });

                this.model.fetch({
                    success: function () {
                        var club = new ClubModel({
                                id: self.model.get('club_id')
                            }),
                            nameParts = [];

                        club.fetch({
                            success: function () {
                                self.$el.find('ul.breadcrumb li.club a').text(club.get('name'));
                                self.$el.find('ul.breadcrumb li.club a').prop('href', '#clubs/' + club.get('id'));
                            }
                        });

                        if (self.model.get('first_name')) {
                            nameParts.push(self.model.get('first_name'));
                        }
                        if (self.model.get('middle_name')) {
                            nameParts.push(self.model.get('middle_name'));
                        }
                        if (self.model.get('last_name')) {
                            nameParts.push(self.model.get('last_name'));
                        }
                        self.$el.find('ul.breadcrumb li.active').text(nameParts.join(' '));
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