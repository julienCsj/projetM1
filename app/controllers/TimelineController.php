<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 16/06/14
 * Time: 09:15
 */


class TimelineController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | ExporterController
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    |
    |
    |
    */


    public function getTimeline() {
        return View::make('back.timeline.timeline');
    }

}
