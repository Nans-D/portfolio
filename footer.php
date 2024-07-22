<!-- footer.php -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {

        function loadContent(url, callback) {
            $.ajax({
                url: url,
                method: 'GET',
                success: callback,
                error: function(xhr, status, error) {
                    console.error("Failed to load content:", status, error);
                }
            });
        }

        // NAV LINKS

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
                    loadContent('./home.php', function(response) {
                        $('.print-section').empty().append(response);
                        $('#socialMediaPrint').addClass('d-none');
                    });
                    break;
                case 'Skills':
                    loadContent('./skills.php', function(response) {
                        $('.print-section').empty().append(response);
                        $('#socialMediaPrint').addClass('d-none');
                    });
                    $('#socialMediaPrint').addClass('d-none');
                    break;
                case 'Projects':
                    loadContent('./projects.php', function(response) {
                        $('.print-section').empty().append(response);
                        $('#socialMediaPrint').addClass('d-none');
                    });
                    $('#socialMediaPrint').addClass('d-none');
                    break;
                case 'Contact':
                    loadContent('./contact.php', function(response) {
                        $('.print-section').empty().append(response);
                        $('#socialMediaPrint').addClass('d-none');
                    });
                    $('#socialMediaPrint').removeClass('d-none');
                    break;
            }
        });

        // ______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________

        // HOME PAGE

        $(document).on('mouseenter', '.experience-link', function() {
            var $dropdown = $(`<div class="dropdown-experience"><hr>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada fames ac turpis egestas 
        integer eget. Augue eget arcu dictum varius duis at consectetur lorem donec. Risus viverra adipiscing at in tellus integer feugiat scelerisque. Vitae congue eu 
        consequat ac felis donec et odio<hr>
    </div>`);

            $(this).append($dropdown);
            $dropdown.hide().slideDown(200); // 500 millisecondes pour l'animation d'apparition
        });

        $(document).on('mouseleave', '.experience-link', function() {
            $(this).find('.dropdown-experience').slideUp(200, function() {
                $(this).remove(); // Supprimer l'élément après l'animation
            });
        });

        // ______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________

        // SLIDE CARD TECHNO

        // $(document).on('mouseenter', '.card-techno-php', function() {
        //     var dropdownCard = $(`<div col-9 class="dropdown-techno"><hr>

        //                 <div class='card-techno-text'>Connecting to and manipulating databases (MySQL)</div>
        //                 <div class='card-techno-text'>Using PDO for prepared statements and secure transactions</div>
        //                 <div class='card-techno-text'>Managing CRUD operations for database records</div>
        //                 <div class='card-techno-text'>Consuming RESTful APIs</div>
        //                 <div class='card-techno-text'>Manipulating JSON data</div>
        //                 <div class='card-techno-text'>Reading, writing, and manipulating server files</div>

        //             </div>`);

        //     $(this).parent().after(dropdownCard);
        //     dropdownCard.hide().slideLeft(200); // 500 millisecondes pour l'animation d'apparition
        // })

        // $(document).on('mouseleave', '.dropdown-techno', function() {
        //     $(this).slideUp(200, function() {
        //         $(this).remove(); // Supprimer l'élément après l'animation
        //     });
        // });

        // ______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________


        // CONTACT FORM
        $(document).on('submit', '#formContact', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: './api/formContact.php',
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
</body>

</html>