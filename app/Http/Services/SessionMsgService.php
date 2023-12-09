<?php

namespace App\Http\Services;

use Session;

class SessionMsgService {
    static public function flash(string $msg, string $prefix): void {
        Session::flash($prefix, $msg);
    }
}
