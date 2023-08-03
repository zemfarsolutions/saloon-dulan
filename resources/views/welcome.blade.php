@extends('layouts.template')
@section('content')
<div class="col">
    <!-- Title and Top Buttons Start -->
    <div class="page-title-container mb-3">
      <div class="row">
        <!-- Title Start -->
        <div class="col mb-2">
          <h1 class="mb-2 pb-0 display-4" id="title">Getting Started</h1>
          <div class="text-muted font-heading text-small">Let us manage the database engines for your applications so you can focus on building.</div>
        </div>
        <!-- Title End -->
      </div>
    </div>
    <!-- Title and Top Buttons End -->

    <div class="row">
      <!-- Introduction Banner Start -->
      <div class="col-12 col-lg-8 mb-5">
        <div class="card sh-45 h-lg-100 position-relative bg-theme">
          <img src="img/illustration/database.webp" class="card-img h-100 position-absolute theme-filter" alt="card image" />
          <div class="card-img-overlay d-flex flex-column justify-content-end bg-transparent">
            <div class="mb-4">
              <div class="cta-1 mb-2 w-75 w-sm-50">Introduction to Cloud</div>
              <div class="w-50 text-alternate">Lollipop chocolate marzipan marshmallow gummi bears. Tootsie roll liquorice cake jelly beans.</div>
            </div>
            <div>
              <a href="Services.Database.html" class="btn btn-icon btn-icon-start btn-primary mt-3 stretched-link">
                <i data-cs-icon="chevron-right"></i>
                <span>Getting Started</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Introduction Banner End -->

      <!-- Introduction List Start -->
      <div class="col-12 col-lg-4 mb-5">
        <div class="scroll-out">
          <div class="scroll-by-count" data-count="4">
            <div class="card mb-2 hover-border-primary">
              <a href="Services.DatabaseAdd.html" class="row g-0 sh-9">
                <div class="col-auto">
                  <div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
                    <div class="fw-bold text-primary">
                      <i data-cs-icon="server"></i>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="text-alternate">Add New Volume</div>
                      <div class="text-small text-muted">Snaps muffin macaroon.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="card mb-2 hover-border-primary">
              <a href="Services.Storage.html" class="row g-0 sh-9">
                <div class="col-auto">
                  <div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
                    <div class="fw-bold text-primary">
                      <i data-cs-icon="cloud-download"></i>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="text-alternate">Cloud Storage</div>
                      <div class="text-small text-muted">Brownie ice cream marshmallow topping.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="card mb-2 hover-border-primary">
              <a href="Account.Security.html" class="row g-0 sh-9">
                <div class="col-auto">
                  <div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
                    <div class="fw-bold text-primary">
                      <i data-cs-icon="shield"></i>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="text-alternate">Server Security</div>
                      <div class="text-small text-muted">Sugar plum gummi bears jujubes.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="card mb-2 hover-border-primary">
              <a href="Services.DatabaseDetail.html" class="row g-0 sh-9">
                <div class="col-auto">
                  <div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
                    <div class="fw-bold text-primary">
                      <i data-cs-icon="chart-4"></i>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="text-alternate">Track Metrics</div>
                      <div class="text-small text-muted">Jujubes candy jelly-o topping.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="card mb-2 hover-border-primary">
              <a href="Support.Docs.html" class="row g-0 sh-9">
                <div class="col-auto">
                  <div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
                    <div class="fw-bold text-primary">
                      <i data-cs-icon="diagram-2"></i>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="text-alternate">Integration Guides</div>
                      <div class="text-small text-muted">Jujubes candy jelly-o topping.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Introduction List End -->
    </div>

    <!-- Guildes Start -->
    <div class="mb-5">
      <h2 class="small-title">Guides</h2>
      <div class="row g-2 row-cols-1 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <div class="text-center">
                <img src="img/illustration/icon-launch.webp" class="theme-filter" alt="launch" />
                <div class="d-flex flex-column sh-5">
                  <a href="Support.KnowledgeBase.html" class="heading stretched-link">Application Launch</a>
                </div>
              </div>
              <div class="text-muted">Chocolate cake marshmallow bear claw sweet. Apple pie macaroon sesame snaps candy jelly pudding.</div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <div class="text-center">
                <img src="img/illustration/icon-performance.webp" class="theme-filter" alt="performance" />
                <div class="d-flex flex-column sh-5">
                  <a href="Support.KnowledgeBase.html" class="heading stretched-link">Performance Tweaks</a>
                </div>
              </div>
              <div class="text-muted">Cheesecake chocolate carrot cake pie lollipop lemon drops toffee lollipop.</div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <div class="text-center">
                <img src="img/illustration/icon-configure.webp" class="theme-filter" alt="configure" />
                <div class="d-flex flex-column sh-5">
                  <a href="Support.KnowledgeBase.html" class="heading stretched-link">Advanced Configuration</a>
                </div>
              </div>
              <div class="text-muted">Sweet roll apple pie tiramisu bonbon sugar plum muffin sesame snaps chocolate. Lollipop halvah powder.</div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <div class="text-center">
                <img src="img/illustration/icon-analytics.webp" class="theme-filter" alt="analytics" />
                <div class="d-flex flex-column sh-5">
                  <a href="Support.KnowledgeBase.html" class="heading stretched-link">Server Analytics</a>
                </div>
              </div>
              <div class="text-muted">Cake tart apple pie bear bonbon sugar plum muffin sesame snaps sweet roll gingerbread bonbon sugar.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Guildes End -->

    <div class="row mb-n5">
      <!-- Help Start -->
      <div class="col-12 col-xxl-4 mb-5">
        <h2 class="small-title">Help</h2>
        <div class="card h-100-card">
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <div class="cta-3">Do you need help?</div>
              <div class="mb-3 cta-3 text-primary">Search for documentation!</div>
              <div class="text-muted mb-4">Cheesecake chocolate carrot cake pie cream.</div>
            </div>
            <form>
              <div class="mb-3 filled">
                <i data-cs-icon="help"></i>
                <input class="form-control" placeholder="Keyword" />
              </div>
              <a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
                <i data-cs-icon="chevron-right"></i>
                <span>Search</span>
              </a>
            </form>
          </div>
        </div>
      </div>
      <!-- Help End -->

      <!-- Video Guide Start -->
      <div class="col-12 col-xxl-8 mb-5">
        <h2 class="small-title">Videos</h2>

        <div class="row g-2">
          <div class="col-12 col-lg-6">
            <div class="card">
              <a href="Blog.html" class="row g-0 sh-11">
                <div class="col-auto h-100">
                  <img src="img/video/video-thumbnail-1.webp" alt="alternate text" class="card-img card-img-horizontal sw-11 sw-md-14 theme-filter" />
                  <div class="position-absolute bg-foreground opacity-75 text-primary px-1 py-1 text-extra-small b-2 s-2 rounded-lg">12:00</div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="font-heading">Database Basics</div>
                      <div class="text-small text-muted text-truncate">Icing liquorice oat roll chocolate cake bar marzipan marzipan carrot.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <a href="Blog.html" class="row g-0 sh-11">
                <div class="col-auto h-100">
                  <img src="img/video/video-thumbnail-2.webp" alt="alternate text" class="card-img card-img-horizontal sw-11 sw-md-14 theme-filter" />
                  <div class="position-absolute bg-foreground opacity-75 text-primary px-1 py-1 text-extra-small b-2 s-2 rounded-lg">16:22</div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="font-heading">Shared Storage</div>
                      <div class="text-small text-muted text-truncate">
                        Jujubes cream toffee candy jelly chups jujubes muffin chupa chups carrot cake chupa.
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <a href="Blog.html" class="row g-0 sh-11">
                <div class="col-auto h-100">
                  <img src="img/video/video-thumbnail-3.webp" alt="alternate text" class="card-img card-img-horizontal sw-11 sw-md-14 theme-filter" />
                  <div class="position-absolute bg-foreground opacity-75 text-primary px-1 py-1 text-extra-small b-2 s-2 rounded-lg">10:05</div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="font-heading">Javascript Api</div>
                      <div class="text-small text-muted text-truncate">Candy jelly chups jujubes Cookie cream toffee cream chocolate.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <a href="Blog.html" class="row g-0 sh-11">
                <div class="col-auto h-100">
                  <img src="img/video/video-thumbnail-4.webp" alt="alternate text" class="card-img card-img-horizontal sw-11 sw-md-14 theme-filter" />
                  <div class="position-absolute bg-foreground opacity-75 text-primary px-1 py-1 text-extra-small b-2 s-2 rounded-lg">12:20</div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="font-heading">Frontend Methods</div>
                      <div class="text-small text-muted text-truncate">Jelly chups jujubes chocolate bar pastry oat cake cream.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <a href="Blog.html" class="row g-0 sh-11">
                <div class="col-auto h-100">
                  <img src="img/video/video-thumbnail-5.webp" alt="alternate text" class="card-img card-img-horizontal sw-11 sw-md-14 theme-filter" />
                  <div class="position-absolute bg-foreground opacity-75 text-primary px-1 py-1 text-extra-small b-2 s-2 rounded-lg">24:00</div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="font-heading">Backend Methods</div>
                      <div class="text-small text-muted text-truncate">Cookie cream toffee cream chocolate.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <a href="Blog.html" class="row g-0 sh-11">
                <div class="col-auto h-100">
                  <img src="img/video/video-thumbnail-6.webp" alt="alternate text" class="card-img card-img-horizontal sw-11 sw-md-14 theme-filter" />
                  <div class="position-absolute bg-foreground opacity-75 text-primary px-1 py-1 text-extra-small b-2 s-2 rounded-lg">16:50</div>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                      <div class="font-heading">Data Analysis</div>
                      <div class="text-small text-muted text-truncate">Liquorice bar chocolate bar pastry oat cake cream.</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Video Guide End -->
    </div>
  </div>
  @endsection