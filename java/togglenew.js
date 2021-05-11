function geid(id){
  return document.getElementById(id);
}
document.getElementById("searchbtn").addEventListener("click", ()=>{
  if (geid("searchbtn").innerHTML === "search&nbsp;"){
    geid("searchbtn").innerHTML = "clear&nbsp;";
    geid("searchbox").style.display = "inline-block";
    geid("title").style.display = "none";
  }else{
    geid("searchbtn").innerHTML = "search&nbsp;";
    geid("searchbox").style.display = "none";
    geid("title").style.display = "inline-block";
  }
});