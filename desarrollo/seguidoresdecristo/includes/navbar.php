        <div class="w3-top">
            <div class="w3-bar w3-dark-grey w3-card w3-left-align w3-large">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-white" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <a href="index.php" class="w3-bar-item w3-button w3-padding-large <?php echo mnActive($pagActiva, "index"); ?>">Home</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 1</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 2</a>
                <a href="contacto.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large <?php echo mnActive($pagActiva, "contacto"); ?>">Contacto</a>
                <a href="javascript:void" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" onclick="document.getElementById('mdlLogin').style.display = 'block'">Login</a>
            </div>
            <!-- Navbar on small screens -->
            <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large <?php echo mnActive($pagActiva, "contacto"); ?>">Contacto</a>
                <a href="contacto.php" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
            </div>
        </div>