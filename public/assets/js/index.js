// menu show and hide
const bars = document.querySelector('.bars');
const x = document.querySelector('.x_close');

function showSideBar(){
    const menu = document.querySelector('.menu_links');
    menu.style.display = "flex";
}
function hideSideBar(){
    const menu = document.querySelector('.menu_links');
    menu.style.display = "none";
}
bars.addEventListener('click',showSideBar);
x.addEventListener('click',hideSideBar);

// search show and hide

const search = document.querySelector('#search');
const close_btn = document.querySelector('#x_icon');

function showSearchBar(){
    const search = document.querySelector('.search');
    search.style.display = "flex";
}
function hideSearchBar(){
    const search = document.querySelector('.search');
    search.style.display = "none";
}
search.addEventListener('click',showSearchBar);
close_btn.addEventListener('click',hideSearchBar);


// autocomplete city

$(function() {
    var availableCity = [
        "Casablanca", "El Kelaa des Srarhna", "Fès", "Tangier", "Marrakech", "Sale", "Mediouna", "Rabat", "Meknès",
        "Oujda-Angad", "Kenitra", "Agadir", "Tétouan", "Taourirt", "Temara", "Safi", "Khénifra", "Laâyoune", "Mohammedia",
        "Kouribga", "El Jadid", "Béni Mellal", "Ait Melloul", "Nador", "Taza", "Settat", "Barrechid", "Al Khmissat", "Inezgane",
        "Ksar El Kebir", "Larache", "Guelmim", "Berkane", "Khemis Sahel", "Ad Dakhla", "Bouskoura", "Al Fqih Ben Çalah", "Oued Zem",
        "Sidi Slimane", "Errachidia", "Guercif", "Oulad Teïma", "Ben Guerir", "Sefrou", "Fnidq", "Sidi Qacem", "Moulay Abdallah",
        "Youssoufia", "Martil", "Aïn Harrouda", "Skhirate", "Ouezzane", "Sidi Yahya Zaer", "Al Hoceïma", "M’diq", "Sidi Bennour",
        "Midalt", "Azrou", "My Drarga", "Ain El Aouda", "Beni Yakhlef", "Ad Darwa", "Al Aaroui", "Qasbat Tadla", "Boujad", "Jerada",
        "Mrirt", "El Aïoun", "Azemmour", "Temsia", "Zagora", "Ait Ourir", "Azilal", "Sidi Yahia El Gharb", "Biougra", "Zaïo", "Aguelmous",
        "El Hajeb", "Zeghanghane", "Imzouren", "Tit Mellil", "Mechraa Bel Ksiri", "Al ’Attawia", "Demnat", "Arfoud", "Tameslouht", "Bou Arfa",
        "Sidi Smai’il", "Souk et Tnine Jorf el Mellah", "Mehdya", "Aïn Taoujdat", "Chichaoua", "Tahla", "Oulad Yaïch", "Moulay Bousselham",
        "Iheddadene", "Missour", "Zawyat ech Cheïkh", "Bouknadel", "Oulad Tayeb", "Oulad Barhil", "Bir Jdid", "Tifariti"
    ];

    $("#city").autocomplete({
      source: availableCity,
      minLength: 2, 
      delay: 100,
      appendTo: ".search"
    });
    $("#ville").autocomplete({
        source: availableCity,
        minLength: 2, 
        delay: 100,
        appendTo: ".banner_form"
      });
  });