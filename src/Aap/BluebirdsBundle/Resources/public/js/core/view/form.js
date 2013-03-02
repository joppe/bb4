/*global define, window*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Form;

    Form = Backbone.View.extend({
        events: {
            'click a.save': 'save',
            'click a.cancel': 'cancel',
            'click button.close': 'cancel'
        },

        initialize: function (options) {
            this.dependencies = this.getDependencies();

            this.loadDependencies();
        },

        loadDependencies: function () {
            var self = this,
                dependenciesLoaded = 0,
                dependencyCount = _.keys(this.dependencies).length;

            if (dependencyCount === 0) {
                this.parseTemplate();
            }

            _.each(this.dependencies, function (dependency) {
                dependency.fetch({
                    success: function () {
                        dependenciesLoaded += 1;

                        if (dependenciesLoaded === dependencyCount) {
                            self.parseTemplate();
                        }
                    }
                });
            });
        },

        getDependencies: function () {
            return {};
        },

        unrender: function () {
            this.$el.modal('hide');
            this.$el.remove();
        },

        getTemplateData: function () {
            var attributes = this.model.toJSON();

            _.each(this.dependencies, function (dependency, key) {
                attributes[key] = dependency;
            });

            return attributes;
        },

        parseTemplate: function () {
            this.$el.html(this.template(this.getTemplateData()));
        },

        render: function () {
            this.$el.modal({
                keyboard: true,
                show: true
            });
            return this;
        },

        getModelData: function () {
            return this.model.attributes;
        },

        save: function (event) {
            event.preventDefault();

            var self = this;

            this.model.save(this.getModelData(), {
                success: function (model) {
                    self.unrender();
                    self.trigger('saved', model);
                },
                error: function () {
                    window.console.log('error');
                }
            });
        },

        cancel: function (event) {
            event.preventDefault();

            this.unrender();
        }
    });

    return Form;
});