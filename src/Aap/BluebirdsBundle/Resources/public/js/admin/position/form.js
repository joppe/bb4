/*global define, window*/

define(
    ['jquery', 'backbone', 'underscore', 'core/view/form'],
    function ($, Backbone, _, CoreForm) {
        'use strict';

        var Form;

        Form = CoreForm.extend({
            id: 'position-form',

            template: _.template($('#tmpl-position-form').html()),

            getModelData: function () {
                this.model.set('name', $('#field-name').val());
                this.model.set('field_number', $('#field-field_number').val());
                this.model.set('rating_weight', $('#field-rating_weight').val());

                return this.model.attributes;
            }
        });

        return Form;
    }
);