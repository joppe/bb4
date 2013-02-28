/*global define, window*/

define(['jquery', 'backbone', 'underscore'], function ($, Backbone, _) {
    'use strict';

    var Form;

    Form = Backbone.View.extend({
        events: {
            'click a.btn-primary': 'save',
            'click a.btn': 'cancel',
            'click button.close': 'cancel'
        },

        initialize: function (options) {
            this.collection = options.collection;

            this.loadDependencies();
        },

        loadDependencies: function () {
            var self = this,
                dependencies = this.getDependencies(),
                dependenciesLoaded = 0,
                dependencyCount = _.keys(dependencies).length;

            if (dependencyCount === 0) {
                this.parseTemplate();
            }

            _.each(dependencies, function (dependency) {
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
            this.remove();
        },

        getTemplateData: function () {
            var attributes = this.model.toJSON(),
                dependencies = this.getDependencies();

            _.each(dependencies, function (dependency, key) {
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
                success: function (model, response) {
                    self.collection.add(model);
                    self.unrender();
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