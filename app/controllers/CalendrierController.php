<?php
class CalendrierController extends BaseController {
	public function getCalendrier()
    {
        $data = array(
               'notifications' => array(),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Le calendrier')
               );
        return View::make('calendrier')->with($data);
    }

}