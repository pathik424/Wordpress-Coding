<style>


  
  .testimonials-section {
    padding-top: 60px; 
    overflow: hidden;
  }

  .center-head {
    text-align: center;
    max-width: 600px;
    margin: 0 auto 50px;
  }


  .eyebrow {
    display: inline-block;
    padding: 8px 22px;
    border: 1px solid #d9e6dc;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 18px;
  }

  .eyebrow .accent {
    color: #2fae5c;
  }

  .center-head h2 {
    font-size: 32px;
    color: #152018;
  }


  /* ---- Swiper container ---- */

  .testi-swiper {
    width: 100%;
    padding: 10px 0 10px;
  }


  .testi-swiper .swiper-slide {
    height: auto;
    display: flex;
  }


  .testi-card {

    background: #ffffff;

    border-radius: 22px;

    padding: 34px 30px;

    box-shadow: 0 20px 45px rgba(20, 40, 25, 0.08);

    border: 1px solid #f1f1f1;

    display: flex;

    flex-direction: column;

    width: 100%;

  }



  .stars {

    color: #2fae5c;

    font-size: 16px;

    letter-spacing: 3px;

    margin-bottom: 30px;

  }



  .testi-card p {

    margin-bottom: 26px;

    flex-grow: 1;

  }



  .testi-name {

    font-weight: 600;

    font-size: 20px;

    color: #112418;

  }



  .testi-role {

    font-size: 16px;

    color: #112418;

    font-weight: 400;

    margin-top: 4px;

  }



  /* ---- Pagination dots ---- */

  .swiper-pagination {

    position: static;

    margin-top: 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

  }



  .swiper-pagination-bullet {

    width: 8px;

    height: 8px;

    border-radius: 50%;

    background: #dcece0;

    opacity: 1;

    margin: 0 !important;

    transition: all .25s ease;

  }



  .swiper-pagination-bullet-active {

    width: 26px;

    border-radius: 5px;

    background: #2fae5c;

  }

</style> 







<section class="testimonials-section">
  <div class="container">

  <div class="center-head hiw-header">

    <span class="twenty_four"><?php echo get_field('testimonial_main_heading'); ?></span>

    <h2 class="title_h2"><?php echo get_field('testimonial_trusted'); ?></h2>

  </div>
  </div>



  <div class="swiper testi-swiper">

    <div class="swiper-wrapper">



      <?php if (have_rows('customer_testimonial')) : ?>



        <?php while (have_rows('customer_testimonial')) : the_row();



          $testimonial_description = get_sub_field('testimonial_description');

          $testimonial_customer_name = get_sub_field('testimonial_customer_name');

          $testimonial_position = get_sub_field('testimonial_position');

        ?>



          <div class="swiper-slide">

            <div class="testi-card">

              <?php

              $rating = get_sub_field('testimonial_star_rating');

              ?>



              <div class="stars">

                <?php

                if ($rating == '1') {

                  echo '★';

                } elseif ($rating == '2') {

                  echo '★★';

                } elseif ($rating == '3') {

                  echo '★★★';

                } elseif ($rating == '4') {

                  echo '★★★★';

                } elseif ($rating == '5') {

                  echo '★★★★★';

                }

                ?>

              </div>

              
             
                <?php echo $testimonial_description; ?>


           

              <?php if (! empty($testimonial_customer_name)) : ?>

                <div class="testi-name">

                  <?php echo $testimonial_customer_name; ?>

                </div>

              <?php endif; ?>



              <?php if (! empty($testimonial_position)) : ?>

                <div class="testi-role">

                  <?php echo $testimonial_position; ?>

                </div>

              <?php endif; ?>

            </div>

          </div>



        <?php endwhile; ?>



      <?php endif; ?>



    </div>



    <div class="swiper-pagination"></div>

  </div>

</section>