/*global define*/

define(['jquery', 'backbone', 'core/member/model'], function ($, Backbone, MemberModel) {
    'use strict';

    var Collection;

    Collection = Backbone.Collection.extend({
        model: MemberModel,

        url: 'admin/Member',

        parse: function (response) {
            return response.result;
        }
    });

    return Collection;
});