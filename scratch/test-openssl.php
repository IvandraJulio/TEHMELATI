<?php
echo "PHP Version: " . PHP_VERSION . "\n";
echo "OpenSSL Version: " . OPENSSL_VERSION_TEXT . "\n";
if (extension_loaded('openssl')) {
    echo "OpenSSL extension is loaded.\n";
} else {
    echo "OpenSSL extension is NOT loaded.\n";
}
