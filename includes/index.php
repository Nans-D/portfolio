<?php include './header.php' ?>

<!-- Content -->
<div class="container-fluid">
    <div class="wrapper position-relative overflow-hidden">
        <div class="d-flex position-relative flex-column text-light h-100 wrapper-child pt-3 px-3">
            <?php include './waveform.php' ?>

            <div class="col-12">
                <div class='row justify-content-between'>
                    <div class="col">
                        <h1 style="font-size:52px;">Nans DELAUBERT</h1>
                        <h2 style="font-size:18px;">Full stack developer</h2>
                    </div>
                    <div id="nameTargetLink" class="col-auto">

                    </div>
                </div>
            </div>
            <nav class="position-absolute" style="top:200px;">
                <ul class="d-flex flex-column list-nav p-0">
                    <li class="col-auto py-2">
                        <a data-link="Home" href="#" class="nav-link link-light d-inline-block">Home</a>
                    </li>
                    <li class="col-auto py-2">
                        <a data-link="Contact" href="#" class="nav-link link-light d-inline-block">Contact</a>
                    </li>
                    <li class="col-auto py-2">
                        <a data-link="Projects" href="#" class="nav-link link-light d-inline-block">Projects</a>
                    </li>
                    <li class="col-auto py-2">
                        <a data-link="Side" href="#" class="nav-link link-light d-inline-block">Side</a>
                    </li>
                </ul>
            </nav>

            <div class="container-print row mt-5">
                <div class="col-3"></div>
                <div class="col-9">
                    <section class="print-section"></section>
                </div>
            </div>
            <div id="socialMediaPrint" class="position-relative align-self-end mt-auto d-none z-2 pb-3">
                <a class="text-light text-decoration-none" target="_blank" href="https://fr.linkedin.com/in/nans-delaubert">
                    <i class="fa-xl fa-brands fa-linkedin"></i>
                </a>
                <a class="text-light text-decoration-none" target="_blank" href="https://github.com/Nans-D">
                    <i class="fa-xl fa-brands fa-square-github"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include './footer.php' ?>
<script>
    $(document).ready(function() {

        const originalTexts = {};

        $('.nav-link').each(function() {
            originalTexts[$(this).data('link')] = $(this).text();
        });

        $('.nav-link').on('mouseenter', function() {
            $(this).addClass('background-link-white');
            $(this).removeClass('link-light');
        });

        $('.nav-link').on('mouseleave', function() {
            if (!$(this).hasClass('active')) { // Ne pas retirer les classes si le lien est actif
                $(this).removeClass('background-link-white');
                $(this).addClass('link-light');
            }
        });

        let form = <?php include './contact.php'; ?>;
        let home = <?php include './home.php' ?>

        $('.nav-link').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if ($(this).hasClass('disabled')) {
                return;
            }

            $('#nameTargetLink').text($(this).data('link'));

            // Remettre les textes originaux et retirer les classes des autres liens
            $('.nav-link').each(function() {
                $(this).html(originalTexts[$(this).data('link')]);
                $(this).removeClass('background-link-white active disabled');
                $(this).addClass('link-light');
            });

            // Définir le lien actuel comme actif et désactivé, puis changer son texte
            $(this).addClass('active disabled').html('<i class="fa-solid fa-arrow-right"></i>').removeClass('link-light');

            let data = $(this).data('link');
            switch (data) {
                case 'Home':
                    $('.print-section').empty().append(home);
                    $('#socialMediaPrint').addClass('d-none');
                    break;
                case 'Contact':
                    $('.print-section').empty().append(form);
                    $('#socialMediaPrint').removeClass('d-none');
                    break;
                case 'Projects':
                    $('.print-section').empty();
                    $('#socialMediaPrint').addClass('d-none');
                    break;
                case 'Side':
                    $('.print-section').empty();
                    $('#socialMediaPrint').addClass('d-none');
                    break;
            }
        });

        $(document).on('mouseenter', '.experience-link', function() {
            $(this).append(`<div class="dropdown-experience my-3">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada fames ac turpis egestas 
    integer eget. Augue eget arcu dictum varius duis at consectetur lorem donec. Risus viverra adipiscing at in tellus integer feugiat scelerisque. Vitae congue eu 
    consequat ac felis donec et odio
    </div>`);
        });

        $(document).on('mouseleave', '.experience-link', function() {
            $('.dropdown-experience').remove();
        });

        $(document).on('submit', '#formContact', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '../api/formContact.php',
                data: formData,
                success: function(data) {
                    if (data.response == 200) {
                        $('.print-section').empty().append(`<div>Merci pour votre message</div>`);
                    } else {
                        alert(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Une erreur s\'est produite: ' + error);
                }
            });
        });
    });
</script>