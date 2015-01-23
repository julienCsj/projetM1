<?php
class FormationController extends BaseController {
	public function getFormation()
    {
        return View::make('front.formation')->with($data);
    }

}