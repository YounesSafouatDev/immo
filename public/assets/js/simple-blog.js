$(document).ready(function(){
    $('.carousel').slick({
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false,
      dots: false,
      fade: true,
      speed: 3000,
      pauseOnHover: true
    });
  });
  
  const cardContainer = document.getElementById('premiumCardsContainer');
  const prevButton = document.getElementById('prevButton');
  const nextButton = document.getElementById('nextButton');
  const cardWidth = document.querySelector('.premium').offsetWidth;
  
  prevButton.addEventListener('click', () => {
    cardContainer.scrollBy({
      left: -cardWidth,
      behavior: 'smooth'
    });
  });
  
  nextButton.addEventListener('click', () => {
    cardContainer.scrollBy({
      left: cardWidth,
      behavior: 'smooth'
    });
  });
  
