<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ticket;

try {
    // 1. Test database connection
    DB::connection()->getPdo();
    echo "SUCCESS: Database connection established successfully.\n";

    // 2. Count users by role
    echo "\n--- USER ACCOUNTS BY ROLE ---\n";
    $roles = ['pengguna', 'kasubbag', 'solver', 'operator'];
    foreach ($roles as $role) {
        $count = User::where('role', $role)->count();
        echo "Role: " . str_pad($role, 10) . " | Count: " . $count . "\n";
    }

    // 3. Count tickets
    echo "\n--- TICKETS COUNT ---\n";
    $ticketCount = Ticket::count();
    echo "Total Tickets: " . $ticketCount . "\n";

    // 4. Sample check for each role
    echo "\n--- SAMPLE USERS ---\n";
    foreach ($roles as $role) {
        $user = User::where('role', $role)->first();
        if ($user) {
            echo "Role: " . str_pad($role, 10) . " | Username: " . str_pad($user->username, 25) . " | Name: " . $user->name . "\n";
        } else {
            echo "Role: " . str_pad($role, 10) . " | No user found!\n";
        }
    }

} catch (\Exception $e) {
    echo "ERROR: Could not connect to the database.\n";
    echo $e->getMessage() . "\n";
}
