<!--------------Centering div --------------->
<div class="img-slide">
              <div id="myCarousel" class="carousel slide img-slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                      <div class="item active">
                          <img class="img-fluid" src="media/<?= $dataSoc['slider_1'] ?>" alt="slider_1">
                      </div>

                      <div class="item">
                          <img class="img-fluid"  src="media/<?= $dataSoc['slider_2'] ?>" alt="slider_2">
                      </div>

                      <div class="item">
                          <img class="img-fluid"  src="media/<?= $dataSoc['slider_3'] ?>" alt="slider_3">
                      </div>
                  </div>
                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                  </a>
              </div>
  </div>