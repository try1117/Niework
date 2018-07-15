<?php

namespace Niework\Models;

use Illuminate\Database\Eloquent\Model;

class MyDebugger extends Model
{
    public static function log($message, $caption="DEBUG") {
        error_log("\n\n".$caption."\n\n");
        error_log($message);
        error_log("\n\n");
    }
}
