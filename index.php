<?php
// Load Fat-Free Framework
$f3 = require(__DIR__ . '/lib/base.php');

// Autoload custom classes
$f3->set('AUTOLOAD', 'autoload/');

// Set UI directory for views/templates
$f3->set('UI', 'ui/');

$f3->set('DB', new DB\SQL('sqlite:data.db'));

// Set up database (uses your new DatabaseConnection class)
// require_once __DIR__ . '/autoload/DatabaseConnection.php';
// $db = DatabaseConnection::connect();
// $f3->set('DB', $db);

// Example simple route
$f3->route('GET /', function($f3) {
    $f3->set('html_title', 'Welcome!');  // <--- Add this line!
    $f3->set('content', 'home.html');
    echo Template::instance()->render('layout.html');
});
$f3->route('GET /about',
    function($f3)
    {
        $file = F3::instance()->read('README.md');
        $html = Markdown::instance()->convert($file);
        $f3->set('article_html', $html);
        $f3->set('content','article.html');
        echo template::instance()->render('layout.html');;
    }
);

$f3->route('GET /simple_ajax',
    function ($f3) {
        $f3->set('html_title','Query Any Site');
        $f3->set('content','exec_jquery.html');
        echo Template::instance()->render('layout.html');
    }
);

// When using GET, provide a form for the user to upload an image via the file input type
$f3->route('GET /simpleform',
  function($f3) {
    $f3->set('html_title','Simple Input Form');
    $f3->set('content','simpleform.html');
    echo template::instance()->render('layout.html');
  }
);

// When using POST (e.g.  form is submitted), invoke the controller, which will process
// any data then return info we want to display. We display
// the info here via the response.html template
$f3->route('POST /simpleform',
  function($f3) {
	$formdata = array();			// array to pass on the entered data in
	$formdata["name"] = $f3->get('POST.name');			// whatever was called "name" on the form
	$formdata["colour"] = $f3->get('POST.colour');		// whatever was called "colour" on the form

  	$controller = new SimpleControllerAjax;
    $controller->putIntoDatabase($formdata);

	$f3->set('formData',$formdata);		// set info in F3 variable for access in response template

    $f3->set('html_title','Simple Example Response');
	$f3->set('content','response.html');
	echo template::instance()->render('layout.html');
  }
);

// When using GET, provide a form for the user to upload an image via the file input type
$f3->route('GET /hint',
    function($f3) {
        $f3->set('html_title','Simple Input Form');
        $f3->set('content','ajaxEx.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /ajaxEx/user/@query',
  function($f3) {
  	$q = $f3->get('PARAMS.query');
  	$controller = new SimpleControllerAjax;
    $userTable = $controller->getUserTable($q);
    $f3->set('userTable',$userTable);
    echo template::instance()->render('ajaxTable.html');
  }
);

$f3->route('GET /ajaxEx/hint/@query',
  function($f3) {
  	$str = $f3->get('PARAMS.query');		// query should be a string of at least one character
  	$controller = new SimpleControllerAjax;
    $userHint = $controller->getUserHint($str);
	echo $userHint;
  }
);

$f3->route('POST /ajaxEx/user',		// NB POST here: will be reached by form submission
  function($f3) {
  	$str = $f3->get('POST.name');
  	$controller = new SimpleControllerAjax;
    $userTable = $controller->getUserTableFromStr($str);
    $f3->set('userTable',$userTable);
    echo template::instance()->render('ajaxTable.html');
  }
);


$f3->route('GET /simple_ajax',
    function ($f3) {
        $f3->set('html_title','Query Any Site');
        $f3->set('content','exec_jquery.html');
        echo Template::instance()->render('layout.html');
    }
);

// When using

$f3->route('GET /dataView',
  function($f3) {
  	$controller = new SimpleControllerAjax;
    $alldata = $controller->getData();

    $f3->set("dbData", $alldata);
    $f3->set('html_title','Viewing the data');
    $f3->set('content','dataView.html');
    echo template::instance()->render('layout.html');
  }
);

$f3->route('POST /searchView',
  function($f3) {
  	$controller = new SimpleControllerAjax;
    $alldata = $controller->search($f3->get("POST.field"), $f3->get("POST.term"));
    echo $alldata;
  }
);


$f3->route('GET /searchView', // GET query with ?field=VALUE&term=VALUE
  function($f3) {
  	$controller = new SimpleControllerAjax;

    $alldata = $controller->search($f3->get("GET.field"), $f3->get("GET.term"));
    $f3->set("dbData", $alldata);
    $f3->set('html_title','Viewing the data');
    $f3->set('content','dataView.html');
    echo template::instance()->render('layout.html');
  }
);


$f3->route('POST /dataView',
  function($f3) {
  	$controller = new SimpleControllerAjax;
    $alldata = $controller->search($f3->get('POST.field'), $f3->get('POST.term'));

    $f3->set("dbData", $alldata);
    $f3->set('html_title','Viewing the data');
    $f3->set('content','dataView.html');
    echo template::instance()->render('layout.html');
  }
);

$f3->route('GET /editView',				// exactly the same as dataView, apart from the template used
  function($f3) {
  	$controller = new SimpleControllerAjax;
    $alldata = $controller->getData();

    $f3->set("dbData", $alldata);
    $f3->set('html_title','Viewing the data');
    $f3->set('content','editView.html');
    echo template::instance()->render('layout.html');
  }
);

$f3->route('POST /editView',
  function($f3) {
  	$controller = new SimpleControllerAjax;
    $controller->deleteHandler($f3->get('POST.toDelete'));

	$f3->reroute('/editView');  }
);


$f3->route('GET /vote',
    function($f3) {
        $f3->set('html_title','Simple Voting Form');
        $f3->set('content','voting.html');
        echo template::instance()->render('layout.html');
    }
);

// When using POST (e.g.  form is submitted), invoke the controller, which will process
// any data then return info we want to display. We display
// the info here via the response.html template
$f3->route('POST /vote',
    function($f3) {
        $formdata = array();			// array to pass on the entered data in
        $formdata["name"] = $f3->get('POST.name');			// whatever was called "name" on the form
        $formdata["colour"] = $f3->get('POST.colour');		// whatever was called "colour" on the form

        $controller = new SimpleControllerAjax;
        $controller->putIntoDatabase($formdata);

        $f3->set('formData',$formdata);		// set info in F3 variable for access in response template

        $f3->set('html_title','Simple Example Response');
        $f3->set('content','response.html');
        echo template::instance()->render('layout.html');
    }
);
// Below are paths that we have created :)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$f3->route('GET /home',
    function($f3)
    {
        if ($f3->exists('SESSION.user')) {
            // Optionally, you can redirect to the home page or another page
            // $f3->reroute('/home');
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $f3->set('html_title','Home');
        $f3->set('content','home.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /login',
    function($f3)
    {
        if ($f3->exists('SESSION.user')) {
            // Optionally, you can redirect to the home page or another page
            // $f3->reroute('/home');
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }


        $f3->set('html_title','Log In');
        $f3->set('content','login.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('POST /login',
    function($f3) {
    // Instantiate the SimpleControllerUsers
    $userController = new SimpleControllerLogin();

    // Get username and password from POST data
    $username = $f3->get('POST.username');
    $password = $f3->get('POST.password');


    // Attempt to authenticate the user
    if ($userController->authenticateUser($username, $password)) {
        // Authentication successful

        // Here you might want to start a session or set some session variables
        $f3->set('SESSION.user', $username);

        // Redirect to a secure page
        $f3->reroute('/home');
    } else {
        // Authentication failed

        // Optionally, set an error message to display on the login page
        // For example: $f3->set('SESSION.error', 'Invalid username or password.');
        $f3->reroute('/login?error=Invalid username or password.');
        // Redirect back to the login form
    }
});


$f3->route('GET /register',
    function($f3)
    {
        if ($f3->exists('SESSION.user')) {
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $f3->set('html_title','Register');
        $f3->set('content','register.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('POST /register',
    function($f3) {
        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');
        $confirmPassword = $f3->get('POST.confirmpassword');

        // Basic validation
        if ($password !== $confirmPassword) {
            // Handle the error, such as by setting a session variable to display an error message
            $f3->set('SESSION.error', 'Passwords do not match.');
            $f3->reroute('/register');
            return;
        }

        $userController = new SimpleControllerLogin();

        // Further validation could be implemented here (e.g., check if username already exists)

        // Assuming validation passed, add the user
        $userController->addUser([
            'username' => $username,
            'password' => $password, // Password will be hashed within addUser method
            'email' => '' // Assuming you want to collect email, adjust your form and method accordingly
        ]);

        // Redirect to login page or wherever appropriate
        $f3->reroute('/login');
    }
);

$f3->route('GET /team',
    function($f3)
    {
        $f3->set('html_title','Team');
        $f3->set('content','team.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /about',
    function($f3)
    {
        $f3->set('html_title','About');
        $f3->set('content','about.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /library',
    function($f3)
    {
        $f3->set('html_title','Library');
        $f3->set('content','library.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /unilibrary',
    function($f3)
    {
        $f3->set('html_title','Universal Library');
        $f3->set('content','unilibrary.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /thisweeksbook',
    function($f3)
    {
        $f3->set('html_title','This Weeks Book');
        $f3->set('content','thisweeksbook.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /thisweeksbook',
    function($f3)
    {
        $f3->set('html_title','This Weeks Book');
        $f3->set('content','thisweeksbook.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /thisweeksbookFinal',
    function($f3)
    {
        $f3->set('html_title','This Weeks Book');
        $f3->set('content','thisweeksbookFinal.html');
        echo template::instance()->render('layout.html');
    }
);


$f3->route('GET /quotes',
    function($f3)
    {
        $f3->set('html_title','Quotes');
        $f3->set('content','quotes.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /createquote',
    function($f3)
    {
        $f3->set('html_title','Create Quote');
        $f3->set('content','createquote.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /discussion', function($f3) {
    if ($f3->exists('SESSION.user')) {
        $f3->set('loggedIn', true);
    } else {
        $f3->set('loggedIn', false);
    }
    $controller = new SimpleControllerDiscussion();
    $mapperObjects = $controller->getData(); // Fetch all reviews

    $reviews = array();
    foreach ($mapperObjects as $obj) {
        // Manually extract the data you need into a simpler associative array
        $reviews[] = array(
            'bookID' => $obj->bookID,
            'username' => $obj->username,
            'review' => $obj->review,
            'likes' => $obj->likes
        );
    }
    $f3->set('reviews', $reviews);
    echo Template::instance()->render('discussion.html');
});


$f3->route('POST /discussionLike',
    function($f3) {
        $username = $f3->get('POST.username');
        $controller = new SimpleControllerDiscussion();

        $f3->set('formTitle', $username);
        $voteResponse = $controller->like($username);

        echo json_encode(['message' => $voteResponse]);
    }
);

$f3->route('POST /discussionDislike',
    function($f3) {
        $username = $f3->get('POST.username');
        $controller = new SimpleControllerDiscussion();

        $f3->set('formTitle', $username);
        $voteResponse = $controller->dislike($username);
        echo json_encode(['message' => $voteResponse]);
    }
);

$f3->route('POST /discussionPost',
    function($f3) {
        $username = $f3->get('SESSION.user');
        $reviewText = $f3->get('POST.name');

        $discussionController = new SimpleControllerDiscussion();

        $existingReview = $discussionController->search('username', $username);
        if (!empty($existingReview)) {
            $f3->reroute('/discussion?reviewExists=true');
        } else {
            $data = [
                "bookID" => "a", // Dummy bookID
                "username" => $username,
                "review" => $reviewText,
                "likes" => 0
            ];

            // Insert data into the database
            $discussionController->putIntoDatabase($data);

            // Redirect or respond upon successful insertion
            $f3->reroute('/discussion');
        }
    }
);



$f3->route('GET /voteForBook',
    function($f3) {
        if ($f3->exists('SESSION.user')) {
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $controller = new SimpleControllerNextBook();
        $alldata = $controller->getData();

        $f3->set("dbData", $alldata);
        $f3->set('html_title','Vote For Next Weeks Book');
        $f3->set('content','voteforbook.html');
        echo template::instance()->render('layout.html');
    }
);



$f3->route('POST /voteForBook',
    function($f3) {
        // Check if the user is logged in
        //if (!$f3->exists('SESSION.user')) {
            // User is not logged in, return error message
        //    echo json_encode(['error' => 'You must be logged in to vote.']);
        //    return; // Important to return here to prevent further execution
        //}

        // User is logged in, proceed with voting logic
        $booktitle = $f3->get('POST.name');
        $controller = new SimpleControllerNextBook();

        $f3->set('formTitle', $booktitle);
        $voteResponse = $controller->voteFor($booktitle);

        // Assuming voteFor method returns a string message or similar
        // You may need to adjust this based on the actual return value of voteFor
        echo json_encode(['message' => $voteResponse]);
    }
);

$f3->route('POST /upvote',
    function($f3) {
        // Check if title is set
        if (!$f3->exists('POST.title')) {
            echo json_encode(array('error' => 'Title not provided'));
            return;
        }
        $title = $f3->get('POST.title');

        // Instantiate your controller
        $controller = new SimpleControllerNextBook();

        // Call the voteForTitle method to increment the vote count for the given title
        $result = $controller->voteForTitle($title);

        // You can return a response here, for example:
        echo json_encode(array('result' => $result));
        $f3->set('html_title','Viewing the data');
        $f3->set('content','voteforbook.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /navbartest',
    function($f3) {
        $f3->set('html_title','navbar test page');
        $f3->set('content','navbartest.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /apitest',
    function($f3) {
        $f3->set('html_title','API Test');
        $f3->set('content','apiTest.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /navbar',
    function($f3) {
        $f3->set('html_title','navbar test page');
        $f3->set('content','navbar.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /personalLibrary',
    function($f3) {
        $f3->set('html_title','navbar test page');
        $f3->set('content','personalLibrary.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /publicLibrary3',
    function($f3) {
        $f3->set('html_title','navbar test page');
        $f3->set('content','publicLibrary3.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /fullScreen',
    function($f3) {
        $f3->set('html_title','Full Screen Reader');
        $f3->set('content','fullScreen.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /libraryTest',
    function($f3) {
        $f3->set('html_title','test');
        $f3->set('content','libraryTest.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /libraryTest2',
    function($f3) {
        $f3->set('html_title','test');
        $f3->set('content','libraryTest2.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /libraryTest2',
    function($f3) {
        if ($f3->exists('SESSION.user')) {
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $controller = new SimpleControllerNextBook();
        $alldata = $controller->getData();

        $f3->set("dbData", $alldata);
        $f3->set('html_title','TEST');
        $f3->set('content','libraryTest2.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /libraryTest8',
    function($f3) {
        if ($f3->exists('SESSION.user')) {
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $controller = new SimpleControllerNextBook();
        $alldata = $controller->getData();

        $f3->set("dbData", $alldata);
        $f3->set('html_title','TEST');
        $f3->set('content','libraryTest8.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /libraryTest3',
    function($f3) {
        $f3->set('html_title','test');
        $f3->set('content','libraryTest3.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('GET /publicLibrary',
    function($f3) {
        $f3->set('html_title','Public Library');
        $f3->set('content','publicLibrary.html');
        echo template::instance()->render('layout.html');
    }
);


$f3->route('GET /privateLibrary',
    function($f3) {
        if ($f3->exists('SESSION.user')) {
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $f3->set('html_title','Private Library');
        $f3->set('content','privateLibrary.html');
        echo template::instance()->render('layout.html');
    }
);
$f3->route('POST /makeFavourite', function($f3) {
    $username = $f3->get('SESSION.user'); // Assuming you store the username in session
    $isbn = $f3->get('POST.isbn');

    if (!$username || !$isbn) {
        echo json_encode(['error' => 'Missing parameters']);
        return;
    }

    // Assuming you have a way to get an instance of your controller
    $controller = new SimpleControllerPersonalLibrary();
    $controller->markAsFavourite($username, $isbn);

    echo json_encode(['success' => true]);
});


$f3->route('GET /favourites',
    function($f3) {
        if ($f3->exists('SESSION.user')) {
            $f3->set('loggedIn', true);
        } else {
            $f3->set('loggedIn', false);
        }
        $f3->set('html_title','Favourites');
        $f3->set('content','favourites.html');
        echo template::instance()->render('layout.html');
    }
);

$f3->route('GET /alternate',
    function($f3) {
        $f3->set('html_title','test');
        $f3->set('content','alternate.html');
        echo template::instance()->render('layout.html');
    }
);


$f3->route('GET /api/read-books', function($f3) {
    echo json_encode([
        ["isbn" => "9780140328721"],
        ["isbn" => "9780439554930"],
        ["isbn" => "9780061120084"]
    ]);
});




$f3->route('GET /api/favourite-books', function($f3) {
    $controller = new SimpleControllerPersonalLibrary();
    $username = $f3->get('SESSION.user');
    echo json_encode($controller->findFavourites($username));
});

$f3->route('GET /api/user-read', function($f3) {
    $controller = new SimpleControllerPersonalLibrary();
    $username = $f3->get('SESSION.user');
    echo json_encode($controller->findUserRead($username));
});


$f3->route('GET /api/get-isbn', function($f3) {
    $controller = new SimpleControllerThisWeek();
    $isbns = $controller->getAllISBNs();
    // Assuming there's only ever one ISBN
    $isbn = count($isbns) > 0 ? $isbns[0] : "";
    echo json_encode(['isbn' => $isbn]);
});
  ////////////////////////
 // Run the FFF engine //
////////////////////////

$f3->run();
