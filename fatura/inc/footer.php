<div class="modal fade " id="delete-mdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kaydı Sil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">İptal</button>
                <a href="#" class="btn btn-danger mdldeletebtn">Eminim Sil</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var dizin = '';
    var vMinTar_message = "";
    var vMaxTar_message = "";
    var vCheckMinTar_message = "";
    var vCheckRequiredmax_message = "";
    var vRequired_message = "Bu alanı boş bıraktınız";
    var vNumeric_message = "In dieses Feld können Sie nur Zahlen eingeben.";
    var vNumericNot_message = "In dieses Feld können Sie nur Buchstaben eingeben.";
    var vEmailFilter_message = "Bitte geben Sie eine gültige E-Mail-Adresse ein";
    var vMaxchar_message = "In diesem Bereich müssen Sie eine minimale Auswahl treffen";
    var vMinchar_message = "In diesem Bereich müssen Sie eine minimale Auswahl treffen";
    var vPasswordConfirm_message = "Die eingegebenen Passwörter müssen identisch sein";
    var vCheckRequired_message = "In diesem Bereich müssen Sie sich entscheiden";
    var vCheckRequiredmin_message = "In diesem Bereich müssen Sie sich entscheiden";
    var vTcRequired_message = "Bitte geben Sie eine gültige TR-Nummer ein";
    var vYoutube_message = "Geben Sie eine gültige Adresse ein";
    var vFileSize_message = "Sie können nicht mehr als %c KB an Bildern oder Dateien hochladen.";
</script>
<script type="text/javascript">
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
<script type="text/javascript" src="/<?=$directory?>assets/js/popper.min.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/validation_master.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/owl.carousel.js"></script>
<link rel="stylesheet" href="/<?=$directory?>assets/css/animate.css">
<script type="text/javascript" src="/<?=$directory?>assets/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".deletebtn").click(function () {
            var href = $(this).attr("data-href");
            $(".mdldeletebtn").attr("href",href);
        })
    })

    document.addEventListener("DOMContentLoaded", function(){
// make it as accordion for smaller screens
        if (window.innerWidth > 992) {

            document.querySelectorAll('#myDropdown .nav-item').forEach(function(everyitem){

                everyitem.addEventListener('mouseover', function(e){

                    let el_link = this.querySelector('a[data-bs-toggle]');

                    if(el_link != null){
                        let nextEl = el_link.nextElementSibling;
                        el_link.classList.add('show');
                        nextEl.classList.add('show');
                    }

                });
                everyitem.addEventListener('mouseleave', function(e){
                    let el_link = this.querySelector('a[data-bs-toggle]');

                    if(el_link != null){
                        let nextEl = el_link.nextElementSibling;
                        el_link.classList.remove('show');
                        nextEl.classList.remove('show');
                    }


                })
            });

        }
// end if innerWidth
    });
</script>
</body>
</html>
