<section class="ftco-section p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Liên hệ</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters mb-5">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Liên hệ với chúng tôi</h3>
                                <div id="form-message-warning" class="mb-4"></div>
                                <div id="form-message-success" class="mb-4">
                                    Tin của bạn đã được gửi. Cảm ơn!
                                </div>
                                <?

                                use PHPMailer\PHPMailer\PHPMailer;

                                require_once 'PHPMailer/src/Exception.php';
                                require_once 'PHPMailer/src/PHPMailer.php';
                                require_once 'PHPMailer/src/SMTP.php';

                                if (isset($_POST['send'])) {
                                    $mail = new PHPMailer(true);

                                    $mail->SMTPDebug = 0;
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'lephuocminh12321@gmail.com';
                                    $mail->Password = 'pvlqozspjhltmjpn';
                                    $mail->SMTPSecure = 'ssl';
                                    $mail->Port = 465;

                                    $mail->setFrom('lephuocminh12321@gmail.com');
                                    $mail->addAddress($_POST['email'], $_POST['name']);
                                    $mail->isHTML(true);
                                    $mail->Subject = $_POST['subject'];
                                    $mail->Body = $_POST['message'];

                                    $mail->send();

                                    echo "<script> alert('Gửi thành công. Cảm ơn bạn đã phản hồi')
                                            document.locatiion.href = 'contact.php'
                                            </script>";
                                }
                                ?>
                                <form method="POST" id="" name="contactForm" class="contactForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="name">Tên</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                       placeholder="Tên">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="subject">Chủ đề</label>
                                                <input type="text" class="form-control" name="subject" id="subject"
                                                       placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="#">Nội dung</label>
                                                <textarea name="message" class="form-control" id="message" cols="30"
                                                          rows="4" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-info" name="send">Gửi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-stretch">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15717.731494909474!2d105.74664560845945!3d9.981055891581562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08906415c355f%3A0x416815a99ebd841e!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1701772249485!5m2!1svi!2s"
                                    width="600" height="569" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <div class="row" style="padding: 20px; border: 1px solid #F8694A;
">
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text">
                                    <p><span>Địa chỉ:</span>Hưng Lợi, Ninh Kiều, Cần Thơ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>Số điện thoại:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email:</span> <a href="">eshop@yoursite.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="text">
                                    <p><span>Website</span> <a href="#">Facebook.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

