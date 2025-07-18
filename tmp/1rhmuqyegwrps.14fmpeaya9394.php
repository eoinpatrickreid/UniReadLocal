<div class="logo">
    <a href="<?= ($BASE) ?>/home">
        <img src="imageFolder/titleWhite.png" alt="uniREAD Logo" style="height: 120px; width: auto;">
    </a>
</div>
<div id="navbar-placeholder"></div>
<img id="img" src="imageFolder/tissuePaperesque1.png" alt="Decorative Background">
<img id="text" src="imageFolder/register.png" alt="text">
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
            left: 70%;

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
            right: 40%;
            object-fit: cover;
            z-index: 999;
            transform: rotate(180deg);
        }
        #text {
            position: fixed;
            scale: 70%;
            top: 30%;
            right: 35%;
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

    </style>
</head>
<body>
<?php if ($loggedIn): ?>
    
        <div style="background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; display: flex; flex-direction: column; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); position: fixed; top: 45%; left: 70%;">
            You are already logged in!
        </div>
    
    <?php else: ?>
        <!-- Existing login form code -->
        <form id="form1" name="form1" method="post" action="<?= ($BASE) ?>/register">
            Username: <input name="username" type="text" placeholder="Enter name" id="username" size="50" />
            Password: <input name="password" type="password" placeholder="Enter password" id="password" size="50" />
            Confirm Password: <input name="confirmpassword" type="password" placeholder="Confirm password" id="confirmpassword" size="50" />
            <input type="image" src="imageFolder/rightArrow.png" alt="Submit"/>
            <a href="<?= ($BASE) ?>/login">Have an account? Log in</a>
        </form>
    
<?php endif; ?>
</body>


