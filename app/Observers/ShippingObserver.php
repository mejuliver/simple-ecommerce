<?php

namespace App\Observers;

use App\Models\Shipping;

class ShippingObserver
{
    /**
     * Handle the Shipping "created" event.
     */
    public function created(Shipping $shipping): void
    {
        //
    }

    /**
     * Handle the Shipping "updated" event.
     */
    public function updated(Shipping $shipping): void
    {
        //
    }

    /**
     * Handle the Shipping "deleted" event.
     */
    public function deleted(Shipping $shipping): void
    {

    }

    /**
     * Handle the Shipping "restored" event.
     */
    public function restored(Shipping $shipping): void
    {
        //
    }

    /**
     * Handle the Shipping "force deleted" event.
     */
    public function forceDeleted(Shipping $shipping): void
    {
        $shipping->metas()->delete();
        $shipping->medias()->delete();
        $shipping->tags()->delete();
    }
}
