<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap">

    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/des.css">
    <link rel="stylesheet" href="assets/css/RS.css">
    <title>hmed</title>
</head>

<body>


    <!-- Header -->
    <?php
    include 'header.php';
    ?>


    <script>
        const menuIcon = document.getElementById('menu-icon');
        const navlinks = document.querySelector('.nav-links');
        const mobileHeader = document.querySelector('.mobile-header');

        menuIcon.addEventListener('click', () => {
            navlinks.classList.toggle('show');
            mobileHeader.classList.toggle('show');
        });
    </script>



    <!-- background 100% height ta3 description -->
    <div class="background-image"></div>
    <div class="overlay"></div>

    <!-- Main front page text -->



    <!-- Main Content -->
    <div class="main-content">

        <div class="company-description">
            <h2>Welcome to<img src="./assets/Images/NL.png" alt="logo" class="log"></h2>
            <p>Find your next stay. Search low prices on hotels, homes, and more. Your journey begins here.</p>
        </div>

        <div class="service-icons">
            <div class="icon" onclick="location.href='work-travel.html'">
                <img src="./assets/Images/icons/Work_White.png" alt="Work Travel Icon">
                <p>Work Travel</p>
            </div>

            <div class="icon" onclick="location.href='vacation-travel.html'">
                <img src="./assets/Images/icons/Vac_White.png" alt="Vacation Travel Icon">
                <p>Vacation Travel</p>
            </div>

            <div class="icon" onclick="location.href='hotels.html'">
                <img src="./assets/Images/icons/Hotel_White.png" alt="Hotels Icon">
                <p>Hotels</p>
            </div>

            <a href="hadj et omra.html">
                <div class="icon" onclick="location.href='hajj-omra.html'">
                    <img src="./assets/Images/icons/Mecca_White.png" alt="Hajj and Omra Icon">
                    <p>Hajj & Omra</p>
                </div>
            </a>
        </div>

    </div>


    <!-- above map text -->






    <script>
        const hoverBlock = document.getElementById('hover-block');
        const mapImage = document.getElementById('map-image');
        var audio = new Audio('assets/audio/Mouseover_hard_whoosh.mp3');

        const canvas = document.getElementById('myCanvas');
        const ctx = canvas.getContext('2d');

        const polygonCoords = [
            41, 141, 22, 147, 3, 151, 15, 139, 25, 129, 35, 121, 61, 114, 84, 112, 96, 115, 117, 117, 134, 119, 128, 112, 144, 106, 154,
            111, 163, 115, 172, 117, 187, 110, 195, 105, 210, 97, 220, 93, 235, 88, 249, 88, 257, 89, 273, 90, 294, 90, 315, 90, 325, 90,
            326, 96, 318, 103, 312, 110, 308, 118, 290, 123, 275, 127, 265, 135, 258, 141, 251, 128, 251, 120, 255, 110, 246, 103, 235,
            101, 225, 101, 215, 106, 219, 116, 224, 126, 219, 131, 218, 139, 218, 148, 221, 156, 222, 162, 222, 169, 216, 173, 201, 182,
            182, 190, 162, 206, 151, 217, 143, 228, 143, 235, 130, 229, 120, 227, 108, 227, 102, 238, 102, 246, 111, 253, 119, 247, 122,
            252, 123, 264, 130, 268, 135, 272, 135, 281, 126, 281, 109, 271, 99, 265, 75, 248, 71, 237, 65, 225, 54, 216, 51, 198, 59, 182,
            67, 169, 67, 151, 60, 143
        ];

        function drawPolygon(coords) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            ctx.beginPath();
            ctx.moveTo(coords[0], coords[1]);

            for (let i = 2; i < coords.length; i += 2) {
                ctx.lineTo(coords[i], coords[i + 1]);
            }
            ctx.closePath();
            ctx.strokeStyle = '#000'; // Set the border color
            ctx.lineWidth = 5; // Set the border width
            ctx.stroke();
        }
        drawPolygon(polygonCoords);

        hoverBlock.style.display = 'none';
        // Event listener for mouse move on the image
        mapImage.addEventListener('mousemove', function (event) {
            // Get mouse position relative to the image
            const mouseX = event.offsetX;
            const mouseY = event.offsetY;
            // Update the position and size of the hover block
            hoverBlock.style.left = 50 + '%';
            hoverBlock.style.top = 50 + '%';
        });

        // Event listener for mouse enter/leave on each area
        const areas = document.querySelectorAll('map[name="worldmap"] area');
        areas.forEach(area => {
            area.addEventListener('mouseenter', function () {
                hoverBlock.style.width = this.getAttribute('coords').split(',')[6] + 'px';
                hoverBlock.style.height = this.getAttribute('coords').split(',')[7] + 'px';
                hoverBlock.style.display = 'block';
                audio.play();
            });

            area.addEventListener('mouseleave', function () {
                hoverBlock.style.display = 'none';
                audio.play();
            });
        });
    </script>

    <section id="destination" class="destination-section section">
        <h2 class="section_title">Discover the most <br> attractive places</h2>
        <section class="destinations">
            <div class="wrapper">
                <div class="card">
                    <div class="poster">
                        <img src="./assets/Images/destination/dubai.jpg" alt="">Dubaï
                    </div>
                    <div class="details">
                        <h1>Dubaï</h1>
                        <h2>Burj Khalifa • Dubai Mall • Dubai Miracle Garden</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.7/5</span>
                        </div>
                        <div class="tags">
                            <span class="tag">Tourism</span>
                            <span class="tag">Business</span>
                            <span class="tag">Quality of Life</span>
                        </div>
                        <p class="desc">
                            Dubai: Desert metropolis, home to the Burj Khalifa, luxury shopping, and a global fusion of
                            cultures.
                        </p>
                        <div class="cast">
                            <h3>Nos Hotel</h3>
                            <ul>
                                <li><img src="./assets/Images/destination/burj-al-arab.jpg" alt="burj-al-arab"
                                        title="Hotel"></li>
                                <li><img src="./assets/Images/destination/Atlantis, The Palm.jpg" alt="Atlantis"
                                        title="Hotel"></li>
                                <li><img src="./assets/Images/destination/armani.jpg" alt="Armani" title="Hotel"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="poster"><img src="./assets/Images/destination/London.jpg" alt="London"></div>
                    <div class="details">
                        <h1>London</h1>
                        <h2>The Savoy • Claridge's • The Ritz</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>4/5</span>
                        </div>
                        <div class="tags">
                            <span class="tag">Tourism</span>
                            <span class="tag">Business</span>
                            <span class="tag">Quality of Life</span>
                        </div>
                        <p class="desc">
                            London: Historic meets modern on the Thames, blending iconic landmarks with cultural
                            dynamism.
                        </p>
                        <div class="cast">
                            <h3>Nos Hotel</h3>
                            <ul>
                                <li><img src="./assets/Images/destination/The Savoy.jpg" alt="The Savoy" title="hotel">
                                </li>
                                <li><img src="./assets/Images/destination/Claridge's.jpg" alt="claridge" title="hotel">
                                </li>
                                <li><img src="./assets/Images/destination/The Ritz London.jpg" alt="The Ritz"
                                        title="hotel"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="poster"><img src="./assets/Images/destination/Paris.jpg" alt="Location Unknown"></div>
                    <div class="details">
                        <h1>Paris</h1>
                        <h2>Ritz Paris • Plaza Athénée • Le Bristol Paris</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.7/5</span>
                        </div>
                        <div class="tags">
                            <span class="tag yellow">Tourism</span>
                            <span class="tag">Business</span>
                            <span class="tag blue">Quality of Life</span>
                        </div>
                        <p class="desc">
                            Paris, the epitome of elegance, boasts iconic landmarks, charming streets, and a rich
                            cultural tapestry.
                        </p>
                        <div class="cast">
                            <h3>Nos Hotel</h3>
                            <ul>
                                <li><img src="./assets/Images/destination/Ritz Paris.jpg" alt="Ritz Paris"
                                        title="hotel"></li>
                                <li><img src="./assets/Images/destination/Hôtel Plaza Athénée.jpg" alt="Plaza Athénée"
                                        title="hotel"></li>
                                <li><img src="./assets/Images/destination/Le Bristol Paris.jpg" alt="Le Bristol"
                                        title="hotel"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <button><a href="hotels.php">See More!</a></button>
        </section>
    </section>

    <section id="Hotels" class="hotel-section section">
        <h2 class="section_title">Stay in the <br> Best Hotels</h2>
        <section class="hotels">
            <div class="card">
                <img src="assets/Images/Hotels/Home/1.jpg" alt="">
                <h2 class="title">Mountain View</h2>
                <p class="copy">Check out all of these gorgeous mountain trips with beautiful views of, you guessed it,
                    the mountains</p>
                <button class="btn">View Trips</button>
            </div>
            <div class="card">
                <img src="assets/Images/Hotels/Home/2.jpg" alt="">
                <h2 class="title">To The Beach</h2>
                <p class="copy">Plan your next beach trip with these fabulous destinations</p>
                <button class="btn">View Trips</button>
            </div>
            <div class="card">
                <img src="assets/Images/Hotels/Home/3.jpg" alt="">
                <h2 class="title">Desert Destinations</h2>
                <p class="copy">It's the desert you've always dreamed of</p>
                <button class="btn">Book Now</button>
            </div>
            <div class="card">
                <img src="assets/Images/Hotels/Home/4.jpg" alt="">
                <h2 class="title">Explore The Galaxy</h2>
                <p class="copy">Seriously, straight up, just blast off into outer space today</p>
                <button class="btn">Book Now</button>
            </div>
        </section>
    </section>
    <!-- 
        
        real live shop entrance video 
        test
        choose country on globe

    -->

    <?php
    include 'footer.php';
    ?>


    <!--=============== java Scripts ===============-->

    <script src="assets/js/clickOnMap.js"></script>

    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            // Adding offset to count the header
            const offset = 100; // Adjust this value to set the desired offset

            if (section) {
                const offsetPosition = section.offsetTop - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });

            }
        }
    </script>

    <!-- Effects that come with Scrolling:
            -changing the header background
    -->
    <script src="./assets/js/scroll_effect.js"></script>

</body>

</html>