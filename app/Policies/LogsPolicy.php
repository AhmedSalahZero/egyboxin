<?php

namespace App\Policies;

use App\Models\Log;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function PHPUnit\Framework\stringContains;

class LogsPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {

    }
    public function view(User $user, Log $log)
    {

        //dd(str_contains($log->status == 'Has Add New Shipment At'));
        if(!$user->isSeller())
            return true;
        else{
            return str_contains($log->status,'Has Add New Shipment') ||
                str_contains($log->status,'Has Update Shipment With Number') ||
                str_contains($log->status,'Has Been Received At Hub By') ||
                str_contains($log->status,'Has Been Delivered To Client') ||
                str_contains($log->status,'Returned To The Seller');
        }
      //  dd(str_contains($log->status,));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Log  $log
     * @return mixed
     */
    public function update(User $user, Log $log)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Log  $log
     * @return mixed
     */
    public function delete(User $user, Log $log)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Log  $log
     * @return mixed
     */
    public function restore(User $user, Log $log)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Log  $log
     * @return mixed
     */
    public function forceDelete(User $user, Log $log)
    {
        //
    }
}
