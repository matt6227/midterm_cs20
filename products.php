<!-- 
Updated to incorporate database instead of hardcoding
 -->
<!DOCTYPE html>
<html>
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="authors" content="Thomas Lai, Amanda Wu, Fortune Akinremi, Matthew Soto">
                <title>Products</title>
                <link rel="stylesheet" href="nav_and_footer.css">
                <link rel="stylesheet" href="products.css">
        </head>

        <body>
                <!-- Top Nav -->
                <header>
                        <div class="navbar">
                                <div class="logo">
                                        <a href="index.html"><h1>Perspectives.</h1></a>
                                </div>
                        
                                <div class="links normal-text">
                                        <a href="products.html">Products</a>
                                        <a href="about_us.html">About Us</a>
                                        <a href="contact_us.html">Contact Us</a>
                                        <a class="menu" onclick="openNav() ">&#9776</a>
                                </div> 
                        </div> 
                        <!-- mobile nav -->
                        <div id="mobileNav" class="overlay ">
                                <a class="closebtn" onclick="closeNav()">&times;</a>
                                <div class="overlay-content ">
                                        <a href="products.html">Products</a>
                                        <a href="about_us.html">About Us</a>
                                        <a href="contact_us.html">Contact Us</a>
                                </div>
                        </div>
                        <script>
                                /* Open when someone clicks on the span element */
                                function openNav() {
                                        document.getElementById("mobileNav").style.width = "100%";
                                }
        
                                /* Close when someone clicks on the "x" symbol inside the overlay */
                                function closeNav() {
                                        document.getElementById("mobileNav").style.width = "0%";
                                }
                        </script>
                </header>

        <?php
                //establish connection info
                $server = "35.212.41.68";
                $userid = "u4vb5tyqht0qg";
                $pw = "grguujchdrjl";
                $db= "dbzlnmvrlrbzov";
                
                /* Create connection */
                $conn = new mysqli($server, $userid, $pw);
           
                /* Check connection */

                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                /* select collections */
                $conn->select_db($db);
                /* run a query with sorting */
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'Default';
                if ($sort == 'asc') {
                        $sql = "SELECT * FROM clothing_list ORDER BY price ASC";
                } elseif ($sort == 'desc') {
                        $sql = "SELECT * FROM clothing_list ORDER BY price DESC";
                } else {
                        $sql = "SELECT * FROM clothing_list";
                }
                $result = $conn->query($sql);

                echo "<div class='body-container'>";
                echo "<div class='title'>";
                echo "<p>Products</p>";
                echo "<div class='body-title-underline'></div>";
                echo "</div>";

                // Create dropdown filter
                echo '<form method="GET" action="products.php">';
                echo '<label for="sort">Sort by price:</label>';
                echo '<select name="sort" onchange="this.form.submit()">';
                echo '<option value="default"';
                if ($sort == 'default') {
                        echo ' selected';
                }
                echo '>Default</option>';
                echo '<option value="asc"';
                if ($sort == 'asc') {
                        echo ' selected';
                }
                echo '>Low to high</option>';
                echo '<option value="desc"';
                if ($sort == 'desc') {
                        echo ' selected';
                }
                echo '>High to low</option>';
                echo '</select>';
                echo '</form>';

                /* Display table */

                /* Create container for cards */
                echo "<div class='cards-container'>";

                while ($row = $result->fetch_assoc()) {
                /* Output card for each item */
                echo "<div class='card'>";
                
                /* Output card image */
                echo "<div class='card-image'>";
                echo "<img src='".$row["URL"]."' alt='".$row["item_name"]."'>";
                echo "</div>";
                
                /* Output card footer with item details and buy button */
                echo "<div class='card-footer'>";
                echo "<div class='details'>";
                echo "<p class='cloth-name'>".$row["item_name"]."</p>";
                echo "<p class='price'>$".$row["price"]."</p>";
                //echo "<p class='quantity'> In stock: ".$row["quantity"]."</p>";         //focus on this (gotta fix)
                echo "<p class='quantity'>" . (($row["quantity"] > 0) ? "Stock: " . $row["quantity"] : "Out of stock") . "</p>";
                echo "</div>";
                echo "<div class='buy'>";
                echo "<a class='buy-button' href='order.html'>Buy</a>";
                echo "</div>";
                echo "</div>";
                
                /* end of card */
                echo "</div>"; 
                }
                /* end of cards container */
                echo "</div>";
                /* end of body container */
                echo "</div>";
                /* End of Display table */
                /* close the connection	*/
                $conn->close();
        ?>


               <!-- Footer -->
                <footer>
                        <div class="footer">
                                <div class="footer-center-container">
                                        <div class="footer-learn-more large-text">Learn more</div>
                                        <div class="footer-buttons-container">
                                                <a class="footer-button1 normal-text" href="faqs.html">
                                                        FAQs
                                                </a>
                                                <a class="footer-button2 normal-text" href="reviews.html">
                                                        Reviews
                                                </a>
                                        </div>
                                </div>
                        </div>
                </footer>
        </body>
</html>
