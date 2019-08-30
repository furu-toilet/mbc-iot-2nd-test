var OnStatus = document.getElementById('vacancy');

//OnStatus.onchange = EveDoing();

OnStatus.addEventListener('change',function(){
  EveDoing();
});

function EveDoing(){
  console.log("function start");
}
