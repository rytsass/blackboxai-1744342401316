<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    if(!empty($name) && !empty($email) && !is_numeric($name))
    {
        //save to database
        $user_id = random_num(20);
        $query = "INSERT INTO users (user_id, name, email) VALUES ('$user_id', '$name', '$email')";

        mysqli_query($con, $query);

        header("Location: thank_you.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste the Globe</title>
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="script.js"></script>
    <style>
        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ddf6cd; 
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            width: 75px;
            height: 75px;
            background-image: url('images/globe.png'); /* Replace with your globe image */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            animation: spin 4s linear infinite; /* Adjust animation speed */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <body>
        <link href='https://fonts.googleapis.com/css?family=Imperial Script' rel='stylesheet'>
        <header>
            <div class="logo">Taste the Globe</div>
            <div class="actions">
                <button class="sign-up">SIGN UP</button>
                <div class="search-wrapper">
                    <input type="text" class="search-input" placeholder="Search...">
                    <button class="search-btn">&#128269;SEARCH</button>
            </div>
        </header>
    
    
    <section class="hero0">
            <div class="logo"></div>
            <nav>
                <a href="#"></a>
                <a href="index.html">HOME</a>
                <div class="dropdown">
                    <hover class="dropbtn">RECIPE</hover>
                    <div class="dropdown-content">
                        <a href="index.html#products">All Recipes</a>
                        <a href="recipes.html">Ingredients</a>
                        <a href="#">Recipe Tips</a>
                        <a href="#">World-Class Cuisines</a>
                    </div>
                </div>
                <a href="#contact">FAQ</a>
                <a href="index.html#about">ABOUT US</a>
            </nav>
        </section>

    <section class="hero">
        <h1>
            TASTE<br>
            THE<br>
            GLOBE
        </h1>
        <button class="discover-btn">DISCOVER MORE</button>
        <p>Get personalized recipes, and exclusive tips and tricks straight to your inbox!</p>
    </section>

    <main>
        <section id="products" class="section">
            <h2>What dish are you looking for?</h2>
            <div class="cards">
                <div class="card">
                    <img src="images/2nd.jpg" alt="French Cuisines">
                    <h3>French Cuisines</h3>
                    <p>French cuisine—a true delight for the senses. Known for its elegance, sophistication, and rich flavors, French cuisine has something for everyone.</p>
                </div>
                <div class="card">
                    <img src="images/1st.jpg" alt="Asian Cuisines">
                    <h3>Asian Cuisines</h3>
                    <p>Asian cuisine is incredibly diverse, reflecting the rich cultural heritage and geographical variety of the continent.</p>
                </div>
                <div class="card">
                    <img src="images/6th.jpg" alt="American Cuisines">
                    <h3>American Cuisines</h3>
                    <p>Native Americans utilized a number of cooking methods in early American cuisine that have been blended with the methods of early Europeans to form the basis of what is now American cuisine.</p>
                </div>
                <div class="card">
                    <img src="images/4th.jpg" alt="Mediterranean Cuisines">
                    <h3>Mediterranean Cuisines</h3>
                    <p>Asian cuisine is incredibly diverse, reflecting the rich cultural heritage and geographical variety of the continent.</p>
                </div>
                <div class="card">
                    <img src="images/8th.jpg" alt="Italian Cuisines">
                    <h3>Italian Cuisines</h3>
                    <p>Asian cuisine is incredibly diverse, reflecting the rich cultural heritage and geographical variety of the continent.</p>
                </div>
                <div class="card">
                    <img src="images/3rd.jpg" alt="Mexican Cuisines">
                    <h3>Mexican Cuisines</h3>
                    <p>Asian cuisine is incredibly diverse, reflecting the rich cultural heritage and geographical variety of the continent.</p>
                </div>
            </div>
        </section>

        <section id="about" class="section2">
            <h2>We don’t just share recipes—we take you on a culinary journey around the world.</h2>
            <p>Through rich storytelling, expert tips, and a vibrant community of food lovers, Taste The Globe transforms every dish into an experience, bringing global flavors straight to your kitchen.</p>
        </section>

        <section id="recipe-recommendation" class="section3">
            <h2>Get Recipe Recommendations</h2>
            <p>Sign up to receive personalized recipes straight to your inbox!</p>
            <form action="recommendation.php" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                
                <button type="submit">Submit</button>
            </form>
        </section>

        <section id="contact" class="section4">
            <h2>Contact Us</h2>
            <p>Email: <a href="mailto:princesskylita@gmail.com">princesskylita@gmail.com</a></p>
            <p>Phone: +123 456 7890</p>
            <p>Address: Brgy - Kantutay, Zone - 4, Beverly Hills</p>
        </section>
    </main>

    <!-- Modal -->
    <div id="signUpModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Get Recipe Recommendations</h2>
            <p class="modal-content-text">Sign up to receive personalized recipes straight to your inbox!</p>
            <form action="recommendation.php" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Taste the Globe. All Rights Reserved.</p>
    </footer>

    <script>
        // Preloader functionality
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('preloader').style.display = 'none';
            }, 4000); // Delay of 4000 milliseconds (4 seconds)
        });
    </script>
</body>
</html>