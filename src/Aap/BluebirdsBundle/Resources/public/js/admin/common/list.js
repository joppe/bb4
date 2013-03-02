/*global define*/

define(
    ['jquery', 'backbone', 'underscore', 'core/view/list'],
    function ($, Backbone, _, CoreList) {
        'use strict';

        var List;

        List = CoreList.extend({
            events: {
                'click a.add': 'newItem'
            },

            newItem: function (event) {
                event.preventDefault();

                var self = this,
                    ModelClass = this.collection.model,
                    form = this.createForm(new ModelClass());

                form.on('saved', function (model) {
                    self.collection.add(model);
                });

                this.$el.prepend(form.render().el);
            }
        });

        return List;
    }
);