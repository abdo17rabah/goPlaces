<?php

$PageTitle="New Page Title";

function customPageHeader(){?>
<?php }

include_once('../../frontend/constant/header.php');

?>
  <section class="next-trip">
    <div class="content">
      <p class="subtitle">Easy and Fast</p>
      <h2 class="title">Book your Next Trip in 3 Easy Steps</h2>
      <div class="steps">
        <div class="step">
          <div class="icon"><img src="../../assets/nextsteps1.png" alt="" /></div>
          <div class="text">
            <h3 class="title">Choose Destination</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Quos, dolor!
            </p>
          </div>
        </div>
        <div class="step">
          <div class="icon"><img src="../../assets/nextsteps2.png" alt="" /></div>
          <div class="text">
            <h3 class="title">Make Payment</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Quos, dolor!
            </p>
          </div>
        </div>
        <div class="step">
          <div class="icon"><img src="../../assets/nextsteps3.png" alt="" /></div>
          <div class="text">
            <h3 class="title">Reach Airport on Selected Date</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Quos, dolor!
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="image">
      <img src="../../assets/traveller1.png" alt="" />
    </div>
  </section>
  <section class="next-trip">
    <div class="trip">
      <img src="../../assets/next trip.jpg" alt="" />
      <h3 class="title">Trip to Greece</h3>
      <p class="subTitle"> Date | 14-29 June</p>
      <div class="like">
        <div class="count">
          <i class="fas fa-skiing-nordic"></i>
          <span>24 places left</span>
        </div>
        <div class="last">
          <button>Book now</button>
        </div>
      </div>
    </div>
  </section>
<?php
include_once('../../frontend/constant/footer.php');
?>
