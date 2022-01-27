    var ajaxku;
function ajaxsub(id){
    ajaxku = buatajax();
    var url="ajax/select_category.php";
    url=url+"?sub="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxbrand(id){
    ajaxku = buatajax();
    var url="ajax/select_category.php";
    url=url+"?brand="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedBrand;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function buatajax(){
    if (window.XMLHttpRequest){
    return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
    return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}
function stateChanged(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("sub").innerHTML = data
    }else{
    document.getElementById("sub").value = "<option selected>Pilih Subcategories</option>";
    }
    }
}

function stateChangedBrand(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("brand").innerHTML = data
    }else{
    document.getElementById("brand").value = "<option selected>Pilih Brands</option>";
    }
    }
}
