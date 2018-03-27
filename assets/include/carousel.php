<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 1/29/2018
 * Time: 5:43 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$db = new db();



$carouselresult = $db->query("SELECT * FROM carousel WHERE carousel_is_enabled = 1")
    or die("Error here: ".mysqli_error($db::$mysqli));

$firstActive = 1;
$indicatorsNum = 1;
$indicators = '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
while($carouselrow = mysqli_fetch_assoc($carouselresult))
{
    if($firstActive){
?>

<div class="container">
    <div id="myCarousel" class="carousel slide" data-interval="5000" >

        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo $carouselrow['carousel_image_link']; ?>" style=" width:100%" class="img-responsive">
                <div class="container">
                    <div class="carousel-title">
                        <div class="col-md-12">
                            <div class="col-md-offset-6 col-md-8">
                                <?php echo $carouselrow['carousel_body']; ?>
                                <a class="btn btn-lg btn-primary site-btn"
                                   href=" <?php echo $carouselrow['carousel_url'];
                                   $firstActive = 0; ?>">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            } else {
            echo '
            <div class="item">
                <img src="'. $carouselrow['carousel_image_link'] . '" class="img-responsive">
                <div class="container">
                    <div class="carousel-title">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                '. $carouselrow['carousel_body'] .'
                                <a class="btn btn-lg btn-primary site-btn" href="'. $carouselrow['carousel_url'] .'">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            $indicators .= '<li data-target="#myCarousel" data-slide-to="'. $indicatorsNum .'"></li>';
            $indicatorsNum++;
            }
    }
    ?>
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php echo $indicators; ?>
            </ol>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>
</div>
<!-- used to kickstart the carousel to start transitioning -->
<script type="text/javascript" src="assets/js/carousel.js"></script>