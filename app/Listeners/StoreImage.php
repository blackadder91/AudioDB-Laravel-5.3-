<?php

namespace App\Listeners;

use App\Events\EntityStored;
use App\Helpers\ImageHelper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreImage
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
     * @param  EntityStored  $event
     * @return true on success, error message on failure
     */
    public function handle(EntityStored $event)
    {
        $request = $event->request;
        $image_url = trim($request->input('image_url'));
        if ($request->hasFile('image') || $image_url != '') {
            $imageHelper = new ImageHelper($event->entity);
            $imageUploadResult = $image_url != '' ?
                $imageHelper->upload($image_url, $event->image_type, 'url') :
                $imageHelper->upload($request->file('image'), $event->image_type);
                return $imageUploadResult;
        }
        return null;
    }
}
