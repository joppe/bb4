/*global define, window*/

define(
    ['jquery', 'backbone', 'underscore', 'core/view/form', 'core/club/collection'],
    function ($, Backbone, _, CoreForm, ClubCollection) {
        'use strict';

        var Form;

        Form = CoreForm.extend({
            id: 'team-form',

            template: _.template($('#tmpl-team-form').html()),

            getDependencies: function () {
                return {
                    clubs: new ClubCollection()
                };
            },

            getModelData: function () {
                this.model.set('name', $('#field-name').val());
                this.model.set('club_id', $('#field-club').val());

                return this.model.attributes;
            }
        });

        return Form;
    }
);