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
	{		
		
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
				//All are Valid info. then
				 $email 		= Input::get('email');
				 $username		= Input::get('username');
				 $password 		=Input::get('password');
				//Activation Code
				 $code   = str_random(220);

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
		$user = User::where('code','=',$code)-where('active','=',0);
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
	//Forgot Password (post)
	public function postforgotpassword()
	{
		return Redirect::route('login')->with('global','Dont Fool me Rohit Reddy');
	}
}//End of the class