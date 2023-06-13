@extends('layouts.dashboard')
@section('content')
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Anggaran Terpakai</p>
                  <h5 class="font-weight-bolder"> $53,000 </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"> <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">List of Projects</p>
                  <h5 class="font-weight-bolder"> 2,300 </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle"> <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">List Permintaan</p>
                  <h5 class="font-weight-bolder"> +3,462 </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle"> <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Sedang Berjalan</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Anggaran</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Progress</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><div class="d-flex px-2">
                        <div> <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify"> </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Spotify</h6>
                        </div>
                      </div></td>
                    <td><p class="text-sm font-weight-bold mb-0">$2,500</p></td>
                    <td><span class="text-xs font-weight-bold">working</span></td>
                    <td class="align-middle text-center"><div class="d-flex align-items-center justify-content-center"> <span class="me-2 text-xs font-weight-bold">60%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                          </div>
                        </div>
                      </div></td>
                    <td class="align-middle"><button class="btn btn-link text-secondary mb-0"> <i class="fa fa-ellipsis-v text-xs"></i> </button></td>
                  </tr>
                  <tr>
                    <td><div class="d-flex px-2">
                        <div> <img src="../assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision"> </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Invision</h6>
                        </div>
                      </div></td>
                    <td><p class="text-sm font-weight-bold mb-0">$5,000</p></td>
                    <td><span class="text-xs font-weight-bold">done</span></td>
                    <td class="align-middle text-center"><div class="d-flex align-items-center justify-content-center"> <span class="me-2 text-xs font-weight-bold">100%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div></td>
                    <td class="align-middle"><button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v text-xs"></i> </button></td>
                  </tr>
                  <tr>
                    <td><div class="d-flex px-2">
                        <div> <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira"> </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Jira</h6>
                        </div>
                      </div></td>
                    <td><p class="text-sm font-weight-bold mb-0">$3,400</p></td>
                    <td><span class="text-xs font-weight-bold">canceled</span></td>
                    <td class="align-middle text-center"><div class="d-flex align-items-center justify-content-center"> <span class="me-2 text-xs font-weight-bold">30%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                          </div>
                        </div>
                      </div></td>
                    <td class="align-middle"><button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v text-xs"></i> </button></td>
                  </tr>
                  <tr>
                    <td><div class="d-flex px-2">
                        <div> <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack"> </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Slack</h6>
                        </div>
                      </div></td>
                    <td><p class="text-sm font-weight-bold mb-0">$1,000</p></td>
                    <td><span class="text-xs font-weight-bold">canceled</span></td>
                    <td class="align-middle text-center"><div class="d-flex align-items-center justify-content-center"> <span class="me-2 text-xs font-weight-bold">0%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                          </div>
                        </div>
                      </div></td>
                    <td class="align-middle"><button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v text-xs"></i> </button></td>
                  </tr>
                  <tr>
                    <td><div class="d-flex px-2">
                        <div> <img src="../assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev"> </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Webdev</h6>
                        </div>
                      </div></td>
                    <td><p class="text-sm font-weight-bold mb-0">$14,000</p></td>
                    <td><span class="text-xs font-weight-bold">working</span></td>
                    <td class="align-middle text-center"><div class="d-flex align-items-center justify-content-center"> <span class="me-2 text-xs font-weight-bold">80%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                          </div>
                        </div>
                      </div></td>
                    <td class="align-middle"><button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v text-xs"></i> </button></td>
                  </tr>
                  <tr>
                    <td><div class="d-flex px-2">
                        <div> <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd"> </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Adobe XD</h6>
                        </div>
                      </div></td>
                    <td><p class="text-sm font-weight-bold mb-0">$2,300</p></td>
                    <td><span class="text-xs font-weight-bold">done</span></td>
                    <td class="align-middle text-center"><div class="d-flex align-items-center justify-content-center"> <span class="me-2 text-xs font-weight-bold">100%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div></td>
                    <td class="align-middle"><button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v text-xs"></i> </button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">
          <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner border-radius-lg h-100">
              <div class="carousel-item h-100 active" style="background-image: url('../assets/img/carousel-1.jpg');
      background-size: cover;">
                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                  <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3"> <i class="ni ni-camera-compact text-dark opacity-10"></i> </div>
                  <h5 class="text-white mb-1">Get started with Argon</h5>
                  <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                </div>
              </div>
              <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-2.jpg');
      background-size: cover;">
                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                  <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3"> <i class="ni ni-bulb-61 text-dark opacity-10"></i> </div>
                  <h5 class="text-white mb-1">Faster way to create web pages</h5>
                  <p>That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
                </div>
              </div>
              <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-3.jpg');
      background-size: cover;">
                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                  <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3"> <i class="ni ni-trophy text-dark opacity-10"></i> </div>
                  <h5 class="text-white mb-1">Share with us your design tips!</h5>
                  <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> </button>
            <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> </button>
          </div>
        </div>
      </div>
    </div>
@endsection