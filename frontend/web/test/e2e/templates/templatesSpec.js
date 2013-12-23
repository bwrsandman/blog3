//
// test/e2e/templates/templatesSpec.js
//
describe("E2E: Testing Templates", function () {

    beforeEach(function () {
        browser().navigateTo('/');
    });

    it('should redirect and setup the videos page template on root', function () {
        browser().navigateTo('#/');
        expect(element('#ng-view').html()).toContain('youtube_listing');
    });

});
