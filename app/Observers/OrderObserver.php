<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {

        foreach($order->product_json as $item){
            $p = \App\Models\Product::with(['store','store.order_count'])->where('id',$item)->firstOrFail();


            if( $p && isset($p->store) ){

                if( isset($p->store->order_count) && !empty($p->store->order_count) ){
                    $p->store->metas()->where('name','order_count')->where('type','meta')->update([ 'order_count' => ( (int)$p->store->order_count + 1 ) ]);
                }else{
                    $p->store->metas()->where('name','order_count')->where('type','meta')->create([ 'name' => 'order_count', 'type' => 'meta', 'content' => 1 ]);
                }
            }
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {

    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        $order->metas()->delete();
        $order->medias()->delete();
        $order->tags()->delete();
    }
}
