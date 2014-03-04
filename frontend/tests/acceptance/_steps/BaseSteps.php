<?php
namespace WebGuy;

use \Codeception\TestCase;

class BaseSteps extends \WebGuy
{
    protected $messages = [];

    public function focus($el)
    {
        $I = $this;

        $I->executeJs('$("' . $el . '").focus()');
//        parent::focus($el);
    }

    public function amOnPage($page)
    {
        parent::amOnPage($page);
//        $this->waitForElement('#goals-grid', 3);
    }

    public function write($selector, $value)
    {
        $I = $this;

        $I->executeJs('
        var editor = $("' . $selector . '");
        if (editor.is("textarea")) {
            editor.focus().val("' . $value . '").change()
        } else {
            editor.focus().html("' . ('<div>' . $value . '</div>') . '").keyup()
        }');
    }


    public function click($link, $context = null)
    {
        $I = $this;

        if ($context) {
            $I->executeJs('$("' . $context . '").find(":contains(\'' . $link . '\')").click()');
        } else {
            $I->executeJs('$("' . $link . '").click()');
        }
//	    $I->wait(1);
//        $I->waitForJs("return $.active === 0", 5);

//        parent::click($link, $context);
    }

    public function waitForAutoSave()
    {
        $I = $this;

        $I->wait(3);
//        $this->waitForJs('return $.active == 0', 5);
    }

    public function seeInField($field, $value)
    {
        $I = $this;

        $realValue = $I->grabValueFrom($field);
        $I->execute(function () use ($realValue, $value) {
            TestCase::assertEquals($realValue, $value);
        });
//        parent::canSeeInField($field, $value);
    }

    public function flushMessages()
    {
        $this->messages = [];
        $this->conclusionMsg = null;
    }

    public function message($namespace, $i)
    {
        if (!isset($this->messages[$namespace][$i])) {
            $faker = \Faker\Factory::create('ru_RU');
            switch ($namespace) {
                case 'goal_title':
                    $msg = $faker->sentence(rand(6, 25));
                    break;
                case 'report':
                    $msg = $faker->sentence(rand(1, 90));
                    break;
                default:
                    $msg = $i . ' Hello ' . rand(0, 99999999);
                    break;
            }
            $this->messages[$namespace][$i] = $msg;
        }

        return $this->messages[$namespace][$i];
    }

    public function clickOk($selector)
    {
        $I = $this;
        $I->click('OK', $selector);
    }

    public function clickCancel($selector)
    {
        $I = $this;
        $I->click('Cancel', $selector);
    }
}
