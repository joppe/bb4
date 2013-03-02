/*global define, window*/

define(
    ['backbone', 'core/position/collection', 'admin/position/list'],
    function (Backbone, PositionCollection, PositionList) {
        'use strict';

        var Page;

        Page = Backbone.View.extend({
            id: 'position-list',

            initialize: function () {
                this.positions = new PositionCollection();
            },

            render: function () {
                var positionList = new PositionList({
                        collection: this.positions
                    });

                this.$el.append(positionList.render().el);
                this.positions.fetch();

                return this;
            }
        });

        return Page;
    }
);