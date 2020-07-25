
$(document).ready(function() {
    aktualizujSurowce();
    $("#zamek").click(function (){
        $("#zamek_info").load("zamek_info.php");
        aktualizujSurowce();
    });
    $("#tartak").click(function (){
        $("#tartak_info").load("tartak_info.php");
        aktualizujSurowce();
    });
    $("#kamieniolom").click(function (){
        $("#kamieniolom_info").load("kamieniolom_info.php");
        aktualizujSurowce();
    });
    $("#pole").click(function (){
        $("#pole_info").load("pole_info.php");
        aktualizujSurowce();
    });
    $("#koszary").click(function (){
        $("#koszary_info").load("koszary_info.php");
        aktualizujSurowce();
    });
    setInterval(aktualizujSurowce, 5000);

    $("#ranking").click(function (){
        $("#ranking_info").load("ranking.php");
        show('ranking_info');
    });
    $("#atakuj").click(function (){
        $("#atakuj_info").load("atakuj_info.php");
    });

})

//ULEPSANIE BUDYNKÓW
$(document).on('click', '#ulepsz_zamek', function(){
        $("#zamek_info").load("zamek_ulepsz.php");
        $("#zamek_info").load("zamek_info.php");
        aktualizujSurowce();
});

$(document).on('click', '#ulepsz_tartak', function(){
        $("#tartak_info").load("tartak_ulepsz.php");
        $("#tartak_info").load("tartak_info.php");
        aktualizujSurowce();
});

$(document).on('click', '#ulepsz_kamieniolom', function(){
        $("#kamieniolom_info").load("kamieniolom_ulepsz.php");
        $("#kamieniolom_info").load("kamieniolom_info.php");
        aktualizujSurowce();
});

$(document).on('click', '#ulepsz_pole', function(){
        $("#pole_info").load("pole_ulepsz.php");
        $("#pole_info").load("pole_info.php");
        aktualizujSurowce();
});

$(document).on('click', '#ulepsz_koszary', function(){
        $("#koszary_info").load("koszary_ulepsz.php");
        $("#koszary_info").load("koszary_info.php");
        aktualizujSurowce();
});

//REKRUTOWANIE JEDNOSTEK
$(document).on('click', '#rekrutuj_wojownika', function(){
        $("#koszary_info").load("rekrutuj_wojownika.php");
        $("#koszary_info").load("koszary_info.php");
        aktualizujSurowce();
});

$(document).on('click', '#rekrutuj_lucznika', function(){
        $("#koszary_info").load("rekrutuj_lucznika.php");
        $("#koszary_info").load("koszary_info.php");
        aktualizujSurowce();
});

function aktualizujSurowce() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("surowce").innerHTML = this.responseText;
      }
  };
  xmlhttp.open("GET", "surowce.php", true);
  xmlhttp.send();
}

function close(budynek){
    document.getElementById(budynek).style.display='none';
}

function show(budynek){
    document.getElementById(budynek).style.display='block';
}
