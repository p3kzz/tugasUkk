<?php session_start(); ?>
<?php include 'kodeatas.php';?>
<?php include 'kodebawah.php';?>
    <nav class="navbar navbar-dark  fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Pengaduan Masyrakat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            <a class="nav-link active" aria-current="page" href="dasboard.php">Dasboard</a>
            <a class="nav-link active" aria-current="page" href="lapor.php">Pengaduan</a>
            <a class="nav-link active" aria-current="page" href="lihat_laporan.php">lihat pengaduan</a>
            <a class="navbar-brand" href="logout.php">logout</a>
          </li>
          
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<div class="pe">
  <img src="pg17.jpg" class="pi" alt="">
<h1>selamat datang <?=$_SESSION['user']['username'];?></h1>
<h2>di Website Pengaduan Masyrakat</h2>
</div>
<!--<div class="col-md-10 apa">
        <br>
        <h3 class="text-center">Pengaduan Terbaru</h3>
        <hr class="custom-line"/>
        <div class="panel-body card-shadow">
          <div class="media-body">
              <img class="img-circle img-sm form-shadow" src="ya.jpg">
                <a>Daus</a>
                <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
              </div>
              <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                  erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                  nisl ut aliquip ex ea commodo consequat.
              </p>
         </div>
        </div>
     <br> <div class="panel-body card-shadow">
                    <div class="media-body apa">
                          <div>
                          <img class="img-circle img-sm form-shadow" src="ya.jpg">
                          <a>Wahid</a>
                          <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                          </div>
                          <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                           erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                           nisl ut aliquip ex ea commodo consequat.
                          </p>
                          </div>
                                 
                     </div>

                     <br><div class="panel-body card-shadow">
                                <div class="media-body">
                                    <div>
                                    <img class="img-circle img-sm form-shadow" src="ya.jpg"></a>
                                        <a> Ari</a>
                                        <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                                    </div>
                                    <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                                        nisl ut aliquip ex ea commodo consequat.
                                    </p>
                                </div>
                                 media body 
                            </div>
                             panel body 
                        </div>-->
     <!-- <footer>
        <p>Ukksmk2023</p>
      </footer>

