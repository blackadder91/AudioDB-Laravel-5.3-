<?php

namespace App\Listeners;

use App\Events\EntityUpdated;
use App\Helpers\ImageHelper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateImage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EntityUpdated  $event
     * @return void
     */
    public function handle(EntityUpdated $event)
    {
        $request = $event->request;
        $image_url = trim($request->input('image_url'));
        if ($request->hasFile('image') || $image_url != '') {
            $imageHelper = new ImageHelper($event->entity);
            $imageUpdateResult = $image_url != '' ?
                $imageHelper->update($image_url, $event->image_type, 'url') :
                $imageHelper->update($request->file('image'), $event->image_type);
            return $imageUpdateResult;
        }
    }
}
