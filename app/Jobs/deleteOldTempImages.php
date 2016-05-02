<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class deleteOldTempImages extends Job implements SelfHandling//, ShouldQueue
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // http://stackoverflow.com/questions/3126191/php-script-to-delete-files-older-than-24-hrs-deletes-all-files 2015-11-28

        /** define the directory **/
        $dir = config('market.system_path_images_temp');

        /*** cycle through all files in the directory ***/
        foreach (glob($dir . "*") as $file) {
            /*** if file is 24 hours (86400 seconds) old then delete it ***/
            if (filemtime($file) < time() - 86400) {
                unlink($file);
            }
        }
    }
}
