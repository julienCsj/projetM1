<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/06/14
 * Time: 09:51
 */

class DashboardController extends BaseController {

    public function getIndex()
    {
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Accueil')
        );

        return View::make('dashboard')->with($data);
    }
}
