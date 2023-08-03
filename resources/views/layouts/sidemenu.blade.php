<?php $settings = \App\Http\Controllers\AdminHomeController::getSetting(); ?>
<div style="background:#ff2a2a !important;" id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">
        <!-- Logo Start -->
        <div class="logo position-relative">
            <a href="{{ route('dashboard') }}">
                <!-- Logo can be added directly -->
                <img src="{{ asset('public/img/logo/') }}/{{ $settings->app_logo }}" alt="logo" />

                <!-- Or added via css to provide different ones for different color themes -->

            </a>
        </div>
        <!-- Logo End -->

        <!-- User Menu Start -->
        <div class="user-container d-flex">
            <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img class="profile" src="{{ asset('public/img/') }}/profile/profile-9.webp" />
                <div class="name">Admin</div>
            </a>
            <div class="dropdown-menu dropdown-menu-end user-menu wide">


                <div class="row mb-1 ms-0 me-0">


                    <div class="col-6 pe-1 ps-1">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('settings') }}">
                                    <i data-cs-icon="gear" class="me-2" data-cs-size="17"></i>
                                    <span class="align-middle">Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i data-cs-icon="logout" class="me-2" data-cs-size="17"></i>
                                    <span class="align-middle">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Menu End -->

        <!-- Icons Menu Start -->
        <ul class="list-unstyled list-inline text-center menu-icons">
            <li class="list-inline-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
                    <i data-cs-icon="search" data-cs-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" id="pinButton" class="pin-button">
                    <i data-cs-icon="lock-on" class="unpin" data-cs-size="18"></i>
                    <i data-cs-icon="lock-off" class="pin" data-cs-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" id="colorButton">
                    <i data-cs-icon="light-on" class="light" data-cs-size="18"></i>
                    <i data-cs-icon="light-off" class="dark" data-cs-size="18"></i>
                </a>
            </li>

        </ul>
        <!-- Icons Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">

        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
            <!-- Menu Button Start -->
            <a href="#" id="mobileMenuButton" class="menu-button">
                <i data-cs-icon="menu"></i>
            </a>
            <!-- Menu Button End -->
        </div>
        <!-- Mobile Buttons End -->
    </div>
    <div class="nav-shadow"></div>
</div>
<main>
    <div class="container">
        <div class="row">
            <!-- Menu Start -->
            <div class="col-auto d-none d-lg-flex">
                <ul class="sw-25 side-menu mb-0 primary" id="menuSide">
                    <li>
                        <!--               <a href="#" data-bs-target="#dashboard">
                <i data-cs-icon="grid-1" class="icon" data-cs-size="18"></i>
                <span class="label">Dashboard</span>
              </a> -->
                        <ul>
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i data-cs-icon="navigate-diagonal" class="icon" data-cs-size="18"></i>
                                    <span class="label">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <!--               <a href="#" data-bs-target="#services">
                <i data-cs-icon="grid-1" class="icon" data-cs-size="18"></i>
                <span class="label">Appointments</span>
              </a> -->
                        <ul>
                            <li>
                                <a href="{{ route('appointments') }}">
                                    <i data-cs-icon="database" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Appointments</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <!--               <a href="#" data-bs-target="#services">
                <i data-cs-icon="grid-1" class="icon" data-cs-size="18"></i>
                <span class="label">Tickets</span>
              </a> -->
                        <ul>
                            <li>
                                <a href="{{ route('tickets') }}">
                                    <i data-cs-icon="database" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Tickets</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <!--               <a href="#" data-bs-target="#services">
                <i data-cs-icon="grid-1" class="icon" data-cs-size="18"></i>
                <span class="label">Promotion</span>
              </a> -->
                        <ul>
                            <li>
                                <a href="{{ route('promotion') }}">
                                    <i data-cs-icon="database" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Promotion</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <!--               <a href="#" data-bs-target="#account">
                <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                <span class="label">Admin Section</span>
              </a> -->
                        <ul>
                            <li>
                                <a href="{{ route('users') }}">
                                    <i data-cs-icon="gear" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Manage Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sections') }}">
                                    <i data-cs-icon="gear" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Manage Sections</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('hairdresser') }}">
                                    <i data-cs-icon="gear" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Manage Hairdressers</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('settings') }}">
                                    <i data-cs-icon="credit-card" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('roles') }}">
                                    <i data-cs-icon="credit-card" class="icon d-none" data-cs-size="18"></i>
                                    <span class="label">Manage Roles</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <!--               <a href="#" data-bs-target="#support">
                <i data-cs-icon="help" class="icon" data-cs-size="18"></i>
                <span class="label">Reports</span>
              </a> -->
                        <ul <li>
                            <a href="{{ route('report.get') }}">
                                <i data-cs-icon="file-empty" class="icon d-none" data-cs-size="18"></i>
                                <span class="label">Reports</span>
                            </a>
                    </li>

                </ul>
                </li>
                </ul>
            </div>
            <!-- Menu End -->

            <!-- Page Content Start -->
