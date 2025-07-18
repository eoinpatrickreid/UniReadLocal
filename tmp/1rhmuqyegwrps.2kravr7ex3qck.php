<div class="logo">
    <a href="<?= ($BASE) ?>/home">
        <img src="imageFolder/titleWhite.png" alt="uniREAD Logo" style="height: 120px; width: auto;">
    </a>
</div>
<div id="navbar-placeholder"></div>
<img id="img" src="imageFolder/tissuePaperesque2.png" alt="Decorative Background">
<img id="vote" src="images/voteP.png" alt="Vote">
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="icon" type="image/png" href="/img/lib/noun-library-3535139.png">
    <link href="../index.php" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="default.css" />
    <link rel="stylesheet" type="text/css" href="component.css" />
    <script src="ui/js/modernizr.custom.js"></script>
    <style>
        @font-face {
            font-family: 'DOS-V';
            src: url('fonts/Px437_DOS-V_re_ANK24.ttf') format('truetype');
        }
        body {
            font-family: 'DOS-V', monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 130%;
            overflow: scroll;
            background: linear-gradient(to bottom, #b6fbff 0%, #83a4d4 100%);
            font-family: 'DOS-V', monospace;
        }
        iframe {
            width: 100%;
            height: calc(100% - 40px);
            border: none;
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
            margin: 10px;
            transform: rotate(-10deg);
        }
        #img {
            position: fixed;
            width: 100vw;
            height: 30vh;
            top: 0;
            left: 0;
            object-fit: cover;
            z-index: 999;
        }
        #vote {
            top: 10%;
            position: absolute;

            z-index: 1300;
        }
        #art {
            position: absolute;
            width: 120vw;
            height: auto;
            top: 150%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: contain;
            z-index: 999;
        }

        h2 {
            margin: 0;
            font-size: 32px;
            z-index: 1002;
            position: relative;
            color: black;
        }
        #container h2 {
            margin-bottom: 20px; /* Adjust the value as needed */
        }

        #booksTable {
            font-size: 20px;
            z-index: 1002;
            position: relative;

        }

        #img {
            z-index: 998;
            top: -10%;
        }
        #container {
            position: absolute;
            top: 40%;
            margin-top: 0;
            max-width: 80%; /* Adjust based on your preference */
            width: 100%;
            /* Removed max-height and overflow-y properties */
            padding: 10px;
            background-color: #f9f9f9; /* Light background for the container */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            border-radius: 0px; /* Optional: rounds the corners */
            display: flex;
            flex-direction: column;
            align-items: center; /* Aligns reviews to the center */
            gap: 0px; /* Spaces out the reviews */
            border: 3px solid var(--color-shadow, currentColor);
            box-shadow: .5rem .5rem 0 var(--color-shadow, currentColor);
        }
        .container > h2 {
            margin-top: 0; /* Removes space above "Community Reviews" */
        }
        .logo, #navbar-placeholder {
            margin-bottom: 0; /* Reduce margin below these elements if any */
        }
        .upvote {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 20px; /* Top and bottom padding of 10px, left and right padding of 20px */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Hand cursor on hover */
            transition: background-color 0.3s, transform 0.2s; /* Smooth transition for background color and transform */
        }

        .upvote:hover, .upvote:focus {
            background-color: #45a049; /* Darker green background on hover/focus */
            transform: translateY(-2px); /* Slightly raise the button */
            outline: none; /* Remove outline on focus for aesthetics */
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


        .upvote:active {
            transform: translateY(1px); /* Push the button down when clicked */
        }

    </style>

    <div id="loginStatus" data-logged-in="<?= ($loggedIn) ?>"></div>

    <script src="/ui/js/jquery.min.js"></script>
    <script>
        document.addEventListener('scroll', function() {
            const maxScroll = 600; // Maximum scroll in pixels
            if (window.scrollY > maxScroll) {
                window.scrollTo(0, maxScroll);
            }
        });</script>
    <script>

        $(document).ready(function() {
            // Use jQuery to read the 'data-logged-in' attribute
            $('.close-btn').on('click', function() {
                $('#loginModal').hide();
            });

            var isLoggedIn = $('#loginStatus').data('logged-in');

            $('.upvote').on('click', function() {
                // Check if the user is logged in
                if (!isLoggedIn) {
                    document.getElementById('loginModal').style.display = 'block';
                    return; // Exit the function if not logged in
                }

                // Check if any button has already been used to vote
                if ($('.upvote').data('voted')) {
                    document.getElementById('loginModal').style.display = 'block';
                    return; // Exit the function to prevent further action
                }

                // If logged in, proceed with the voting process
                var bookTitle = $(this).data('title');
                $.ajax({
                    url: '<?= ($BASE) ?>/voteforbook',
                    type: 'POST',
                    data: { 'name': bookTitle },
                    success: function(response) {
                        if(response.error) {
                            alert(response.error)
                        } else {
                            $('.upvote').data('voted', true).prop('disabled', true);
                            const message = response;
                            const regex = /New vote count: (\d+)/;
                            const match = message.match(regex);
                            const voteCount = match[1];
                            $("span.vote-count[data-title='" + bookTitle + "']").text(voteCount);
                            reorderBooksTable();
                        }
                    },
                    error: function() {
                        alert("Error updating upvote.");
                    }
                });
            });
        });


        function reorderBooksTable() {
            var rows = $('#booksTable tr').get();
            rows = rows.slice(1).sort(function(a, b) {
                var valA = parseInt($(a).find(".vote-count").text());
                var valB = parseInt($(b).find(".vote-count").text());
                return valB - valA;
            });

            $.each(rows, function(index, row) {
                $('#booksTable').append(row);
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            fetchBookCovers();
        });

        function fetchBookCovers() {
            var booksTable = document.getElementById('booksTable');

            // Assuming 'dbData' is available on the client-side
            // You might need to adjust this to match how your data is passed to the client


            dbData.forEach(function(record) {
                var isbn = record.isbn;
                var title = record.title;
                var votes = record.votes;

                // Create a new row
                var row = booksTable.insertRow(-1);

                // Insert cells: cover, title, votes, vote button
                var coverCell = row.insertCell(0);
                var titleCell = row.insertCell(1);
                var votesCell = row.insertCell(2);
                var voteCell = row.insertCell(3);

                // Set title and votes
                titleCell.textContent = title;
                votesCell.innerHTML = '<span class="vote-count" data-title="' + title + '">' + votes + '</span>';
                voteCell.innerHTML = '<button class="upvote" data-title="' + title + '">Upvote</button>';

                // Fetch the cover image from Google Books API
                fetch('https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn)
                    .then(response => response.json())
                    .then(data => {
                        if(data.totalItems > 0) {
                            var imgUrl = data.items[0].volumeInfo.imageLinks.thumbnail;
                            coverCell.innerHTML = '<img src="' + imgUrl + '" alt="Book Cover" style="height:100px;">';
                        } else {
                            coverCell.textContent = 'No Cover Found';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching book cover:', error);
                        coverCell.textContent = 'Cover Unavailable';
                    });
            })
        }

    </script>
</head>
<body>
<div id="loginModal" style="display:none; position:fixed; z-index:1500; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.4);">
    <div style="background-color:#fefefe; margin:15% auto; padding:20px; border:1px solid #888; width:80%; max-width:450px; position: relative;">
        <button class="close-btn">&times;</button>
        <p>You must be logged in to view your favourite books. Please <a class="first after" href="<?= ($BASE) ?>/login">log in</a> or <a class="first after" href="<?= ($BASE) ?>/register">register</a>.</p>
    </div>
</div>

<div id="container">
    <h2>Vote for next weeks book:</h2>
<table id="booksTable">
    <tr>
        <th>Cover Photo</th><th>Title</th><th>Votes</th><th>Vote</th>
    </tr>
    <?php foreach (($dbData?:[]) as $record): ?>
        <tr>
            <td><img src=<?= ($record['URL']) ?> alt="Cover Photo"></td>
            <td><?= (trim($record['title'])) ?></td>
            <td><span class="vote-count" data-title="<?= ($record['title']) ?>"><?= (trim($record['votes'])) ?></span></td>

            <td>
                <button class="upvote" data-title="<?= ($record['title']) ?>">Upvote</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
</body>

