<template>
   <div class="body">
		<header id="header" class="header-narrow header-semi-transparent-light"
			data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 1, 'stickySetTop': '1'}">
			<div class="header-body">
				<div class="header-container container">
					<div class="header-row">
						<div class="header-column">
							<div class="header-row">
								<div class="header-logo">
									<img class="logo-default" alt="Porto" width="324" height="212"
										src="img/demos/construction/logo-construction.png">
									<a href="demo-construction.html">
										<img class="logo-small" alt="Porto" width="131" height="48"
											src="img/demos/construction/logo-construction-small.png">
									</a>
								</div>
							</div>
						</div>
						<div class="header-column justify-content-end">
							<div class="header-row">
								<div class="header-nav header-nav-stripe order-2 order-lg-1">
									<div
										class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
										<nav class="collapse">
											<ul class="nav nav-pills" id="mainNav">
												<li>
													<a class="nav-link active" href="demo-construction.html">
														Home
													</a>
												</li>
												<li>
													<a class="nav-link" href="demo-construction-company.html">
														Company
													</a>
												</li>
												<li class="dropdown">
													<a class="nav-link dropdown-toggle"
														href="demo-construction-services.html">
														Services
													</a>
													<ul class="dropdown-menu">
														<li><a class="dropdown-item"
																href="demo-construction-services-detail.html">Pre-Construction</a>
														</li>
														<li><a class="dropdown-item"
																href="demo-construction-services-detail.html">General
																Construction</a></li>
														<li><a class="dropdown-item"
																href="demo-construction-services-detail.html">Plumbing</a>
														</li>
														<li><a class="dropdown-item"
																href="demo-construction-services-detail.html">Painting</a>
														</li>
													</ul>
												</li>
												<li>
													<a class="nav-link" href="demo-construction-projects.html">
														Projects
													</a>
												</li>
												<li>
													<a class="nav-link" href="demo-construction-blog.html">
														Blog
													</a>
												</li>
												<li>
													<a class="nav-link" href="demo-construction-contact.html">
														Contact
													</a>
												</li>
											</ul>
										</nav>
									</div>
									<button class="btn header-btn-collapse-nav" data-toggle="collapse"
										data-target=".header-nav-main nav">
										<i class="fas fa-bars"></i>
									</button>
								</div>
								<div
									class="header-nav-features header-nav-features-no-border d-none d-sm-block order-1 order-lg-2">
									<ul
										class="header-social-icons social-icons d-none d-sm-block social-icons-clean ml-0">
										<li class="social-icons-facebook"><a href="http://www.facebook.com/"
												target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
										</li>
										<li class="social-icons-twitter"><a href="http://www.twitter.com/"
												target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
										<li class="social-icons-linkedin"><a href="http://www.linkedin.com/"
												target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div role="main" class="main">
			<div class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual dots-inside dots-horizontal-center show-dots-hover nav-style-diamond custom-nav-with-transparency nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0"
				data-plugin-options="{'autoplayTimeout': 7000}"
				data-dynamic-height="['700px','700px','700px','550px','500px']" style="height: 700px;">
			<Slider></Slider>
				<div class="owl-nav">
					<button type="button" role="presentation" class="owl-prev"></button>
					<button type="button" role="presentation" class="owl-next"></button>
				</div>
			</div>

			<div class="container">
				<div class="row mt-4 mt-lg-5 mb-4 py-4">
					<div class="col-lg-4">
						<h2 class="mb-0 text-color-dark">Who We Are</h2>
						<p class="lead">Lorem ipsum dolor sit amet.</p>
					</div>
					<div class="col-lg-2 text-center d-none d-lg-block">
						<img src="img/dotted-line-angle.png" class="img-fluid" alt="" />
					</div>
					<div class="col-lg-6">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque
							imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
							pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
						<a class="mt-3" href="demo-construction-company.html">Learn More <i
								class="fas fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>

			<section class="section section-tertiary section-no-border section-custom-construction">
				<div class="container">
					<div class="row pt-4">
						<div class="col">
							<h2 class="mb-0 text-color-dark">Services</h2>
							<p class="lead">Lorem ipsum dolor sit amet.</p>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-lg-6">
							<div class="feature-box feature-box-style-2 custom-feature-box mb-4 appear-animation"
								data-appear-animation="fadeInUp" data-appear-animation-delay="300">
								<div class="feature-box-icon w-auto">
									<img src="img/demos/construction/icons/ground-construction.png" alt=""
										class="img-fluid" width="55" />
								</div>
								<div class="feature-box-info ml-3">
									<h4 class="mb-2">Pre-Construction</h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
										pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
									<a class="mt-3" href="demo-construction-services-detail.html">Learn More <i
											class="fas fa-long-arrow-alt-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feature-box feature-box-style-2 custom-feature-box mb-4 appear-animation"
								data-appear-animation="fadeInUp" data-appear-animation-delay="0">
								<div class="feature-box-icon w-auto">
									<img src="img/demos/construction/icons/construction.png" alt="" class="img-fluid"
										width="55" />
								</div>
								<div class="feature-box-info ml-3">
									<h4 class="mb-2">General Construction</h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
										pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
									<a class="mt-3" href="demo-construction-services-detail.html">Learn More <i
											class="fas fa-long-arrow-alt-right"></i></a>
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-3 mb-4">
						<div class="col-lg-6">
							<div class="feature-box feature-box-style-2 custom-feature-box mb-4 appear-animation"
								data-appear-animation="fadeInUp" data-appear-animation-delay="300">
								<div class="feature-box-icon w-auto">
									<img src="img/demos/construction/icons/painting.png" alt="" class="img-fluid"
										width="55" />
								</div>
								<div class="feature-box-info ml-3">
									<h4 class="mb-2">Painting</h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum
										pellentesque imperdiet.</p>
									<a class="mt-3" href="demo-construction-services-detail.html">Learn More <i
											class="fas fa-long-arrow-alt-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feature-box feature-box-style-2 custom-feature-box mb-4 appear-animation"
								data-appear-animation="fadeInUp" data-appear-animation-delay="0">
								<div class="feature-box-icon w-auto">
									<img src="img/demos/construction/icons/plumbing.png" alt="" class="img-fluid"
										width="55" />
								</div>
								<div class="feature-box-info ml-3">
									<h4 class="mb-2">Plumbing</h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum
										pellentesque imperdiet.</p>
									<a class="mt-3" href="demo-construction-services-detail.html">Learn More <i
											class="fas fa-long-arrow-alt-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="pt-3 pb-4 home-concept-construction">
				<div class="container">
					<div class="row pt-4">
						<div class="col">
							<h2 class="mb-0 text-color-dark">Projects</h2>
							<p class="lead">Lorem ipsum dolor sit amet.</p>

							<div class="diamonds-wrapper lightbox"
								data-plugin-options="{'delegate': '.diamond', 'type': 'image', 'gallery': {'enabled': true}}">
								<ul class="diamonds">
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-1.jpg"
											class="diamond">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-1.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-2.jpg"
											class="diamond">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-2.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-3.jpg"
											class="diamond">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-3.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-4.jpg"
											class="diamond diamond-sm">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-4.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-5.jpg"
											class="diamond">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-5.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-6.jpg"
											class="diamond diamond-sm">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-6.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
									<li>
										<a href="img/demos/construction/gallery/construction-gallery-7.jpg"
											class="diamond diamond-sm">
											<div class="content">
												<img src="img/demos/construction/gallery/construction-gallery-7.jpg"
													class="img-fluid" alt="" />
											</div>
										</a>
									</li>
								</ul>
							</div>

						</div>
					</div>
					<div
						class="row row-diamonds-description justify-content-center justify-content-xl-start text-center text-xl-left">
						<div class="col-md-8 col-lg-6">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum
								pellentesque imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing metus elit.
								Quisque rutrum pellentesque imperdiet.</p>
							<a class="btn btn-outline btn-primary" href="demo-construction-projects.html">View All
								Projects</a>
						</div>
					</div>
				</div>
			</section>

			<section class="section section-background mb-4"
				style="background-image: url(img/demos/construction/testimonials/testimonials-bg.jpg); background-position: 50% 100%; min-height: 540px; background-size: cover;">
				<div class="container">
					<div class="row justify-content-end">
						<div class="col-lg-6">

							<div class="owl-carousel owl-theme nav-bottom rounded-nav mt-4 pt-4 mb-4 pb-4"
								data-plugin-options="{'items': 1, 'loop': false}">
								<div>
									<div class="col">
										<div class="testimonial testimonial-style-2 testimonial-with-quotes mb-0">
											<blockquote>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget
													risus porta, tincidunt turpis at, interdum tortor. Suspendisse
													potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
													Sociis natoque penatibus et magnis dis parturient montes, nascetur
													ridiculus mus. Fusce ante tellus, convallis non consectetur sed,
													pharetra nec ex.</p>
											</blockquote>
											<div class="testimonial-author">
												<p><strong>Ana Smith</strong><span>Porto Magazine</span></p>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div class="col">
										<div class="testimonial testimonial-style-2 testimonial-with-quotes mb-0">
											<blockquote>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget
													risus porta, tincidunt turpis at, interdum tortor. Suspendisse
													potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
												</p>
											</blockquote>
											<div class="testimonial-author">
												<p><strong>Jessica Smith</strong><span>Porto Magazine</span></p>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</section>

			<section class="pt-3 section-custom-construction-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="owl-carousel owl-theme stage-margin rounded-nav"
								data-plugin-options="{'margin': 10, 'loop': true, 'nav': true, 'dots': false, 'stagePadding': 40, 'items': 6, 'autoplay': true, 'autoplayTimeout': 3000}">
								<div>
									<img class="img-fluid" src="img/logos/logo-1.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-2.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-3.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-4.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-5.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-6.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-4.png" alt="">
								</div>
								<div>
									<img class="img-fluid" src="img/logos/logo-2.png" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-center mt-4">
							<hr class="solid mt-0 mb-4">
						</div>
					</div>
					<div class="row pt-4">
						<div class="col">
							<h2 class="mb-0 text-color-dark">Blog</h2>
							<p class="lead mb-2">Lorem ipsum dolor sit amet.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="recent-posts mt-4">
								<a href="demo-construction-blog-detail.html">
									<img class="img-fluid pb-3"
										src="img/demos/construction/blog/blog-construction-1.jpg" alt="Blog">
								</a>
								<article class="post">
									<div class="post-date">
										<span class="day">15</span>
										<span class="month">Jan</span>
									</div>
									<h4 class="pt-2 pb-0 mb-0"><a class="text-color-dark"
											href="demo-construction-blog-detail.html">Lorem ipsum dolor sit amet</a>
									</h4>
									<p>By admin</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula
										est, in consequat libero.</p>
									<a class="mt-3" href="demo-construction-blog-detail.html">Read More <i
											class="fas fa-long-arrow-alt-right position-relative top-1"></i></a>
								</article>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="recent-posts mt-4">
								<a href="demo-construction-blog-detail.html">
									<img class="img-fluid pb-3"
										src="img/demos/construction/blog/blog-construction-2.jpg" alt="Blog">
								</a>
								<article class="post">
									<div class="post-date">
										<span class="day">15</span>
										<span class="month">Jan</span>
									</div>
									<h4 class="pt-2 pb-0 mb-0"><a class="text-color-dark"
											href="demo-construction-blog-detail.html">Lorem ipsum dolor sit amet</a>
									</h4>
									<p>By admin</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula
										est, in consequat libero.</p>
									<a class="mt-3" href="demo-construction-blog-detail.html">Read More <i
											class="fas fa-long-arrow-alt-right position-relative top-1"></i></a>
								</article>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="recent-posts mt-4">
								<a href="demo-construction-blog-detail.html">
									<img class="img-fluid pb-3"
										src="img/demos/construction/blog/blog-construction-3.jpg" alt="Blog">
								</a>
								<article class="post">
									<div class="post-date">
										<span class="day">15</span>
										<span class="month">Jan</span>
									</div>
									<h4 class="pt-2 pb-0 mb-0"><a class="text-color-dark"
											href="demo-construction-blog-detail.html">Lorem ipsum dolor sit amet</a>
									</h4>
									<p>By admin</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula
										est, in consequat libero.</p>
									<a class="mt-3" href="demo-construction-blog-detail.html">Read More <i
											class="fas fa-long-arrow-alt-right position-relative top-1"></i></a>
								</article>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<footer id="footer">
			<div class="container">
				<div class="row pt-4 pb-5 text-center text-md-left">
					<div class="col-md-3">
						<a href="demo-construction.html">
							<img alt="Porto" class="img-fluid logo" width="110"
								src="img/demos/construction/logo-construction-small.png">
						</a>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-lg-6 mb-2">
								<h4>Navigation</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-6 mb-0">
								<ul class="list list-footer-nav">
									<li>
										<a href="demo-construction.html">
											Home
										</a>
									</li>
									<li>
										<a href="demo-construction-company.html">
											Company
										</a>
									</li>
									<li>
										<a href="demo-construction-services.html">
											Services
										</a>
									</li>
								</ul>
							</div>
							<div class="col-6">
								<ul class="list list-footer-nav">
									<li>
										<a href="demo-construction-projects.html">
											Projects
										</a>
									</li>
									<li>
										<a href="demo-construction-blog.html">
											Blog
										</a>
									</li>
									<li>
										<a href="demo-construction-contact.html">
											Contact
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<h4>Newsletter</h4>

						<div class="newsletter">

							<div class="alert alert-success d-none" id="newsletterSuccess">
								<strong>Success!</strong> You've been added to our email list.
							</div>

							<div class="alert alert-danger d-none" id="newsletterError"></div>

							<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
								<div class="input-group">
									<input class="form-control form-control-sm" placeholder="Email Address"
										name="newsletterEmail" id="newsletterEmail" type="text">
									<span class="input-group-append">
										<button class="btn btn-light" type="submit"><i
												class="icon-paper-plane icons"></i></button>
									</span>
								</div>
							</form>

						</div>

						<p><i class="fas fa-phone"></i> (123) 456-789 <i class="far fa-envelope ml-2"></i> <a
								href="mailto:mail@example.com">mail@example.com</a></p>

					</div>
				</div>

				<div class="footer-copyright">
					<div class="row">
						<div class="col-lg-12 text-center">
							<p>© Copyright 2021. All Rights Reserved.</p>
						</div>
					</div>
				</div>

			</div>
		</footer>

	</div>
</template>

<script>
import Slider from './components/Slider'
    export default {
		components:{
			Slider
		},
        beforeCreate() {
    var jQueryAppearA = document.createElement("script");
    jQueryAppearA.setAttribute("src", "frontend/vendor/jquery/jquery.min.js");
    document.body.appendChild(jQueryAppearA);

    var jQueryAppearB = document.createElement("script");
    jQueryAppearB.setAttribute(
      "src",
      "frontend/vendor/jquery.appear/jquery.appear.min.js"
    );
    document.body.appendChild(jQueryAppearB);

    var jQueryAppearC = document.createElement("script");
    jQueryAppearC.setAttribute(
      "src",
      "frontend/vendor/jquery.easing/jquery.easing.min.js"
    );
    document.body.appendChild(jQueryAppearC);

    var jQueryAppearD = document.createElement("script");
    jQueryAppearD.setAttribute(
      "src",
      "frontend/vendor/jquery.cookie/jquery.cookie.min.js"
    );
    document.body.appendChild(jQueryAppearD);

    var jQueryAppearE = document.createElement("script");
    jQueryAppearE.setAttribute("src", "frontend/vendor/popper/umd/popper.min.js");
    document.body.appendChild(jQueryAppearE);

    var jQueryAppearF = document.createElement("script");
    jQueryAppearF.setAttribute("src", "frontend/vendor/bootstrap/js/bootstrap.min.js");
    document.body.appendChild(jQueryAppearF);

    var jQueryAppearG = document.createElement("script");
    jQueryAppearG.setAttribute(
      "src",
      "frontend/vendor/jquery.validation/jquery.validate.min.js"
    );
    document.body.appendChild(jQueryAppearG);

    var jQueryAppearH = document.createElement("script");
    jQueryAppearH.setAttribute(
      "src",
      "frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"
    );
    document.body.appendChild(jQueryAppearH);

    var jQueryAppearI = document.createElement("script");
    jQueryAppearI.setAttribute("src", "frontend/vendor/jquery.gmap/jquery.gmap.min.js");
    document.body.appendChild(jQueryAppearI);

    var jQueryAppearK = document.createElement("script");
    jQueryAppearK.setAttribute("src", "frontend/vendor/lazysizes/lazysizes.min.js");
    document.body.appendChild(jQueryAppearK);

    var jQueryAppearL = document.createElement("script");
    jQueryAppearL.setAttribute("src", "frontend/vendor/isotope/jquery.isotope.min.js");
    document.body.appendChild(jQueryAppearL);

    var jQueryAppearM = document.createElement("script");
    jQueryAppearM.setAttribute("src", "frontend/vendor/owl.carousel/owl.carousel.min.js");
    document.body.appendChild(jQueryAppearM);

    var jQueryAppearN = document.createElement("script");
    jQueryAppearN.setAttribute(
      "src",
      "frontend/vendor/magnific-popup/jquery.magnific-popup.min.js"
    );
    document.body.appendChild(jQueryAppearN);

    var jQueryAppearO = document.createElement("script");
    jQueryAppearO.setAttribute("src", "frontend/vendor/vide/jquery.vide.min.js");
    document.body.appendChild(jQueryAppearO);

    var jQueryAppearP = document.createElement("script");
    jQueryAppearP.setAttribute("src", "frontend/vendor/vivus/vivus.min.js");
    document.body.appendChild(jQueryAppearP);

    var jQueryAppearR = document.createElement("script");
    jQueryAppearR.setAttribute("src", "frontend/js/theme.js");
    document.body.appendChild(jQueryAppearR);

    var jQueryAppearY = document.createElement("script");
    jQueryAppearY.setAttribute("src", "frontend/js/demos/demo-construction.js");
    document.body.appendChild(jQueryAppearY);

     var jQueryAppearS = document.createElement("script");
    jQueryAppearS.setAttribute("src", "frontend/js/views/view.contact.js");
    document.body.appendChild(jQueryAppearS);

    var jQueryAppearT = document.createElement("script");
    jQueryAppearT.setAttribute("src", "frontend/js/custom.js");
    document.body.appendChild(jQueryAppearT);

    /*     var jQueryAppearU = document.createElement("script");
    jQueryAppearU.setAttribute("src", "frontend/js/theme.init.js");
    document.body.appendChild(jQueryAppearU); */

    var jQueryAppearV = document.createElement("script");
    jQueryAppearV.setAttribute("src", "frontend/vendor/modernizr/modernizr.min.js");
    document.head.appendChild(jQueryAppearV);
  },
    }
</script>

<style lang="scss" scoped>

</style>