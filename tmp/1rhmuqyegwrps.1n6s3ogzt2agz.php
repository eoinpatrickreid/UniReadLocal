<div class="logo">
    <a href="<?= ($BASE) ?>/home">
        <img src="imageFolder/titleWhite.png" alt="uniREAD Logo" style="height: 120px; width: auto;">
    </a>
</div>
<div id="navbar-placeholder"></div>
<img id="discuss" src="images/discuss.png" alt="Discuss">


<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch("<?= ($BASE) ?>/navbar")
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar-placeholder').innerHTML = data;
                // Move the submenu logic here, after the navbar has been loaded
                setupSubmenuToggle();
            });
    });

    function toggleNav() {
        var nav = document.getElementById("mySidenav");
        nav.style.width = nav.style.width === "250px" ? "0" : "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function setupSubmenuToggle() {
        var submenuToggle = document.querySelector('.submenu-toggle');
        if (submenuToggle) {
            submenuToggle.onclick = function() {
                var submenu = document.querySelector('.submenu');
                if (submenu) {
                    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                } else {
                    console.error("Submenu element not found.");
                }
            };
        } else {
            console.error("Submenu toggle button not found.");
        }
    }
</script>
<head>
    <title>Discussion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        @font-face {
            font-family: 'DOS-V';
            src: url('fonts/Px437_DOS-V_re_ANK24.ttf') format('truetype');
        }
        body {
            font-family: 'DOS-V', monospace;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            top: 20%;
        }
        .review {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        #discuss{
            position: absolute;
            top: 10%;
            left: 30%;
        }
        .review h3 {
            margin-top: 0;
        }
        .like-button, .dislike-button {
            background-color: #22961a;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .dislike-button {
            background-color: #dc3545;
        }
        .like-button:hover, .dislike-button:hover {
            opacity: 0.7;
        }
        button{
            cursor: pointer;
            outline: 0;
            color: #AAA;

        }
        .like-button:focus {
            outline: none;
        }
        .dislike-button:focus {
            outline: none;
        }

        .green{
            color: green;
        }

        .red{
            color: red;
        }
         body {
             display: flex;
             flex-direction: column;
             align-items: center;
             text-align: center;
         }
        html, body {
            margin: 0;
            padding: 0;
            height: 200%;
            width: auto;

            background: linear-gradient(to bottom, #b6fbff 0%, #83a4d4 100%);
            overflow: auto;
        }
        iframe {
            width: 100%;
            height: calc(100% - 40px);
            border: none;
        }
        .link-bar a, .menu-toggle {
            color: #000;
            text-decoration: none;
            margin: 0 10px;
            font-family: Arial, sans-serif;
            cursor: pointer;
        }
        .side-nav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 25px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }
        .side-nav a:hover {
            color: #f1f1f1;
        }
        #navbar-placeholder {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .logo {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1001;
            margin: 5px;
            transform: rotate(-10deg);
        }
        h2 {
            margin-top: 130px;
            font-size: 32px;
            z-index: 1002;
            position: relative;
            color: black;
        }
        #reviews-container {
            position: absolute;
            top: 40%;
            margin-top: 0;
            max-width: 80%; /* Adjust based on your preference */
            width: 100%;
            /* Removed max-height and overflow-y properties */
            padding: 10px;
            background-color: #f9f9f9; /* Light background for the container */
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Subtle shadow for depth */
            border-radius: 0px; /* Optional: rounds the corners */
            display: flex;
            flex-direction: column;
            align-items: center; /* Aligns reviews to the center */
            gap: 0px; /* Spaces out the reviews */
            border: 3px solid var(--color-shadow, currentColor);
            box-shadow: .5rem .5rem 0 var(--color-shadow, currentColor);
        }
        .container-header {
 /* Adds some space between the content and the border */
            background: var(--color-background);
            padding: 0px;
            margin-top: 0px;
            border-radius: var(--size-radius);
            border: 3px solid var(--color-shadow, currentColor);
            box-shadow: .5rem .5rem 0 var(--color-shadow, currentColor);

        }
        #reviews-container .container-header h2 {
            margin-top: 0; /* Reduces the space above the "Book Discussion" */
        }
        .card h2, .card .input__label {
            margin-top: 0; /* Adjust this value as needed */
        }
        form#form1 {
            width: 100%; /* Ensures the form occupies the full width of its parent */
            box-sizing: border-box; /* Makes sure padding and borders are included in the width calculation */
/* Adds some space between the form and the border */
            margin-bottom: 10px; /* Adds some space between the border and next content */
            font-size: 15pt;
            background: var(--color-background);
            padding: 10px;
            margin-top: 10px;
            border-radius: var(--size-radius);

        }

        .review {
            width: 95%; /* Makes each review take up most of the container width */
            margin: 0; /* Adjust if necessary, depending on your design */
            /* Keep the rest of your .review styles */
            background-color: #f9f9f9;

            background: var(--color-background);
            padding: 10px;
            margin-top: calc(4 * var(--size-bezel));
            border-radius: var(--size-radius);
            border: 3px solid var(--color-shadow, currentColor);

        }
        select {
        }
        .book-display {
            text-align: center;
            margin-bottom: 10px;
        }
        .book-cover {
            max-width: 200px;
            margin: 10px auto;
        }
        .book-title {
            font-size: 24px;
            color: #333;
        }
        .book-summary {
            font-size: 16px;
            color: #666;
        }

        @import url('https://rsms.me/inter/inter.css');

        :root {
            --color-light: white;
            --color-dark: #212121;
            --color-signal: #fab700;

            --color-background: var(--color-light);
            --color-text: var(--color-dark);
            --color-accent: var(--color-signal);

            --size-bezel: .5rem;
            --size-radius: 4px;

            line-height: 1.4;

            font-family: 'Inter', sans-serif;
            font-size: calc(.6rem + .4vw);
            color: var(--color-text);
            background: var(--color-background);
            font-weight: 300;
            padding: 0 calc(var(--size-bezel) * 3);
        }

        h1, h2, h3 {
            font-weight: 900;
        }

        mark {
            background: var(--color-accent);
            color: var(--color-text);
            font-weight: bold;
            padding: 0 0.2em;
        }

        .card {
            background: var(--color-background);
            padding: calc(4 * var(--size-bezel));
            margin-top: calc(4 * var(--size-bezel));
            border-radius: var(--size-radius);
            border: 3px solid var(--color-shadow, currentColor);
            box-shadow: .5rem .5rem 0 var(--color-shadow, currentColor);

            &--inverted {
                --color-background: var(--color-dark);
                color: var(--color-light);
                --color-shadow: var(--color-accent);
            }

            &--accent {
                --color-background: var(--color-signal);
                --color-accent: var(--color-light);
                color: var(--color-dark);
            }

            *:first-child {
                margin-top: 0;
            }
        }


        .l-design-widht {
            max-width: 40rem;
            padding: 1rem;
        }

        .input {
            position: relative;

            &__label {
                position: absolute;
                left: 0;
                top: 0;
                padding: calc(var(--size-bezel) * 0.75) calc(var(--size-bezel) * .5);
                margin: calc(var(--size-bezel) * 0.75 + 3px) calc(var(--size-bezel) * .5);
                background: pink;
                white-space: nowrap;
                transform: translate(0, 0);
                transform-origin: 0 0;
                background: var(--color-background);
                transition: transform 120ms ease-in;
                font-weight: bold;
                line-height: 1.2;
            }
            &__field {
                box-sizing: border-box;
                display: block;
                width: 100%;
                border: 3px solid currentColor;
                padding: calc(var(--size-bezel) * 1.5) var(--size-bezel);
                color: currentColor;
                background: transparent;
                border-radius: var(--size-radius);

                &:focus,
                &:not(:placeholder-shown) {
                    & + .input__label {
                        transform: translate(.25rem, -65%) scale(.8);
                        color: var(--color-accent);
                    }
                }
            }
        }


        .button-group {
            margin-top: calc(var(--size-bezel) * 2.5);
        }

        button {
            color: currentColor;
            padding: var(--size-bezel) calc(var(--size-bezel) * 2);
            background: var(--color-accent);
            border: none;
            border-radius: var(--size-radius);
            font-weight: 900;

            &[type=reset]{
                background: var(--color-background);
                font-weight: 200;
            }
        }

        button + button {
            margin-left: calc(var(--size-bezel) * 2);
        }

        .icon {
            display: inline-block;
            width: 1em; height: 1em;
            margin-right: .5em;
        }

        .hidden {
            display: none;
        }

        #loginModal a, #loginModal a:visited, #loginModal a:hover, #loginModal a:active {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            position: relative;
            transition: 0.5s color ease;
            text-decoration: none;
            color: #81b3d2;
            font-size: 15pt;
        }

        #loginModal a:hover {
            color: #2f41c9;
        }

        #loginModal a.before:before, #loginModal a.after:after {
            content: "";
            transition: 0.5s all ease;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            position: absolute;
        }

        #loginModal a.before:before {
            top: -0.25em;
        }

        #loginModal a.after:after {
            bottom: -0.25em;
        }

        #loginModal a.before:before, #loginModal a.after:after {
            height: 5px;
            height: 0.35rem;
            width: 0;
            background: #2f41c9;
        }

        #loginModal a.first:after {
            left: 0;
        }

        #loginModal a.before:hover:before, #loginModal a.after:hover:after {
            width: 100%;
        }
        #loginModal .close-btn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 24px; /* Larger font size for better visibility */
            font-weight: bold;
            color: #aaa; /* Lighter color for a subtler look */
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0;
            line-height: 1;
            text-shadow: 0 1px 0 #fff; /* Optional: Adds a subtle shadow to the 'X' for better legibility */
        }

        #loginModal .close-btn:hover {
            color: #777; /* Darker color on hover for visual feedback */
        }
        .card .input__field {
            font-size: 18px; /* Increased font size */
            padding: 15px 20px; /* Increased padding for a larger input area */
            border: 2px solid #d9982b; /* Added a solid border */
            background-color: #eef4ff; /* Light background color */
            margin-bottom: 10px; /* Add some space below the input */
        }
        .reviews-list > h2 {
            margin-top: 0; /* Removes space above "Community Reviews" */
        }
        .reviews-list > label {
            font-size: 15px; /* Match the font size of the input label if you have one */
            margin-right: 10px; /* Space between label and dropdown */
            display: inline-block; /* Ensure label aligns correctly with the dropdown */
            vertical-align: middle; /* Aligns the label vertically to the middle of the dropdown */
        }

        .reviews-list .sort-dropdown {
            font-size: 15px; /* Match the text input's font size */
            padding: 15px 20px; /* Increased padding for a larger area */

            background-color: #c5c7cd; /* Light background color to match the text input */
            margin-bottom: 5px; /* Consistent spacing */
            border-radius: 5px; /* Optional: Adds rounded corners to the dropdown */
            display: inline-block; /* Ensures dropdown aligns with the label */
            vertical-align: middle; /* Aligns the dropdown vertically to the middle */
            cursor: pointer; /* Changes the cursor to indicate it's a selectable element */
        }
        .review {
            padding: 20px;
            border: 3px solid var(--color-shadow, currentColor);
            margin-bottom: 20px; /* Space between reviews */
            border-radius: 5px; /* Optional: rounds the corners */
        }

        .review-username {
            font-size: 24px; /* Large text for username */
            font-weight: bold; /* Make username bold */
            margin-bottom: 10px; /* Space below the username */
        }

        .review-content {
            font-size: 18px; /* Adjust the font size as needed */
            position: relative;
            padding: 0 20px; /* Space for quotation marks */
        }

        .review-quote {
            font-size: 36px; /* Large quotation marks */
            color: #999; /* Light color for quotation marks */
        }

        .review-likes {
            font-size: 16px; /* Adjust as needed */
            margin-top: 10px; /* Space above like count */
        }

        .review-buttons button {
            margin-top: 10px; /* Space above buttons */
            margin-right: 5px; /* Space between buttons */
        }





    </style>
</head>
<body>

<div id="reviews-container">
    <div class="container-header">
        <h2>This Weeks Book:</h2>
        <div class="book-display">
            <img src="" alt="Book cover" class="book-cover" style="display:none;">
            <div class="book-info">
                <div class="book-title">Book Title Placeholder</div>

            </div>
        </div>
    </div>
    <form id="form1" name="form1" method="post" action="<?= ($BASE) ?>/discussionPost"> <!-- Update action URL as needed -->
        <div class="card">
            <h2>What did you think of this weeks book?</h2>
            <p>By leaving a review you automatically add this book to your personal library!</p>
            <label class="input">
                <input class="input__field" type="text" name="name" placeholder="Your thoughts..." />

            </label>
            <div class="button-group">
                <button type="submit" id="submitReview2">Send</button>
                <button type="reset">Reset</button>
            </div>
        </div>
    </form>
    <div class="reviews-list">
        <h2>Community Reviews:</h2>
        <label for="sortReviews">Sort reviews:</label>
        <select id="sortReviews" class="sort-dropdown">
            <option value="likes-desc">Likes (Descending)</option>
            <option value="likes-asc">Likes (Ascending)</option>
        </select>
        <!-- Dynamic reviews will be injected here. Example placeholder below: -->
        <?php foreach (($reviews?:[]) as $review): ?>
            <div class="review">
                <div class="review-username"><?= ($review['username']) ?></div>
                <div class="review-content">
                    <span class="review-quote">“</span>
                    <?= ($review['review'])."
" ?>
                    <span class="review-quote">”</span>
                </div>
                <div class="review-likes">
                    Like Count: <span class="like-count" data-likes="<?= ($review['likes']) ?>" data-username="<?= ($review['username']) ?>"><?= (trim($review['likes'])) ?></span>
                </div>
                <div class="review-buttons">
                    <button class="like-button" data-username="<?= ($review['username']) ?>"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i></button>
                    <button class="dislike-button" data-username="<?= ($review['username']) ?>"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
<div id="loginModal" style="display:none; position:fixed; z-index:1500; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.4);">
    <div style="background-color:#fefefe; margin:15% auto; padding:20px; border:1px solid #888; width:80%; max-width:450px; position: relative;">
        <button class="close-btn">&times;</button>
        <p>You must be logged in to view your favourite books. Please <a class="first after" href="<?= ($BASE) ?>/login">log in</a> or <a class="first after" href="<?= ($BASE) ?>/register">register</a>.</p>
    </div>
</div>

<div id="loginStatus" data-logged-in="<?= ($loggedIn) ?>"></div>
<script>
    $(document).ready(function() {
// 1. First fetch the ISBN from your backend API
fetch("<?= ($BASE) ?>/api/get-isbn")
    .then(response => response.json())
    .then(data => {
        if(data.isbn) {
            var isbn = data.isbn;
            var apiUrl = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;

            // 2. Fetch the book info from Google Books API
            $.getJSON(apiUrl, function(data) {
                if(data.totalItems) {
                    var bookInfo = data.items[0].volumeInfo;
                    var coverImg = bookInfo.imageLinks ? bookInfo.imageLinks.thumbnail : '';
                    var title = bookInfo.title;
                    var summary = bookInfo.description ? bookInfo.description : 'No summary available';

                    $('.book-cover').attr('src', coverImg).show();
                    $('.book-title').text(title);
                    $('.book-summary').text(summary);
                } else {
                    $('.book-title').text('No book found with this week\'s ISBN');
                    $('.book-cover').hide();
                }
            }).fail(function() {
                $('.book-title').text('Failed to load book data');
                $('.book-cover').hide();
            });
        } else {
            $('.book-title').text('No ISBN set for this week.');
            $('.book-cover').hide();
        }
    })
    .catch(error => {
        $('.book-title').text('Failed to load book data');
        $('.book-cover').hide();
    });

        var isLoggedIn = $('#loginStatus').data('logged-in');

        // Handle the form submission
        $('#form1').on('submit', function(e) {
            if (!isLoggedIn) {
                e.preventDefault(); // Prevent form submission
                document.getElementById('loginModal').style.display = 'block';
                return; // Exit the function early
            }
        });
        $('.close-btn').on('click', function() {
            $('#loginModal').hide();
        });

        // Handle like and dislike button clicks
        $('#reviews-container').on('click', '.like-button, .dislike-button', function() {
            if (!isLoggedIn) {
                document.getElementById('loginModal').style.display = 'block';
                return; // Exit the function early
            }

            var username = $(this).data('username');
            var isLike = $(this).hasClass('like-button');
            var actionUrl = isLike ? '<?= ($BASE) ?>/discussionLike' : '<?= ($BASE) ?>/discussionDislike';

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: { 'username': username },
                success: function(response) {
                    if(response.error) {
                        alert(response.error);
                    } else {
                        // Extract vote count from the response
                        const regex = /New vote count: (\d+)/;
                        const match = response.match(regex);
                        if(match) {
                            const voteCount = match[1];
                            $("span.like-count[data-username='" + username + "']").text(voteCount);
                        }
                    }
                },
                error: function() {
                    alert("Error updating vote.");
                }
            });
        });

        // Check for reviewExists query parameter
        var reviewExists = new URLSearchParams(window.location.search).get('reviewExists');
        if (reviewExists) {
            alert('You have reviewed this book!');
        }

        // Sort reviews based on likes
        $('#sortReviews').on('change', function() {
            sortReviews();
        });
    });

    function sortReviews() {
        var sortOrder = $('#sortReviews').val();
        var reviewsContainer = $('.review').parent();
        var reviews = $('.review').toArray();

        reviews.sort(function(a, b) {
            var likesA = parseInt($(a).find('.like-count').data('likes'), 10);
            var likesB = parseInt($(b).find('.like-count').data('likes'), 10);

            return sortOrder === 'likes-desc' ? likesB - likesA : likesA - likesB;
        });

        $.each(reviews, function(index, item) {
            reviewsContainer.append(item); // Re-append each review in the sorted order
        });
    }
    let timer;

    document.addEventListener('input', e => {
        const el = e.target;

        if( el.matches('[data-color]') ) {
            clearTimeout(timer);
            timer = setTimeout(() => {
                document.documentElement.style.setProperty(`--color-${el.dataset.color}`, el.value);
            }, 100)
        }
    })


</script>
</body>

