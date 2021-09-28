// var keyword = document.getElementById('keyword');
// var tombol = document.getElementById('tombol');
// var container = document.getElementById('container');

// keyword.addEventListener('keyup', function(){

//     // object ajax
//     var xhr = new XMLHttpRequest();
    
//     // cek ajax
//     xhr.onreadystatechange = function(){
//         if(xhr.readyState == 4 && xhr.status == 200) {
//             container.innerHTML = xhr.responseText;
//         }
//     }

//     // eksekusi ajax
//     xhr.open('GET', 'ajax/buku.php?keyword=' + keyword.value, true);
//     xhr.send();
// });

$(document).ready(function(){
    $('#tombol').hide();
    // event keyword keyup
    $('#keyword').on('keyup', function(){

        $('.loader').show();
        $.get('ajax/buku.php?keyword=' + $('#keyword').val(), function(data) {
            $('#container').html(data);
            $('.loader').hide();
        });
    });

});