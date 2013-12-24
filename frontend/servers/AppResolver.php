<?php

class AppResolver extends \PHPDaemon\Core\AppResolver {

    /**
     * Routes incoming request to related application. Method is for overloading.
     * @param object Request.
     * @param object AppInstance of Upstream.
     * @return string Application's name.
     */
    public function getRequestRoute($req, $upstream) {
        $req->attrs->server['DOCUMENT_URI'];
        return '\frontend\servers\WebSocket';
    }

}
return new AppResolver;