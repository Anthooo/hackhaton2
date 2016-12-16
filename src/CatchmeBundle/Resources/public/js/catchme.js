// // Materialize Activation affichage select dans création Album
// $(document).ready(function() {
//     $('select').material_select();
// });
//
// // Materialize Activation Info-bulle
// $(document).ready(function(){
//     $('.tooltipped').tooltip({delay: 50});
// });
//
// // Actualise image après chargement sur new et edit Album
// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//
//         reader.onload = function (e) {
//             $('#blah').attr('src', e.target.result);
//             // Sur NEW masque l'image vide -- Changement de la class
//             $('.hide').toggleClass('hide responsive-img');
//             // Sur EDIT masque l'image initiale -- Changement de la class
//             $('.thumbs').toggleClass('thumbs hide');
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
//
// $("#catchmebundle_album_image_file").change(function(){
//     readURL(this);
// });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });