<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Image;

class GenerateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $images = Image::all();
        foreach ($images as $image) {
            $this->line($image->slug);
            $imageable = new $image->imageable_type;
            $imageable = $imageable::find($image->imageable_id);
            $this->line($image->generateThumbnails($imageable->slug));
        }
    }
}
