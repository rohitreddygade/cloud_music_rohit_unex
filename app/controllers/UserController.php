<?php 
class UserController extends BaseController
{
	//User Profile View to see users Detais.
	public function getprofile($username)
	{
		$user = User::where('username','=',$username);

		if ($user->count()) 
		{
			$user = $user->first();

			return View::make('user.profile')
				->with('user', $user);
		}
		 return App::abort(404);
	}


} 