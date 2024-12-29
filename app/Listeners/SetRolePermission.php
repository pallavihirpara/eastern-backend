<?php

namespace App\Listeners;

use App\Events\SetPermission; 
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetRolePermission
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SetPermission $event)
    {
        $role = Role::find($event->roleId);
        $role->syncPermissions((array)$event->permissionId);
    }
}
