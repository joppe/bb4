/*global define, window*/

define(
    ['jquery', 'backbone', 'underscore', 'core/view/form', 'core/club/collection'],
    function ($, Backbone, _, CoreForm, ClubCollection) {
        'use strict';

        var Form;

        Form = CoreForm.extend({
            id: 'member-form',

            template: _.template($('#tmpl-member-form').html()),

            getDependencies: function () {
                return {
                    clubs: new ClubCollection()
                };
            },

            getModelData: function () {
                this.model.set('first_name', $('#field-first_name').val());
                this.model.set('middle_name', $('#field-middle_name').val());
                this.model.set('last_name', $('#field-last_name').val());
                this.model.set('email', $('#field-email').val());
                this.model.set('telephone', $('#field-telephone').val());
                this.model.set('mobile', $('#field-mobile').val());
                this.model.set('street', $('#field-street').val());
                this.model.set('zip', $('#field-zip').val());
                this.model.set('city', $('#field-city').val());
                this.model.set('membership_number', $('#field-membership_number').val());
                this.model.set('club_id', $('#field-club').val());

                return this.model.attributes;
            }
        });

        return Form;
    }
);