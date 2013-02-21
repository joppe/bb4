/*global define, window*/

define(
    ['jquery', 'backbone', 'underscore', 'core/view/form'],
    function ($, Backbone, _, CoreForm) {
        'use strict';

        var Form;

        Form = CoreForm.extend({
            id: 'club-form',

            template: _.template($('#tmpl-club-form').html()),

            getModelData: function () {
                this.model.set('name', $('#field-name').val());

                return this.model.attributes;
            }
        });

        return Form;
    }
);