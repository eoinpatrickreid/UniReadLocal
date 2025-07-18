<div class="logo">
    <a href="<?= ($BASE) ?>/home">
        <img src="imageFolder/titleWhite.png" alt="uniREAD Logo" style="height: 120px; width: auto;">
    </a>
</div>
<div id="navbar-placeholder"></div>
<img id="img" src="imageFolder/tissuePaperesque1.png" alt="Decorative Background">
<img id="text" src="imageFolder/login.png" alt="text">
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
        // Error Modal logic
        var modal = document.getElementById('errorModal');
        var span = document.getElementsByClassName("close")[0];
        var errorMessage = document.getElementById('errorMessage');

        // Check for and display the login error message
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        if (error) {
            errorMessage.textContent = decodeURIComponent(error);
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 10px;
            background: #FF7A00;
        }
        #form1 {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 40%;
            left: 15%;

        }
        #form1 input[type=text], #form1 input[type=password] {
            margin: 10px 0;
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #form1 input[type="image"] {
            cursor: pointer;
            margin-top: 20px;
            width: 20px;
            height: 20px;
        }
        #form1 a {
            color: #000000;
            text-decoration: none;
            margin-top: 15px;
        }
        #form1 a:hover {
            text-decoration: underline;
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
            width: 70vw;
            height: 100vh;
            top: 0;
            left: 40%;
            object-fit: cover;
            z-index: 999;
        }
        #text {
            position: fixed;
            scale: 70%;
            top: 30%;
            left: 40%;
            transform: rotate(-5deg);

            z-index: 999;
        }
        .side-nav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 10;
            top: 0;
            right: 0;
            background: linear-gradient(to bottom, #FF7A00 0%, #fc8111 100%);
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1002; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 20%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


    </style>
</head>
<body>
<!-- Error Modal -->
<div id="errorModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="errorMessage"></p>
    </div>
</div>
<?php if ($loggedIn): ?>
    
        <div style="background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; display: flex; flex-direction: column; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); position: fixed; top: 45%; left: 20%;">
            You are already logged in!
        </div>
    
    <?php else: ?>
        <!-- Existing login form code -->
        <form id="form1" name="form1" method="post" action="<?= ($BASE) ?>/login">
            Username: <input name="username" type="text" placeholder="Enter username" id="username" size="50" />
            Password: <input name="password" type="password" placeholder="Enter password" id="password" size="50" />
            <button type="submit">Submit</button>
            <a href="<?= ($BASE) ?>/register">Register</a>
        </form>
    
<?php endif; ?>
</body>

