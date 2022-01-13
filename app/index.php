<?php

$PageTitle="Home";

function customPageHeader(){?>
<?php }

include_once('./frontend/constant/header.php');

?>
  <section class="starter">
    <div class="content">
      <p class="subTitle">Best Trips around the world</p>
      <h1 class="title">
        Travel, <span>Discover</span> and enjoy a new and full life
      </h1>
      <div class="description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam
        molestias, vel aliquid at praesentium quo.
      </div>
    </div>
    <div class="image">
      <img src="assets/traveller1.png" alt="" />
    </div>
  </section>
  <section class="destination">
    <p class="subtitle">Discover our</p>
    <h2 class="title">Top Destinations</h2>
    <div class="cards">
      <div class="card" style="cursor: pointer;" onclick="window.location='/frontend/trip-details/index.php';">
        <div class="image">
          <img src="assets/destination1.png" alt="" />
        </div>
        <div class="content">
          <h3>Rome, Italy</h3>
          <h3>5,32k €</h3>
        </div>
        <div class="content">
          <div class="time">
            <i class="fas fa-location-arrow"></i>
            <h4>10 Days Trip</h4>
          </div>
          <div class="like">
            <div class="count">
              <i class="fas fa-skiing-nordic"></i>
              <span>24 places left</span>
            </div>
          </div>
        </div>
      </div>
      <div class="card" style="cursor: pointer;" onclick="window.location='http://google.com';">
        <div class="image">
          <img src="assets/destination2.jpg" alt="" />
        </div>
        <div class="content">
          <h3>Rome, Italy</h3>
          <h3>5,32k €</h3>
        </div>
        <div class="content">
          <div class="time">
            <i class="fas fa-location-arrow"></i>
            <h4>10 Days Trip</h4>
          </div>
          <div class="like">
            <div class="count">
              <i class="fas fa-skiing-nordic"></i>
              <span>24 places left</span>
            </div>
          </div>
        </div>
      </div>
      <div class="card" style="cursor: pointer;" onclick="window.location='http://google.com';">
        <div class="image">
          <img src="assets/destination3.png" alt="" />
        </div>
        <div class="content">
          <h3>Rome, Italy</h3>
          <h3>5,32k €</h3>
        </div>
        <div class="content">
          <div class="time">
            <i class="fas fa-location-arrow"></i>
            <h4>10 Days Trip</h4>
          </div>
          <div class="like">
            <div class="count">
              <i class="fas fa-skiing-nordic"></i>
              <span>24 places left</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
include_once('./frontend/constant/footer.php');
?>
