<?php

function backpack_pro () {
    return \PackageVersions\Versions::getVersion('backpack/crud');
}

//if (! function_exists('env')) {
//    function env($key, $default = null) {
//        // ...
//    }
//}
