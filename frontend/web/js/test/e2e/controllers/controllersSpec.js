//
// test/e2e/controllers/controllersSpec.js
//
describe("E2E: Testing Controllers", function () {

    beforeEach(function () {
        browser().navigateTo('/');
    });

    it('should have a working videos page controller that applies the videos to the scope', function () {

        browser().navigateTo('/');
        expect(browser().location().path()).toBe("/");
        expect(element('ng-view').html()).toContain('Сделано за сегодня');
    });

});
