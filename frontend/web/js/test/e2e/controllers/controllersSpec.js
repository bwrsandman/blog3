//
// test/e2e/controllers/controllersSpec.js
//
describe("E2E: Testing Controllers", function () {

    // Load the AngularJS homepage.
    beforeEach(function () {
        browser().navigateTo('/?id=1');
    });


    /*
    it('Home link must be empty', function () {
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
    */

    it('Must save everything', function () {
        var $messages = [];
        for (var i = 0; i < 10; i++) {
            $messages[i] = i + ' Hello ' + Math.random();
            var input = element("#goals-grid textarea:eq("+i+")");
            input.val($messages[i]);
            input.trigger('change');
        }
        sleep(2)
        browser().navigateTo('/?id=1');
        for (var i = 0; i < 10; i++) {
            expect(element("#goals-grid textarea:eq("+i+")").val()).toEqual($messages[i]);
        }
    });
});
