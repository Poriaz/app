<?php
namespace App\Listeners;

use Carbon\Carbon;
use Auth;

class UpdateLastLoginOnLogout
{
    public function handle($event)
    {
        $user = Auth::user();
        $user->is_active = '0';
        $user->save();
    }
}
?>
