<?php 

class AccountController extends BaseController 
{
	//Displaying SinUp form
	public function getCreate()
	{
		



		return View::make('account.create');
	}



	//Getitng SinUp form Details and processing
	public function postCreate()
	{	//ACtivate Mail Before the testing

		$validator = Validator::make(Input::all(),array
					(
						'email'				=>'required|email|unique:users',
						'username'			=>'required|min:4|unique:users',
						'password'			=>'required|min:6',
						'password_again'	=>'required|same:password'
					)//end of array					)

				);//Ending of Valdator var.

			//Checking Valudation 
			if ($validator->fails())
			{
				//if failed
				return Redirect::route('account-create')
							->withErrors($validator)
							->withInput();
			}
			else
			{
				//All are Valid info. then()
				 $email 		= Input::get('email');
				 $username		= Input::get('username');
				 $password 		=Input::get('password');
				//Activation Code
				 $code   = str_random(224);

				 $user = User::create(array(
				 		'email' => $email,
				 		'username' => $username,
				 		'password' => Hash::make($password),
				 		'code' => $code, //And change this active to '0' by defult.
				 		'active' =>1
  						
				 	));
				 	if($user)
				 	{		
				 		#******************REMOVE THE '#' TO ADD MAIL SENDING SYSTEM*************************************
				 		#Mail::send('email.auth.activate',array('link'=>'account/activate_'$code,'username'=>$username),function($message) use($user){
				 		#	$message->to($user->email,$user->username -> subject('Activate your account'));
				 		#});
				 			
				 		return Redirect::route('login')
				 				->with('global',"Please login to your account");
				 	}

			}

	}



	//Checking is give code is matchs or not(MAIl VERIFICATION).
	public function getActivate($code)
	{
		$user = User::where('code','=',$code)->where('active','=',0);
		if ($user->count())
		{
			$user = $user->first();
			//Updating to active state.
			$user->active =1;
			$user->code   ='';
			//saving the changes in the database
			if ($user->save()) {
				return Redirect::route('index')
					->with('global',"Your Account has-been activated.");
			}
		}
		else{
			return Redirect::route('index')
					->with('global',"Somthing Went wrong.Please try again later");
		}
	}



	//Displaying login Form
	public function  getLogin()
	{
		



		return View::make('account.login');
	}




	//Processing the Given data and Redirecting to requried route.
	public function  postLogin()
	{
		$validator = Validator::make(Input::all(),array(

								'email'  	=>'required|email',
								'password' 	=>'required'	
							)
						);
		if ($validator->fails())
		{
			//Invalid  email id or password
			return Redirect::route('login')
							->withErrors($validator)
							->withInput();

		}
		else
		{
			$remember = (Input::has('remember')) ? true :false;
			//Given Checking.
			$auth = Auth::attempt(array(
				'email'=> Input::get('email'),
				'password'=>Input::get('password'),
				'active'=>1
				),$remember
			);
			if ($auth) {
				//Checking is True then ;
				return Redirect::intended('/')
						->with('global','you have successfilly login');
			}
			else
			{
				return Redirect::route('login')
					->withInput()
					->with('global','Given Username or Password is Incorrect ');
			}
		}
		return Redirect::route('/')
				->with('global','Something Went Wrong Please try again later');
	}



	//Logout Processes.
	public function getLogout()
	{
		


		Auth::logout();
		return Redirect::route('login');
	}





	//Forgot Password (Form)
	public function getforgotpassword()
	{
		



		return View::make('account.forgot');
	}




	//Forgot Password (post) //Incompleate
	public function postforgotpassword()
	{


		return 'please activate get-forgot-password.';
			
		/*$validator = Validator::make(Input::all('email'),array('email' => 'required|email'));

			if ($validator->fails()) 
			{
				return Redirect::route('forgot-password')
								->withErrors($validator)
								->withInput();
			}
			else
			{
				//Checking and Sending new password

				$user = User::where('email','=',Input::get('email'));

				if ($user->count())
				{
					$user 				 = $user->first();

					//Generation New code and  password

					$code 				 = str_random(254);
					$password 			 = str_random(10);
					$user->code			 =$code;
					$user->password_temp = Hash::make($password);
					if ($user->save())
					{
						Mail:send('emails.auth.recovery',array( 
							'link' 		=> URL::route('recovery-mail',$code),
							'username'	=>$user->username,'password'=>$password),
						function($message)use($user)
						{
							$message->to($user->email,$user->username)->subject('Your new Password');
						});
						return Redirect::route('index')
											-with('global','We have send you a new password to your mail id please check your in your mail ');
					}

				}
			}
			//Backend
			return Redirect::route('forgot-password')->with('global','Something went Wrong Please try again later');*/
	}




	//Geting Recovery Mail Code
	public function getRecoveryMail($code)
	{
		$user = User::where('code', '=',$code)->where('password_temp','!=','');
		if ($user->count())
		{
			$user = $user->first();
			$user->password = $user->password_temp;
			$user->password_temp ='';
			$user->code='';
			if ($user->save())
			{
			 	return Redirect::route('login')
			 			->with('global','Please login with your new password');
			} 
		}
		return Redirect::route('index')
				->with('global','Unable to recover your account.');
	}




	//Changin Password
	public function getChangepassword()
	{
		


		return View::make('account.change_password');
	}



	//Change password (POST)
	public function postChangepassword()
	{
		$validator = Validator::make(Input::all(),array(
						'password'				=>'required|',
						'new_password'			=>'required|min:6',
						'new_password_again'	=>'required|same:new_password|min:6'
						)
		);

			if ($validator->fails()) 
			{
				return Redirect::route('change_password')
								->withErrors($validator);
			}
			else
			{
				$user = User::find(Auth::user()->id);

				$old_password = Input::get('password');
				$password     = Input::get('new_password');

				if (Hash::check($old_password,$user -> getAuthPassword()))
				{
					$user->password  = Hash::make($password);
					 if ($user->save())
					 {
					 	return Redirect::route('index')->with('global','Your password has been successfilly updated');
					 }
					 else{
					 	return Redirect::route('change_password')->with('global','Something Went Wrong');
					 }
				}
			}
			return Redirect::route('change_password')
						->with('global','Something went wrong please try again later');
	}


	
}//End of the class