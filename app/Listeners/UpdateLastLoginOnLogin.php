<?php
namespace App\Listeners;

use Carbon\Carbon;
use Auth;

class UpdateLastLoginOnLogin
{
    public function handle($event)
    {
        $user = Auth::user();
        $user->last_login = Carbon::now();
        $user->is_active = '1';
        $user->save();
    }
}
?>
