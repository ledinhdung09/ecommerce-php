<?php
session_start();
$is_homepage = false;
require_once('components/header.php');
?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Liên hệ</h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Home</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div data-aos="fade-up" class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Điện thoại</h4>
                    <p>0828.212.825</p>
                </div>
            </div>
            <div data-aos="fade-up" class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Địa chỉ</h4>
                    <p>Thuận Giao, Thuận An, Bình Dương</p>
                </div>
            </div>
            <div data-aos="fade-up" class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Mở cửa</h4>
                    <p>08:00 am to 23:00 pm</p>
                </div>
            </div>
            <div data-aos="fade-up" class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>ledinhdung@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d501001.73858539684!2d106.32131464019183!3d11.182002606451826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174b66a8ef92879%3A0x339fda891c8d1473!2sBinh%20Duong%2C%20Vietnam!5e0!3m2!1sen!2s!4v1720012967512!5m2!1sen!2s"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Bình Dương</h4>
            <ul>
                <li>Điện thoại: 0828.212.825</li>
                <li>Địa chỉ: Thuận Giao, Thuận An, Bình Dương</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Leave Message</h2>
                </div>
            </div>
        </div>
        <form name="contactForm" action="xulycontact.php" method="post" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p>Your name<span>*</span></p>
                    <input type="text" name="name" placeholder="Your name">
                </div>
                <div class="col-lg-6 col-md-6">
                    <p>Your Email<span>*</span></p>
                    <input type="email" name="email" placeholder="Your Email">
                </div>
                <div class="col-lg-12 ">
                    <p>Your message<span>*</span></p>
                    <textarea name="content" placeholder="Your message"></textarea>
                    <button type="submit" name="btnContact" class="site-btn text-center">SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->
<script>
function validateForm() {
    var name = document.forms["contactForm"]["name"].value;
    var email = document.forms["contactForm"]["email"].value;
    var content = document.forms["contactForm"]["content"].value;

    if (name == "") {
        alert("Please enter your name");
        return false;
    }

    if (email == "") {
        alert("Please enter your email");
        return false;
    }

    if (content == "") {
        alert("Please enter your message");
        return false;
    }

    return true;
}
</script>


<?php
require_once('components/footer.php');
?>