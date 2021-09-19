<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Fdl's blog</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart - v1.4.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <img src="/assets/img/logo.png" alt="">
                <span>Fdl's blog</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto " href="/">Blog</a></li>
                    <li><a class="nav-link scrollto " href="mailto:fifoullfifi@gmail.com">Contact me</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/">Blog</a></li>
                </ol>
                @foreach ($single as $post)
                <h2>{{$post->name}}</h2>
                @endforeach

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    @if(session('success'))
                    <div class="alert alert-primary" role="alert">
                        {{session('success')}}
                    </div>
                    @endif
                    <div class="col-lg-8 entries">
                        @foreach ($single as $post)
                        <article class="entry entry-single">
                            <div class="entry-img">
                                <img src="/{{$post->image}}" alt="" class="img-fluid">
                            </div>
                            <h2 class="entry-title">
                                <a href="{{route('show',['slug'=>$post->slug])}}">{{$post->name}}</a>
                            </h2>
                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{$post->author}}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">{{Carbon\Carbon::parse($post->created_at)->format('M d Y')}}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">{{$post->comments->count()}} Comments</a></li>
                                </ul>
                            </div>
                            <div class="entry-content">
                                {!!Str::substr($post->content, 0, 200);!!}
                            </div>
                            <div class="entry-footer">
                                <ul class="tags">
                                    @foreach ($post->categories as $category)
                                    <li><a href="{{route('home_c',['category'=>$category->slug])}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                        @endforeach
                        <!-- End blog entry -->
                        <div class="blog-author d-flex align-items-center">
                            <img src="/assets/img/blog/blog-author.jpg" class="rounded-circle float-left" alt="">
                            <div>
                                <h4>Fadel Mohamed</h4>
                                <div class="social-links">
                                    <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                                    <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
                                    <a href="https://instagram.com/#"><i class="biu bi-github"></i></a>
                                </div>
                                <p>
                                    Une description de moiUne description de moiUne description de moiUne description de moiUne description de moiUne description de moiUne description de moiUne description de moiUne description de moi
                                </p>
                            </div>
                        </div><!-- End blog author bio -->

                        <div class="blog-comments">
                            @foreach ($single as $post)
                            <h4 class="comments-count">{{$post->comments->count()}} Comments</h4>
                            @foreach ($post->comments as $comment)
                            <div id="comment-2" class="comment">
                                <div class="d-flex">
                                    <div>
                                        <h5><a href="">{{$comment->username}}</a>
                                            <time datetime="2020-01-01">{{Carbon\Carbon::parse($comment->created_at)->format('M d Y')}}</time>
                                            <p>
                                                {{$comment->comment}}
                                            </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- End comment #2-->
                            @endforeach

                            <!-- End comment #3 -->

                            <!-- End comment #4 -->

                            <div class="reply-form">
                                <h4>Leave a Reply</h4>
                                <form action="{{route('newcomment')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input name="username" type="text" required class="form-control" placeholder="Your Name*">
                                        </div>
                                        @foreach ($single as $p)

                                        <input name="post_id" value="{{$p->id}}" type="hidden">
                                        @endforeach
                                    </div>
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>

                                </form>

                            </div>

                        </div><!-- End blog comments -->

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">

                            @include('search')
                            <!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach (App\Models\Category::all() as $category)
                                    <li><a href="{{route('home_c',['category'=>$category->slug])}}">{{$category->name}} <span>({{$category->posts()->count()}})</span></a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent_posts as $r_post)
                                <div class="post-item clearfix">
                                    <img src="/{{$r_post->image}}" alt="">
                                    <h4><a href="{{route('show',['slug'=>$r_post->slug])}}">{{$r_post->name}}</a></h4>
                                    <time datetime="2020-01-01">{{Carbon\Carbon::parse($r_post->created_at)->format('M d Y')}}</time>
                                </div>
                                @endforeach

                            </div><!-- End sidebar recent posts-->


                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Single Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/vendor/purecounter/purecounter.js"></script>
    <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>
