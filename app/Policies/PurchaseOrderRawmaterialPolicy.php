<?php

namespace App\Policies;

use App\Models\PurchaseOrderRawmaterial;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PurchaseOrderRawmaterialPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PurchaseOrderRawmaterial $purchaseOrderRawmaterial): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PurchaseOrderRawmaterial $purchaseOrderRawmaterial): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PurchaseOrderRawmaterial $purchaseOrderRawmaterial): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PurchaseOrderRawmaterial $purchaseOrderRawmaterial): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PurchaseOrderRawmaterial $purchaseOrderRawmaterial): bool
    {
        //
    }
}
