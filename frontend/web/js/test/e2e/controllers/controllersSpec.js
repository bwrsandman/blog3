//
// test/e2e/controllers/controllersSpec.js
//
describe("E2E: Testing Controllers", function () {

    beforeEach(function () {
        browser().navigateTo('/');
    });
    it('home link must be empty', function () {
        browser().navigateTo('/');
        expect(browser().location().path()).toBe("/");
        expect(element('ng-view').html()).toContain('Сделано за сегодня');
    });

    it('Navigation click must change url', function () {
        element('.test-navigation a:eq(1)').click();
        expect(browser().location().path()).toBe("/");
        element('.test-navigation a:eq(2)').click();
        expect(browser().location().path()).toBe("/yesterday");
        element('.test-navigation a:eq(3)').click();
        expect(browser().location().path()).toBe("/wall");
        element('.test-navigation a:eq(4)').click();
        expect(browser().location().path()).toBe("/stream");
        element('.test-navigation a:eq(5)').click();
        expect(browser().location().path()).toBe("/history");
    });

});
