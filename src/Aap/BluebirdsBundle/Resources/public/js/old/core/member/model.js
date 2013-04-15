/*global define*/

define(
    ['jquery', 'backbone', 'core/model'],
    function ($, Backbone, CoreModel) {
        'use strict';

        var Member;

        Member = CoreModel.extend({
            defaults: {
                first_name: null,
                middle_name: null,
                last_name: null,
                email: null,
                telephone: null,
                mobile: null,
                street: null,
                zip: null,
                city: null,
                membership_number: null,
                club_id: null
            },

            url: function () {
                return 'admin/Member/' + (this.isNew() ? 0 : this.get('id'));
            },

            initialize: function () {
                this.collections = {
                    team_members: [],
                    players: []
                };
            }
        });

        return Member;
    }
);