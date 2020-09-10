<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\MetadataByLocation' => [
            'App\Listeners\GenerateMetadataByLocation',
        ],
        
        'App\Events\MetadataByPropertyType' => [
            'App\Listeners\GenerateMetadataByPropertyType',
        ],
        
        'App\Events\PropertyAddedNotifyOwner' => [
            'App\Listeners\PropertyAddedNotifyOwnerEmail',
        ],
        
        'App\Events\PropertyAddedNotifyStaff' => [
            'App\Listeners\PropertyAddedNotifyStaffEmail',
        ],
        
        'App\Events\PropertyAddedNotifyClient' => [
            'App\Listeners\PropertyAddedNotifyClientEmail',
        ],
        
        'App\Events\PropertyStatusNotifyOwner' => [
            'App\Listeners\PropertyStatusNotifyOwnerEmail',
        ],
        
        'App\Events\PropertyOwnerDetailNotifyAdmin' => [
            'App\Listeners\PropertyOwnerDetailNotifyAdminEmail',
        ],
        
        'App\Events\PropertyOwnerRegister' => [
            'App\Listeners\PropertyOwnerRegisterEmail',
        ],
        
        'App\Events\TaggedOwnerNotificationVA' => [
            'App\Listeners\TaggedOwnerNotificationVAEmail',
        ],
        
        'App\Events\ChangeOwnerDetailByAdminNotifyOwner' => [
            'App\Listeners\ChangeOwnerDetailByAdminNotifyOwnerEmail',
        ],
        
        'App\Events\TransactionNotifyOwner' => [
            'App\Listeners\TransactionNotifyOwnerEmail',
        ],
        
        'App\Events\TransactionNotifyClient' => [
            'App\Listeners\TransactionNotifyClientEmail',
        ],
        
        'App\Events\TransactionNotifyStaff' => [
            'App\Listeners\TransactionNotifyStaffEmail',
        ],
        
        'App\Events\TransactionNotifyAddedBy' => [
            'App\Listeners\TransactionNotifyAddedByEmail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
