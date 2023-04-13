<?php

namespace App\Observers;

use App\Models\Manufacturer;

class ManufacturerObserver
{
    /**
     * Handle the Manufacturer "created" event.
     */
    public function created(Manufacturer $manufacturer): void
    {
        //
    }

    /**
     * Handle the Manufacturer "updated" event.
     */
    public function updated(Manufacturer $manufacturer): void
    {
        //
    }

    /**
     * Handle the Manufacturer "deleted" event.
     */
    public function deleted(Manufacturer $manufacturer): void
    {

    }

    /**
     * Handle the Manufacturer "restored" event.
     */
    public function restored(Manufacturer $manufacturer): void
    {
        //
    }

    /**
     * Handle the Manufacturer "force deleted" event.
     */
    public function forceDeleted(Manufacturer $manufacturer): void
    {
        $manufacturer->metas()->delete();
        $manufacturer->medias()->delete();
        $manufacturer->tags()->delete();
    }
}
