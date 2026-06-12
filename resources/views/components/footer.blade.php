<!-- footer begin -->
<footer class="footer-light">
    <div class="container relative z-2">
        <div class="row gx-5">
            <div class="col-lg-4 col-sm-6">
                <div class="footer-logo-container">
                    <img src="{{ setting('logo_dark') ? asset('storage/' . setting('logo_dark')) : asset('assets/images/logo-text-cropped.png') }}" class="footer-logo-text" alt="GREECO Logo">
                </div>
                <div class="spacer-20"></div>
                <p>Viện Nghiên cứu và Phát triển Kinh tế Xanh (GREECO) là đơn vị khoa học công nghệ hàng đầu, chuyên nghiên cứu, tư vấn và chuyển giao các giải pháp phát triển bền vững, kinh tế tuần hoàn và ứng phó biến đổi khí hậu.</p>

                <div class="social-icons mb-sm-30">
                    <a href="{{ setting('facebook_url', 'https://www.facebook.com/greecoofficial?locale=vi_VN') }}"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ setting('twitter_url', '#') }}"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="{{ setting('instagram_url', '#') }}"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ setting('youtube_url', '#') }}"><i class="fa-brands fa-youtube"></i></a>
                    <a href="{{ setting('whatsapp_url', '#') }}"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="widget">
                            <h5>Giới thiệu</h5>
                            <ul>
                                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                                <li><a href="{{ route('services.index') }}">Lĩnh vực hoạt động</a></li>
                                <li><a href="{{ route('projects.index') }}">Dự án nghiên cứu</a></li>
                                <li><a href="{{ route('posts.index') }}">Tin tức</a></li>
                                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="widget">
                            <h5>Lĩnh vực</h5>
                            <ul>
                                <li><a href="{{ route('services.nghien-cuu') }}">Nghiên cứu khoa học</a></li>
                                <li><a href="{{ route('services.dao-tao') }}">Đào tạo & Bồi dưỡng</a></li>
                                <li><a href="{{ route('services.tu-van') }}">Tư vấn môi trường</a></li>
                                <li><a href="{{ route('services.du-an') }}">Dự án tăng trưởng xanh</a></li>
                                <li><a href="{{ route('services.hoi-thao') }}">Hội thảo & Truyền thông</a></li>
                                <li><a href="{{ route('library') }}">Thư viện & Hồ sơ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 order-lg-2 order-sm-1">
                <div class="widget">
                    <div class="fw-bold text-white"><i class="icofont-clock-time me-2 id-color-2"></i>Thời gian làm việc</div>
                    {{ setting('work_hours', 'Thứ 2 - Thứ 7: 08:00 - 17:00') }}

                    <div class="spacer-20"></div>

                    <div class="fw-bold text-white"><i class="icofont-location-pin me-2 id-color-2"></i>Địa chỉ văn phòng</div>
                    {{ setting('address', '150 Đường 38-CL, Phường Cát Lái, TP. HCM') }}

                    <div class="spacer-20"></div>

                    <div class="fw-bold text-white"><i class="icofont-envelope me-2 id-color-2"></i>Liên hệ qua Email</div>
                    {{ setting('email', 'info@greeco.vn') }}

                    <div class="spacer-20"></div>

                    <div class="fw-bold text-white"><i class="icofont-phone me-2 id-color-2"></i>Hotline</div>
                    {{ setting('phone', '09369 96390') }}
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="de-flex">
                        <div class="de-flex-col">
                            &copy; 2026 Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO. Bảo lưu mọi quyền.
                        </div>
                        <ul class="menu-simple">
                            <li><a href="#">Điều khoản sử dụng</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->

