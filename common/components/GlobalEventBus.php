<?php
namespace common\base;

use yii\base\Component;
use Rediska;

class GlobalEventBus extends Component
{
    /**
     * @var Rediska
     */
    public $redis;

    public function init()
    {
        $this->redis = new Rediska();
    }

    public function on($name, $handler, $data = null)
    {
        foreach ($this->redis->subscribe($name) as $event) {
            call_user_func($handler, $event);
        }
    }

    public function trigger($name, $event = null)
    {
        $this->redis->publish($name, $event);
    }
}