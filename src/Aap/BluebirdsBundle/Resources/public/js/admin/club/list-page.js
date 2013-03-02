/*global define, window*/

define(
    ['backbone', 'core/club/collection', 'admin/club/list'],
    function (Backbone, ClubCollection, ClubList) {
        'use strict';

        var Page;

        Page = Backbone.View.extend({
            id: 'club-list',

            initialize: function () {
                this.clubs = new ClubCollection();
            },

            render: function () {
                var clubList = new ClubList({
                        collection: this.clubs
                    });

                this.$el.append(clubList.render().el);
                this.clubs.fetch();

                return this;
            }
        });

        return Page;
    }
);