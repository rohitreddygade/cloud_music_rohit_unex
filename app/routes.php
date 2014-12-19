<?php


#Index Route
Route::get('/',array(
	'as'=>'index',
	'uses'=>'IndexController@Index'
	)
);



#UnAuth Group Routes.
Route::group(array('before'=>'guest'),function()
 {
	//CSRF protection Group.(For only posting the details from the server)
	Route::group(array('before'=>'csrf'),function()
	{
		//Creating Account -POST
			Route::post('create',array(
				'as'=>'account-create-post',
				'uses'=>'AccountController@postCreate'
				)
			);	
		//LOGIN ROUTE -POST
			Route::post('login/',array(
				'as'   => 'login-post',
				'uses' =>'AccountController@postLogin'

				)
			);	
		//forgot-password (post)
			Route::post('forgot_password',array(
					'as'=>'forgot-password-post',
					'uses'=>'AccountController@postforgotpassword'
				)
			);
		
	});//End of Csrf
	//Creating Account -GET
	Route::get('create',array(
			'as'=>'account-create',
			'uses'=>'AccountController@getCreate'
			)	
	);
	#*********************************MAIL SENDING ROUTE**************************************
	//Sending and Resving mail Route
	Route::get('account/activate_{code}',array(
				'as'=>'account-activate',
				'uses'=>'AccountController@getActivate'
		));\
	
	#*********************************MAIL SENDING ROUTE**************************************
	//LOGIN ROUTE -GET
	Route::get('login/',array(
			'as'   => 'login',
			'uses' =>'AccountController@getLogin'

		)
	);
	//forgot-password (GET)
	Route::get('forgot_password',array(
			'as'=>'forgot-password',
			'uses'=>'AccountController@getforgotpassword'
			)
	);
	#****************************Mail Code for Recovery*******************************
	Route::get('/account/recover/{code}',array(
		'as'	=>'recovery-mail',
		'uses' 	=>'AccountController@getRecoveryMail'
		)
	);
	#****************************Mail Code for Recovery*******************************
});//End of UnAuht 



#Auth. Group Routes(USERS LOGIN LINKS ONLY)
Route::group(array('before'=>'auth'),function()
{	
	//Csrf group.
	Route::group(array('before'=>'csrf'),function()
		{
			//Change Password(post)
				Route::post('user/Change_password',array(
					'as'=>'change-password-post',
					'uses'=>'AccountController@postChangepassword'
					)
				);
			
		});//End of csrf

	//Change Password(GET)
	Route::get('user/Change_password',array(
		'as'=>'change_password',
		'uses'=>'AccountController@getChangepassword'
		)
	);
	//Sinout(GET)
	Route::get('user/logout',array(
		'as'=>'logout',
		'uses'=>'AccountController@getLogout'
		)
	);
});//End of the Auth.



//Profile Request
Route::get('user/{username}',array(
			'as'	=>'profile-unauth',
			'uses'	=>'UserController@getprofile'
		)
	);
