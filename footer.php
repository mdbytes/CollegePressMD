<footer class="site-footer">
    <div class="site-footer__inner container container--narrow">
        <div class="group">
            <div class="site-footer__col-one">
                <h1 class="school-logo-text school-logo-text--alt-color">
                    <a href="<?php echo site_url() ?>"><img src="<?php echo THEME_URI . '/images/mit-logo-dark.png' ?>" alt="site logo dark letters"></a>
                </h1>
                <p><a class="site-footer__link" href="#">Built by&nbsp; <span class="logo-font">md</span> &nbsp;Web Technologies</a><br>
                    <a class="site-footer__link" href="#">Powered by WordPress<sup>&#174;</sup></a>
                </p>
            </div>

            <div class="site-footer__col-two-three-group">
                <div class="site-footer__col-two">
                    <h3 class="headline headline--small">Explore</h3>
                    <nav class="nav-list">
                        <ul>
                            <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                            <li><a href="<?php echo site_url('/about-us') ?>">About</a></li>
                            <li><a href="<?php echo site_url('/programs') ?>">Programs</a></li>
                            <li><a href="<?php echo site_url('/events') ?>">Events</a></li>
                            <li><a href="<?php echo site_url('/blog') ?>">News</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="site-footer__col-three">
                    <h3 class="headline headline--small">Legal</h3>
                    <nav class="nav-list">
                        <ul>
                            <li><a href="<?php echo site_url('/terms') ?>">Terms and Conditions</a></li>
                            <li><a href="<?php echo site_url('/privacy-policy') ?>">Your Privacy</a></li>
                            <li><a href="<?php echo site_url('/cookie-policy') ?>">Cookies</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="site-footer__col-four">
                <h3 class="headline headline--small">Connect With Us</h3>
                <nav>
                    <ul class="min-list social-icons-list group">
                        <li>
                            <a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="colophon">
            <div class="attribution">Portions of development part of <a href="https://www.udemy.com/course/become-a-wordpress-developer-php-javascript/">WordPress Developer</a> course by <a href="http://learnwebcode.com/">Brad Schiff</a></div>
            <div class="attribution">All photos for this site taken from <a href="https://pixabay.com/">Pixabay</a> with public license.</div>
            <div class="copyright">&copy;&nbsp;<?php echo Date('Y'); ?>, Martin Dwyer,&nbsp; MD Web Technologies.</div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>

</html>