var secondImages = document.querySelectorAll('.second');
var firstImage = document.querySelector('.first');
secondImages.forEach(function(secondImage) {
secondImage.addEventListener('click', function() {
    var tempSrc = firstImage.src;
        firstImage.src = secondImage.src;
        secondImage.src = tempSrc;
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const cardContainer = document.getElementById('imageCardsContainer');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const cardWidth = document.querySelector('.second').offsetWidth;
    
    prevButton.addEventListener('click', function(e) {
        e.preventDefault();
        const scrollPosition = cardContainer.scrollLeft;
        const newPosition = Math.max(0, scrollPosition - cardWidth - 10); // Adjusting for gap
        cardContainer.scrollTo({
            left: newPosition,
            behavior: 'smooth'
        });
    });
    
    nextButton.addEventListener('click', function(e) {
        e.preventDefault();
        const scrollPosition = cardContainer.scrollLeft;
        const newPosition = Math.min(cardContainer.scrollWidth - cardContainer.clientWidth, scrollPosition + cardWidth + 10); // Adjusting for gap
        cardContainer.scrollTo({
            left: newPosition,
            behavior: 'smooth'
        });
    });
});
const cardContainer = document.getElementById('premiumCardsContainer');
  const prevButton = document.getElementById('prev');
  const nextButton = document.getElementById('next');
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