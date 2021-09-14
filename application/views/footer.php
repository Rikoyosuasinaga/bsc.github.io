<footer id="footer">
        <div class="footer-top">
            <div class="container">
                <hr />
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-info">
                        <img src="<?= base_url() ?>logo/<?= mainweb('logo') ?>" alt=""
                            class="img-fluid jb-image">
                    </div>
                    <div class="col-lg-2 col-md-6-2 footer-links">
                        <h4>Barcode WhatsApp</h4>
                        <ul>
                            <img src="<?= base_url() ?>foto/wa.link_vk4r94.png" alt="" class="img-fluid line">
                        </ul>
                    </div>
                    <!--<div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#"> <strong>Link</strong></a></li>
                            <li><a href="#"> <strong>Link</strong></a></li>
                            <li><a href="#"> <strong>Link</strong></a></li>
                            <li><a href="#"> <strong>Link</strong></a></li>
                            <li><a href="#"> <strong>Link</strong></a></li>
                            <li><a href="#"> <strong>Link</strong></a></li>
                        </ul>
                    </div> -->
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4> Hubungi Kami</h4>
                        <div>
                            <strong>Phone:</strong> 082179472680<br>
                        </div>
                        <div>
                            <a href="https://wa.link/vk4r94" target="_blank"
                                class="google-plus">
                                <strong>Whatsapp:</strong> 082179472680<br><br>
                            </a>
                        </div>
                        <div>
                            <strong> Location</strong><br>
                        </div>
                        <div>
                            Jl. Jati, Tanjung Raya, Bandar Lampung, Lampung, Indonesia<br>
                            <div class="col-lg-5 d-flex align-items-stretch">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.9883796953673!2d105.27550221430296!3d-5.418734655617113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dbb076c44a2f%3A0x97717b32da6faad!2sBandar%20Lampung%20Sport%20Center!5e0!3m2!1sid!2sid!4v1629473828112!5m2!1sid!2sid" width="200" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Sosial Media</h4>
                        <ul>
                            <li><a href="https://web.facebook.com/rickoyoshua.sinaga/"><i class="fa fa-facebook" aria-hidden="true"></i> <strong>Bandar Lampung Sport Center</strong></a></li>
                             <li><a href="https://www.instagram.com/yoshuaricko/"><i class="fa fa-instagram" aria-hidden="true"></i> <strong>Bandar Lampung Sport Center</strong></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><?= mainweb('nama') ?></strong> <?= date('Y') ?>. All Rights Reserved
            </div>
        </div>
    </footer><!-- #footer -->
    <!-- <a href="#" class="<?= base_url() ?>assets/back-to-top"><i class="fa fa-chevron-up"></i></a> -->
    <div id="bottom-menu">
        <div class="bottom-row">
            <div class="bottom-column">
                <a href="<?= site_url() ?>">
                    <div class="bottom-card">
                        <i class="fa fa-home icon-bottom"></i><br />
                        <p>Home</p>
                    </div>
                </a>
            </div>
            <div class="bottom-column">
                <a href="<?= site_url() ?>jadwal">
                    <div class="bottom-card">
                        <i class="fa fa-calendar icon-bottom"></i><br />
                        <p>Jadwal</p>
                    </div>
                </a>
            </div>
            <div class="bottom-column">
                <a href="<?= site_url() ?>lapangan">
                    <div class="bottom-card">
                        <i class="fa fa-tag icon-bottom"></i><br />
                        <p>Booking</p>
                    </div>
                </a>
            </div>
            <div class="bottom-column">
                <a href="<?= site_url() ?>#gallery">
                    <div class="bottom-card">
                        <i class="fa fa-file-image-o icon-bottom"></i><br />
                        <p>Galeri</p>
                    </div>
                </a>
            </div>
            <div class="bottom-column">
                <a href="<?= site_url() ?>#about">
                    <div class="bottom-card">
                        <i class="fa fa-id-badge icon-bottom"></i><br />
                        <p>About Us</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalTitle">Info Terbaru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php $tp = $this->crud->readlimit('ms_lapangan',[],'rand()',1)[0] ?>
                <div class="modal-body">
                    <a href="<?= site_url() ?>ticket/detail/<?= $tp['link'] ?>">
                        <img class="d-block w-100 mh-100"
                            src="<?= base_url() ?>banner/<?= $tp['banner'] ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
        
        
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/bootstrap-material-datetimepicker.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/jquery/jquery-migrate.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/easing/easing.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/mobile-nav/mobile-nav.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/wow/wow.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/waypoints/waypoints.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/counterup/counterup.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/isotope/isotope.pkgd.min.js"></script>
        <script src="<?= base_url() ?>assets/front/lib/lightbox/js/lightbox.min.js"></script>
        <!-- Template Main Javascript File -->
        <script src="<?= base_url() ?>assets/front/js/main.js"></script>
        <script>
        // $('#myModal').modal('show');
        // $('#buttonCollapse').click(function() {
        //     $("#buttonCollapse").hide(1000);
        //     // $(this).toggleClass('class1')
        // });
        </script>
        <script type="text/javascript">
        


        $(document).ready(function()
        {
            $('#date').bootstrapMaterialDatePicker
                    ({
                        time: false,
                        clearButton: true
                    });

            $('#time').bootstrapMaterialDatePicker
                    ({
                        date: false,
                        shortTime: false,
                        format: 'HH:mm'
                    });

            $('#date-format').bootstrapMaterialDatePicker
                    ({
                        format: 'Y-M-D HH:mm'
                    });
            $('#date-fr').bootstrapMaterialDatePicker
                    ({
                        format: 'DD/MM/YYYY HH:mm',
                        lang: 'fr',
                        weekStart: 1,
                        cancelText: 'ANNULER',
                        nowButton: true,
                        switchOnClick: true
                    });

            $('#date-end').bootstrapMaterialDatePicker
                    ({
                        weekStart: 0, format: 'DD/MM/YYYY HH:mm'
                    });
            $('#date-start').bootstrapMaterialDatePicker
                    ({
                        weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime: true
                    }).on('change', function(e, date)
            {
                $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
            });

            $('#min-date').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});

    //			$.material.init()
        });
        </script>
</body>


</html>