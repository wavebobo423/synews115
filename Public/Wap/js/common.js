function goDown(item,event){

if(event.target.tagName != "A"){
var url = $(item).find(".urlAdd").text();
    location.href = url;
}
    
}

