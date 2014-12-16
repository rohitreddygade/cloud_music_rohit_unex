<?php 
class UserController extends BaseController
{
	public function getprofile_unauth ($value='')
	{
		return View::make('user.profile')
				->with('global','Please Login to see more');
	}


} 