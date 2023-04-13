<?php

namespace App\Observers;

use App\Models\AddressBook;

class AddressBookObserver
{
    /**
     * Handle the AddressBook "created" event.
     */
    public function created(AddressBook $addressBookdressBook): void
    {
        //
    }

    /**
     * Handle the AddressBook "updated" event.
     */
    public function updated(AddressBook $addressBookdressBook): void
    {
        //
    }

    /**
     * Handle the AddressBook "deleted" event.
     */
    public function deleted(AddressBook $addressBookdressBook): void
    {

    }

    /**
     * Handle the AddressBook "restored" event.
     */
    public function restored(AddressBook $addressBookdressBook): void
    {
        //
    }

    /**
     * Handle the AddressBook "force deleted" event.
     */
    public function forceDeleted(AddressBook $addressBookdressBook): void
    {
        $addressBook->metas()->delete();
    }
}
