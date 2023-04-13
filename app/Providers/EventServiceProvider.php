<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        \App\Models\Ad::observe(\App\Observers\AdObserver::class);
        \App\Models\Attribute::observe(\App\Observers\AttributeObserver::class);
        \App\Models\Brand::observe(\App\Observers\BrandObserver::class);
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Models\Coupon::observe(\App\Observers\CouponObserver::class);
        \App\Models\Inventory::observe(\App\Observers\InventoryObserver::class);
        \App\Models\Invoice::observe(\App\Observers\InvoiceObserver::class);
        \App\Models\Manufacturer::observe(\App\Observers\ManufacturerObserver::class);
        \App\Models\Order::observe(\App\Observers\OrderObserver::class);
        \App\Models\Payment::observe(\App\Observers\PaymentObserver::class);
        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
        \App\Models\Review::observe(\App\Observers\ReviewObserver::class);
        \App\Models\Shipping::observe(\App\Observers\ShippingObserver::class);
        \App\Models\Store::observe(\App\Observers\StoreObserver::class);
        \App\Models\Transaction::observe(\App\Observers\TransactionObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\AddressBook::observe(\App\Observers\AddressBookObserver::class);
        \App\Models\Profile::observe(\App\Observers\ProfileObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
