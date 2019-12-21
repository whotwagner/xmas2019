function log()
{
   console.log("done");
   setTimeout(doWordMagic,15000);
}

function doWordMagic()
{
// Wrap every letter in a span
var textWrapper = document.querySelector('.ml3');
var xmlHttp = new XMLHttpRequest();
textWrapper.innerHTML = "";
textWrapper.style.opacity = 1;
xmlHttp.open( "GET", "/gettext.php", false );
xmlHttp.send( null );
textWrapper.innerText = xmlHttp.responseText;
console.log(textWrapper);
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");


var an = anime.timeline({
  loop: false,
})
  .add({
    targets: '.ml3 .letter',
    opacity: [0,1],
    easing: "easeInOutQuad",
    duration: 2250,
    delay: (el, i) => 150 * (i+1)
  }).add({
    targets: '.ml3',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });

an.finished.then(log);
}

doWordMagic();
