#Packfire Session
>PHP session made easy with Packfire Session library.

Packfire Session aims to abstract and improve the behaviour of PHP Session for out-of-the-box usage with improved security.

##Installation
Use [Composer](https://getcomposer.org/) to include Packfire Session in your project.

    {
        "require": {
			"packfire/session": "1.0.*"
		}
	}

Run Composer to install Packfire Session for use with your project.

    $ composer install

##Usage

The `Session` class is the main class we can work the session from.

To initiate a session:

	<?php
	use Packfire\Session\Session;
	use Packfire\Session\Storage\SessionStorage;

	$session = new Session(new SessionStorage());
	if (!Session::detectCookie()) { // only register session if cookie is not found.
		Session::register(); // session_start();
	}

To regenerate a new Session ID (recommended when users sign in / out to improve security):

	$session->regenerate();

Invalidate a session (session is kept registered, but all values are cleared, session ID is regenerated):

	$session->invalidate();

Destroy a session (session ID is removed entirely):

	Session::unregister();

Session Buckets are great way to scope down your session variables. To get started working with session buckets:

	$bucket = $session->bucket('form');
	$bucket->set('txtName', $_POST['txtName']);


	