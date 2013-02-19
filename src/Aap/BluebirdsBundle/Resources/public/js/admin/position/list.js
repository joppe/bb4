/*global define, window*/

define(
    ['jquery', 'bootstrap', 'backbone', 'underscore', 'core/position/collection', 'core/position/model', 'admin/position/form', 'core/view/confirm'],
    function ($, Bootstrap, Backbone, _, PositionCollection, PositionModel, PositionForm, Confirm) {
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
            id: 'position-list',

            template: _.template($('#tmpl-list').html()),

            events: {
                'click a.add': 'showCreateForm',
                'click a.edit': 'showEditForm',
                'click a.remove': 'showRemovePopup'
            },

            initialize: function () {
                this.positions = new PositionCollection();
                this.positions.on('reset', this.addPositions, this);
                this.positions.on('add', this.addPosition, this);
                this.positions.fetch();
            },

            render: function () {
                this.$el.html(this.template({
                    headers: ['Name', ''],
                    entityName: 'Position'
                }));
                return this;
            },

            addPositions: function () {
                var self = this;

                this.$el.find('tbody').empty();
                this.positions.each(function (position) {
                    self.addPosition(position);
                });
            },

            addPosition: function (position) {
                var view = new ListItem({
                        model: position
                    });

                this.$el.find('tbody').append(view.render().el);
            },

            showCreateForm: function (event) {
                var position = new PositionModel(),
                    form = new PositionForm({
                        collection: this.positions,
                        model: position
                    });

                event.preventDefault();

                this.$el.prepend(form.render().el);
            },

            showRemovePopup: function (event) {
                var self = this,
                    $anchor = $(event.currentTarget),
                    message = new Confirm({
                        entityName: 'Position',
                        proceed: function () {
                            var position = self.positions.get($anchor.data('id'));
                            position.destroy({
                                error: function () {
                                    window.console.log('error while deleting position');
                                }
                            });
                        }
                    });

                event.preventDefault();

                this.$el.append(message.render().el);
            },

            showEditForm: function (event) {
                var $anchor = $(event.currentTarget),
                    position = this.positions.get($anchor.data('id')),
                    form = new PositionForm({
                        collection: this.positions,
                        model: position
                    });

                event.preventDefault();

                this.$el.prepend(form.render().el);
            }

        });

        return List;
    }
);