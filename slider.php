<?php
/**
 * Header slider
 *
 * Theme Name: Food Recipe
 */
?>

<div class="slider"> <!-- Slider -->
    <div id="carousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo get_template_directory_uri() ?>/img/cake.jpg" alt="" width="100%">
                <div class="carousel-caption">
                    <h3>Lorem ipsum dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation</p>
                    <a class="btn slidebtn" href="#">READ MORE</a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo get_template_directory_uri() ?>/img/kaboompics.jpg" alt="">
                <div class="carousel-caption">
                    <h3>Lorem ipsum dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation</p>
                    <a class="btn slidebtn" href="#">READ MORE</a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo get_template_directory_uri() ?>/img/water-green-hi-res.jpg" alt="">
                <div class="carousel-caption">
                    <h3>Lorem ipsum dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation</p>
                    <a class="btn slidebtn" href="#">READ MORE</a>
                </div>
            </div>
        </div>
        <!-- Arrows for changing slides -->
        <div class="arrows">
            <div class="arrow-one">
                <a href="#carousel" class="left carousel-control slider-left" data-slide="prev">
                    <span class="fa fa-chevron-left"></span>
                </a>
            </div>
            <div class="arrow-two">
                <a href="#carousel" class="right carousel-control slider-right" data-slide="next">
                    <span class="fa fa-chevron-right"></span>
                </a>
            </div>
        </div>
    </div><!-- carousel -->
</div><!-- slider -->
