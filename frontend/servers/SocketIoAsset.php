<?php
namespace frontend\servers;

use yii\web\AssetBundle;
class SocketIoAsset extends AssetBundle
{
    public $sourcePath = '@frontend/servers/node_modules/socket.io';
    public $js = array(
        'lib/socket.io.js'
    );
}
