<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title-->
    @if($synthetics?->address)
        <title>{{ $synthetics->address }}</title>
    @else
        <title>Homepage</title>
    @endif
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('client/images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->

    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/boostrap.css') }}">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/slick-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<div class="page" id="page-change-bg-color">
    <div class="loading-page">
        <div class="fancy-spinner">
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="dot"></div>
        </div>
    </div>
    <!-- Page header-->
    <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                 data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static"
                 data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static"
                 data-lg-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="5px"
                 data-lg-stick-up-offset="5px" data-md-stick-up="true" data-lg-stick-up="true">
                <div class="rd-navbar-main-outer">
                    <div class="rd-navbar-main">
                        <!-- RD Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <div class="rd-navbar-brand">
                                <a class="brand-header d-flex justify-content-center" href="index.html">
                                    @if($synthetics?->logo)
                                        <img class="logo_custom" src="{{url('/')}}/storage/{{ $synthetics->logo}}">
                                        <img class="logo_custom logo-custom-goc"
                                             src="{{ asset('client/images/logo white.png') }}"
                                    @endif
                                </a>
                            </div>
                        </div>
                        <!-- RD Navbar Nav-->
                        <div class="rd-navbar-nav-wrap">
                            <div class="rd-navbar-element">
                                <ul class="list-icons list-inline-sm" style="position: relative;">
                                    <li>
                                        <a class="icon icon-sm  icon-style-camera" href="#">
                                            <img src="{{ asset('client/images/icon%20face.png') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a class="icon icon-sm  icon-style-camera" href="#">
                                            <img src="{{ asset('client/images/icon%20youtube.png') }}">
                                        </a>
                                    </li>
                                    <li class="mr-5" style="border: none !important">
                                        <a class="icon icon-sm  icon-style-camera" href="#">
                                            <img src="{{ asset('client/images/tiktok.png') }}">
                                        </a>
                                    </li>
                                    @if($synthetics?->link_reservations)
                                        <div class="image-order-icon ml-2">
                                            <img src="{{ asset('client/images/booking-20240118033011-wrvom.png') }}">
                                            <a href="{{ $synthetics->link_reservations  }}" class="section-btn">Đặt
                                                vé</a>
                                            <div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section id="home" class="slider">
        <div class="row mx-0 ">
            <div id="carouselExampleControlsNoTouching" class=" carousel slide w-100">
                <ol class="carousel-indicators">
                    @php
                        $minKeyWeb = null;
                        foreach($banners as $key => $banner) {
                            if (!$banner->is_mobile) {
                                $minKeyWeb = is_null($minKeyWeb) ? $key : min($minKeyWeb, $key);
                            }
                        }
                    @endphp
                    @if(count($banners) > 0)
                        @foreach($banners as $key => $banner)
                            @if(!$banner->is_mobile)
                                <li data-target="#carouselExampleControlsNoTouching" data-slide-to="{{ $key }}"
                                    class="{{ $key == $minKeyWeb ? 'active' : '' }}"></li>
                            @endif
                        @endforeach
                    @endif
                </ol>
                <div class="carousel-inner">
                    @if(count($banners) > 0)
                        @foreach($banners as $key => $banner)
                            @if(!$banner->is_mobile)
                                <div class="lazyload carousel-item {{ $key == $minKeyWeb ? 'active' : '' }}">
                                    <img src="{{ url('/') }}/storage/{{ $banner->image }}"
                                         class="d-block w-100 owl-carousel_img_banner" alt="...">
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <button style="z-index: 1000" class="carousel-control-prev" type="button"
                        data-target="#carouselExampleControlsNoTouching" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button style="z-index: 1000" class="carousel-control-next" type="button"
                        data-target="#carouselExampleControlsNoTouching" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
            <!-- /* Slider mobile */ -->
            <div id="carouselExampleControlsNoTouchingMobile" class="carousel slide w-100">
                <ol class="carousel-indicators">
                    @php
                        $minKey = null;
                        foreach($banners as $key => $banner) {
                            if ($banner->is_mobile) {
                                $minKey = is_null($minKey) ? $key : min($minKey, $key);
                            }
                        }
                    @endphp
                    @if(count($banners) > 0)
                        @foreach($banners as $key => $banner)
                            @if($banner->is_mobile)
                                <li data-target="#carouselExampleControlsNoTouchingMobile" data-slide-to="{{ $key }}"
                                    class="{{ $key == $minKey ? 'active' : '' }}"></li>
                            @endif
                        @endforeach
                    @endif
                </ol>
                <div class="carousel-inner">
                    @if(count($banners) > 0)
                        @foreach($banners as $key => $banner)
                            @if($banner->is_mobile)
                                <div class="carousel-item {{ $key == $minKey ? 'active' : '' }}">
                                    <img src="{{ url('/') }}/storage/{{ $banner->image }}"
                                         class="d-block w-100 owl-carousel_img_banner"
                                         alt="...">
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </section>

    <!-- My Best Photos -->
    <section class="section section-md  text-center thumb-ruby__desc_slide_check_upcomming">
        <div class="shell-fluid">
            <p class="heading-1">SẮP DIỄN RA</p>
            <div class="container">
                <div class="slider-demo-demo mx-5 pt-2">
                    @if(count($sapiens) > 0)
                        @foreach($sapiens as $row)
                            <div class="item thumb-ruby__sub_slide_upcoming img-shadow-1"
                                 data-value="{{ $row->title  }}" data-title="{{ $row?->big_title }}"
                                 data-desc="{{ $row?->great_description }}">
                                <img class="lazyload thumb-ruby__image_slide cursor-pointer "
                                     src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                     width="444"
                                     height="683"/>
                                <div class="d-flex align-items-start flex-column mt-2 pb-2 px-1">
                                    <span
                                        class="thumb-ruby__title_slide_upcoming text-css-dark-light">{{ $row->title  }}</span>
                                    <div
                                        class="d-flex justify-content-between thumb-ruby__desc_slide_upcoming mt-1 w-100 ">
                                        <div class="mr-2 d-flex cursor-pointer align-items-center">
                                            <img src="{{ asset('client/images/local.png') }}" style="height: 15px;">
                                            <span
                                                class="thumb-ruby__title_slide_upcoming_location text-css-dark-light ml-1">{{ $row->location  }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('client/images/calender.png') }}" style="height: 15px;">
                                            <span
                                                class="thumb-ruby__title_slide_upcoming_location text-css-dark-light ml-1">{{ $row->time  }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="container mt-4 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center justify-content-center select-upcoming">
                    @if(count($sapiens) > 0)
                        <span class="select-upcoming-title text-css-dark-light">{{  $sapiens[0]->big_title }}</span>
                        <span class="select-upcoming-content mt-3 text-css-dark-light">
                                {{ $sapiens[0]->great_description }}
                            </span>
                    @endif
                </div>

            </div>
        </div>
    </section>
    @if(count($menus) > 0)
        <section class="section section-md  text-center">
            <div class="shell-fluid">
                <p class="heading-1">THỰC ĐƠN</p>
                <div class="row mx-0">
                    @foreach($menus as $row)
                        @if($row->turn_off === 1)
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 pl-0 pr-0 thumb-ruby__box_main">
                                <img class="lazyload thumb-ruby__image_main" src="{{url('/')}}/storage/{{ $row->image}}"
                                     alt="" width="444" height="683"/>
                                <div class="thumb-ruby__desc_main thumb-ruby__desc text-left">
                                    <span class="thumb-ruby__desc_main_title">{{ $row->title }}</span>
                                    <span class="thumb-ruby__desc_desc_main">{{ $row->description }}</span>
                                    <!-- <a href="{{ $row->link  }}" class="thumb-ruby__desc_main_button">Order</a> -->
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 row pl-0 pr-0 mx-0" style="margin: 0">
                        @foreach($menus as $row)
                            @if($row->turn_off === 0)
                                @if($row->numerical_order === 1)
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  pl-0 pr-0 mx-0 row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-6 pl-0 pr-0 col-sm-6-other">
                                            <img class="lazyload thumb-ruby__image_extra"
                                                 src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                                 width="440"
                                                 height="327"/>
                                        </div>
                                        <div
                                            class=" col-xs-6 col-sm-6 col-md-6 col-lg-6 col-6 pl-0 pr-0 col-sm-6-other">
                                            <div class="thumb-ruby__desc_extra">
                                                <div class="thumb-ruby__desc_extra_box">
                                                    <span
                                                        class="thumb-ruby__desc_extra_title text-css-dark-light">{{ $row->title  }}</span>
                                                    <span
                                                        class="thumb-ruby__desc_desc_extra text-css-dark-light">{{ $row->description  }}</span>
                                                    <!-- <a href="{{ $row->link  }}"
                                                   class="thumb-ruby__desc_extra_button cursor-pointer">Order</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($row->numerical_order === 2)
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  pl-0 pr-0 mx-0 row">
                                        <div
                                            class=" col-xs-6 col-sm-6 col-md-6 col-lg-6 col-6 pl-0 pr-0 col-sm-6-other">
                                            <div class="thumb-ruby__desc_extra">
                                                <div class="thumb-ruby__desc_extra_box">
                                                    <div class="thumb-ruby__desc_extra_box">
                                                        <span
                                                            class="thumb-ruby__desc_extra_title text-css-dark-light">{{ $row->title  }}</span>
                                                        <span
                                                            class="thumb-ruby__desc_desc_extra text-css-dark-light">{{ $row->description  }}</span>
                                                        <!-- <a href="{{ $row->link  }}" class="thumb-ruby__desc_extra_button cursor-pointer">Order</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-6 pl-0 pr-0 col-sm-6-other">
                                            <img class="lazyload thumb-ruby__image_extra"
                                                 src="{{url('/')}}/storage/{{ $row->image}}"
                                                 alt=""
                                                 width="440" height="327"/>
                                        </div>
                                    </div>
                                @elseif($row->numerical_order === 3)
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  pl-0 pr-0 mx-0 row">
                                        <div
                                            class="col-xs-6 col-sm-6 col-md-6 col-lg-6  pl-0 pr-0 col-6 col-sm-6-other">
                                            <img class="thumb-ruby__image_extra"
                                                 src="{{url('/')}}/storage/{{ $row->image}}"
                                                 alt=""
                                                 width="440" height="327"/>
                                        </div>
                                        <div
                                            class=" col-xs-6 col-sm-6 col-md-6 col-lg-6  pl-0 pr-0 col-6 col-sm-6-other">
                                            <div class="thumb-ruby__desc_extra">
                                                <div class="thumb-ruby__desc_extra_box">
                                                    <span
                                                        class="thumb-ruby__desc_extra_title text-css-dark-light">{{ $row->title  }}</span>
                                                    <span
                                                        class="thumb-ruby__desc_desc_extra text-css-dark-light">{{ $row->description  }}</span>
                                                    <!-- <a href="{{ $row->link  }}"
                                                   class="thumb-ruby__desc_extra_button cursor-pointer">Order</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(count($utilities) > 0)
        <section class="section section-md  text-center">
            <div class="shell-fluid thumb-ruby__desc_slide_check">
                <p class="heading-1">TIỆN TÍCH</p>
                <div class="container  px-5">
                    <div class=" mx-5 slider-demo">
                        @if(count($utilities) > 0)
                            @foreach($utilities as $row)
                                <div class="item">
                                    <img class="lazyload thumb-ruby__image_slide"
                                         src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                         width="444" height="683"/>
                                    <div class="thumb-ruby__desc_slide text-left">
                                        <span class="thumb-ruby__desc_slide_title">{{ $row->title  }}</span>
                                        <span class="thumb-ruby__desc_slide_main">{{ $row->description  }}</span>
                                        <!-- Global Mailform Output
//                                  <span class="thumb-ruby__desc_slide_button">
//                                     <a href="{{ $row->link  }}">Liên hệ →</a>
//                                </span>
-->
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($collects) > 0)
        <section class="section section-md  text-center">
            <div class="shell-fluid">
                <p class="heading-1">BỘ SƯU TẬP</p>
                <div class="row mx-0">
                    @foreach($collects as $row)
                        @if($row->location === 1)
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 isotope-item pl-0 pr-0 item-none">
                                <a class="thumb-ruby thumb-mixed_height-3 thumb-mixed_md"
                                   href="{{ $row->link  }}" data-lightgallery="item">
                                    <img class="lazyload thumb-ruby__image" src="{{url('/')}}/storage/{{ $row->image}}"
                                         alt=""
                                         width="444"
                                         height="683"/>
                                </a>
                            </div>
                        @endif
                    @endforeach

                    <div class="col-xs-12 col-sm-12 col-lg-8 col-md-12 row pl-0 pr-0 col-lg-test" style="margin: 0">
                        @foreach($collects as $row)
                            @if($row->location === 2)
                                <div
                                    class="col-xs-3 col-sm-3 col-md-3 col-lg-3 isotope-item pl-0 pr-0 col-3 col-md-3-other">
                                    <a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md"
                                       href="{{ $row->link  }}" data-lightgallery="item">
                                        <img class="lazyload thumb-ruby__image"
                                             src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                             width="440"
                                             height="327"/>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        @foreach($collects as $row)
                            @if($row->location === 4)
                                <div
                                    class="col-xs-6 col-sm-6 col-md-6 col-lg-6 isotope-item pl-0 pr-0 col-6 col-sm-6-other">
                                    <a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md"
                                       href="{{ $row->link  }}" data-lightgallery="item">
                                        <img class="lazyload thumb-ruby__image"
                                             src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                             width="440"
                                             height="327"/>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                        @foreach($collects as $row)
                            @if($row->location === 7)
                                <div
                                    class="col-xs-3 col-sm-3 col-md-3 col-lg-3 isotope-item pl-0 col-3 pr-0 col-md-3-other">
                                    <a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md"
                                       href="{{ $row->link  }}" data-lightgallery="item">
                                        <img class="lazyload thumb-ruby__image"
                                             src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                             width="440"
                                             height="327"/>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        @foreach($collects as $row)
                            @if(in_array($row->location, [6,5,3,8]))
                                <div
                                    class="col-xs-3 col-sm-3 col-md-3 col-lg-3 isotope-item pl-0 col-3 pr-0 col-md-3-other">
                                    <a class="thumb-ruby thumb-mixed_height-2 thumb-mixed_md"
                                       href="{{ $row->link  }}" data-lightgallery="item">
                                        <img class="lazyload thumb-ruby__image"
                                             src="{{url('/')}}/storage/{{ $row->image}}" alt=""
                                        >
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @foreach($collects as $row)
                        @if($row->location === 9)
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 isotope-item pl-0 col-3 pr-0 item-none">
                                <a class="thumb-ruby thumb-mixed_height-3 thumb-mixed_md"
                                   href="{{ $row->link  }}" data-lightgallery="item">
                                    <img
                                        class="lazyload thumb-ruby__image" src="{{url('/')}}/storage/{{ $row->image}}"
                                        alt=""
                                    >
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Page Footer-->
    <footer class="footer-centered bg-gray-darker mt-2">
        <div class="shell ">
            <div class="row footer-end my-3" style="border-top: none">
                <div class="container d-flex justify-content-center  align-items-center">
                    <div class="d-flex w-70 justify-content-between align-items-end mt-1">
                        <div class="d-flex justify-content-center mt-2">
                            <img class="logo-footer" src="{{ asset('client/images/Vector Smart Object.png') }}" alt=""
                                 width="237" height="35"/>
                            <div class="d-flex flex-column ml-4 justify-content-center">
                                <div class="footer-info d-flex align-items-center">
                                    <div style="width: 30px">
                                        <i class="fa-solid fa-phone" style="color: #3399cc"></i>
                                    </div>
                                    @if($synthetics?->hottline)
                                        <span class="footer-info-text-label">Hotline: <span
                                                class="footer-info-text-info">{{  $synthetics->hottline  }}</span>
                                                     @endif
                                            @if($synthetics?->switchboard)
                                                <span class="footer-info-text-label">Tổng đài: <span
                                                        class="footer-info-text-info">{{  $synthetics->switchboard  }}</span></span>
                                            @endif
                                            @if($synthetics?->email)
                                                <span class="footer-info-text-label">Email: <span
                                                        class="footer-info-text-info">{{  $synthetics->email  }}</span></span>
                                    @endif
                                </div>
                                <div class=" d-flex align-items-center">
                                    <div style="width: 30px">
                                        <img src="{{ asset('client/images/local.png') }}" style="height: 15px">
                                    </div>
                                    @if($synthetics?->address)
                                        <span class="footer-info-text-label">{{ $synthetics->address  }}</span>
                                    @endif
                                </div>
                                <div class=" d-flex align-items-center">
                                    <div style="width: 30px">
                                        <img src="{{ asset('client/images/calender.png') }}" style="height: 15px">
                                    </div>
                                    @if($synthetics?->operating_time)
                                        <span class="footer-info-text-label">{{ $synthetics->operating_time }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <ul class="list-icons list-inline-sm-footer icon_footer_end  align-items-center pt-0 is-display-flex-footer">
                            @if($synthetics?->link_youtobe)
                                <li><a class="icon icon-sm icon-sm-end  icon-style-camera"
                                       href="{{ $synthetics->link_youtobe  }}">
                                        <img src="{{ asset('client/images/icon%20youtube.png')  }}"
                                             style="height: 15px;">
                                    </a></li>
                            @endif
                            @if($synthetics?->link_tiktok)
                                <li><a class="icon icon-sm icon-sm-end icon-style-camera"
                                       href="{{ $synthetics->link_tiktok  }}">
                                        <img src="{{ asset('client/images/icon%20face.png') }}" style="height: 15px;">
                                    </a>
                                </li>
                            @endif
                            @if($synthetics?->link_facebook)
                                <li><a class="icon icon-sm icon-sm-end icon-style-camera"
                                       href="{{ $synthetics->link_facebook  }}">
                                        <img src="{{ asset('client/images/tiktok.png') }}" style="height: 15px;">
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row footer-end mt-3 footer-end-end" >
                <div class="container d-flex justify-content-center  align-items-center">
                    <div class="d-flex w-70 justify-content-between  align-items-center mb-3 mt-1" style="border-top: 0.1px #1f97dc solid">
                        @if($synthetics?->address)
                            <span class="mt-2">{{ $synthetics->address  }}</span>
                        @endif
                        <ul class="list-icons list-inline-sm-footer icon_footer_end align-items-center pt-0 is-display-none-footer">
                            @if($synthetics?->link_youtobe)
                                <li><a class="icon icon-sm icon-sm-end  icon-style-camera"
                                       href="{{ $synthetics->link_youtobe  }}">
                                        <img src="{{ asset('client/images/icon%20youtube.png')  }}"
                                             style="height: 15px;">
                                    </a></li>
                            @endif
                            @if($synthetics?->link_tiktok)
                                <li><a class="icon icon-sm icon-sm-end icon-style-camera"
                                       href="{{ $synthetics->link_tiktok  }}">
                                        <img src="{{ asset('client/images/icon%20face.png') }}" style="height: 15px;">
                                    </a>
                                </li>
                            @endif
                            @if($synthetics?->link_facebook)
                                <li><a class="icon icon-sm icon-sm-end icon-style-camera"
                                       href="{{ $synthetics->link_facebook  }}">
                                        <img src="{{ asset('client/images/tiktok.png') }}" style="height: 15px;">
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <section id="color-panel" class="close-color-panel">
        <a class="panel-button gray2" data-toggle="tooltip" data-placement="top" title="Chọn chế độ">
            <img src="{{asset('client/images/setting_icon.jpg')}}" alt="" style="height:100%">
        </a>
        <!-- Colors -->
        <div class="segment">
            <h4 class="gray2 normal no-padding">Chọn màu</h4>
            <a id="color-panel-light" class="switcher light-bg" data-toggle="tooltip" data-placement="top"
               title="Sáng"></a>
            <a id="color-panel-dark" class="switcher dark-bg" data-toggle="tooltip" data-placement="top"
               title="Tối"></a>
        </div>
    </section>
</div>
<!-- Global Mailform Output-->
<!-- Javascript-->
<script src="{{ asset('client/js/core.min.js')  }}"></script>
<script type="text/javascript" src="{{ asset('client/js/slick.min.js')  }} "></script>
<script src="{{ asset('client/js/script.js')  }}"></script>
<script src="{{ asset('client/js/popper.min.js')  }}"></script>
<script src="{{ asset('client/js/bootstrap.min.js')  }}"></script>

<!-- coded by Himic-->
</body>
</html>
