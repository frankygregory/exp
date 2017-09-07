function getGroupIds(a){showFullscreenLoading(),ajaxCall(getGroupIdsUrl,null,function(t){hideFullscreenLoading();var e=jQuery.parseJSON(t),n=$(".dialog-konfirmasi-submit");n.find(".dialog-value[data-label='judul']").html(a.judul),n.find(".dialog-value[data-label='keterangan']").html(a.keterangan),n.find(".dialog-image").attr("src",$(".image-preview").attr("src")),n.find(".dialog-value[data-label='nama-lokasi-asal']").html(a.lokasi_awal),n.find(".dialog-value[data-label='detail-lokasi-asal']").html(a.detail_awal),n.find(".dialog-value[data-label='kontak-asal']").html(a.kontak_awal),n.find(".dialog-value[data-label='nama-lokasi-tujuan']").html(a.lokasi_tujuan),n.find(".dialog-value[data-label='detail-lokasi-tujuan']").html(a.detail_tujuan),n.find(".dialog-value[data-label='kontak-tujuan']").html(a.kontak_tujuan),n.find(".dialog-value[data-label='tanggal-kirim']").html(a.tanggal_kirim),n.find(".dialog-value[data-label='sampai-dengan']").html(a.sampai_dengan),n.find(".dialog-value[data-label='berakhir-tanggal']").html(a.berakhir);var i=a.harga;""!=i&&(i+=" IDR"),n.find(".dialog-value[data-label='harga']").html(i),n.find(".dialog-value[data-label='tipe-penawaran']").html(a.shipment_type),$(".btn-submit-submit").prop("disabled",!0);for(var o="<option value='0'>Pilih Group...</option>",l=0;l<e.length;l++){var r=""!=e[l].group_name?e[l].group_name:"default";o+="<option value='"+e[l].group_id+"'>"+r+"</option>"}n.find(".select-group").html(o),showDialog(".dialog-konfirmasi-submit")})}function toggleSavedLocation(a){var t=$(a).next();if("none"==$(t).css("display")){$(t).css("display","block");var e=$(a).data("fromto"),n="from";"location_to"==e&&(n="to"),ajaxCall(toggleSavedLocationUrl,{fromto:e},function(a){for(var e=jQuery.parseJSON(a),i="",o=e.length,l=0;l<o;l++)i+="<div class='saved-location-item' data-detail='"+e[l].location_detail+"' data-contact='"+e[l].location_contact+"' data-fromto='"+n+"' data-lat='"+e[l].location_lat+"' data-lng='"+e[l].location_lng+"'>"+e[l].location_name+"</div>";0==o&&(i="<div class='saved-location-empty-state'>Tidak ada lokasi yang didaftarkan</div>"),$(t).html(""),$(t).append(i)})}else $(t).css("display","none")}function addItem(){valid=!0,clearAllErrors();var a,t,e,n,i,o,l,r,s=$(".input-nama-barang").val(),d=$(".input-qty-barang").val(),c=$(".input-deskripsi-barang").val(),u="",g="",p="";switch(""==s&&(error.nama="Nama harus diisi",valid=!1),""==d&&(error.qty="Qty harus diisi",valid=!1),""==c&&(error.deskripsi="Deskripsi harus diisi",valid=!1),$("input[name='pilihan-pengisian']:checked").data("value")){case 1:a=parseInt($(".input-panjang-barang").val().trim())||0,t=parseInt($(".input-lebar-barang").val().trim())||0,e=parseInt($(".input-tinggi-barang").val().trim())||0,u=a+" "+(n=$(".input-satuan-dimensi-barang").val())+"<br>"+t+" "+n+"<br>"+e+" "+n,0!=a&&0!=t&&0!=e||(valid=!1,error.dimensi="Panjang, Lebar, dan Tinggi harus diisi"),p=(l=parseInt($(".input-berat-barang").val().trim())||0)+" "+(r=$(".input-satuan-berat-barang").val()),0==l&&(valid=!1,error.berat="Berat harus diisi");break;case 2:g=(i=parseInt($(".input-kubikasi-barang").val().trim())||0)+" "+(o=$(".input-satuan-kubikasi-barang").val()),0==i&&(valid=!1,error.kubikasi="Kubikasi harus diisi"),p=(l=parseInt($(".input-berat-barang").val().trim())||0)+" "+(r=$(".input-satuan-berat-barang").val()),0==l&&(valid=!1,error.berat="Berat harus diisi");break;case 3:g=(i=parseInt($(".input-kubikasi-barang").val().trim())||0)+" "+(o=$(".input-satuan-kubikasi-barang").val()),0==i&&(valid=!1,error.kubikasi="Kubikasi harus diisi");break;case 4:p=(l=parseInt($(".input-berat-barang").val().trim())||0)+" "+(r=$(".input-satuan-berat-barang").val()),0==l&&(valid=!1,error.berat="Berat harus diisi")}if(showErrors(),valid){var m=parseInt($(".detail-count").val()),_="<input type='hidden' value='"+s+"' name='item-name-"+m+"' />",v="<input type='hidden' value='"+d+"' name='item-qty-"+m+"' />",h="<input type='hidden' value='"+c+"' name='item-deskripsi-"+m+"' />",k="",f="",b="",w="",y="",L="",T="",j="";""!=u&&(k="<input type='hidden' value='"+a+"' name='item-panjang-"+m+"' />",f="<input type='hidden' value='"+t+"' name='item-lebar-"+m+"' />",b="<input type='hidden' value='"+e+"' name='item-tinggi-"+m+"' />",w="<input type='hidden' value='"+n+"' name='item-dimensi-satuan-"+m+"' />",g=(i=a*t*e)+" "+(o=n+"3"),y="<input type='hidden' value='"+i+"' name='item-kubikasi-"+m+"' />",L="<input type='hidden' value='"+o+"' name='item-kubikasi-satuan-"+m+"' />"),""!=g&&(y="<input type='hidden' value='"+i+"' name='item-kubikasi-"+m+"' />",L="<input type='hidden' value='"+o+"' name='item-kubikasi-satuan-"+m+"' />"),""!=p&&(T="<input type='hidden' value='"+l+"' name='item-berat-"+m+"' />",j="<input type='hidden' value='"+r+"' name='item-berat-satuan-"+m+"' />");var P="<button type='button' class='btn-negative btn-remove-item' data-no='"+(m+1)+"'>Remove</button>";$(".section-4-table tbody").append("<tr data-no='"+(m+1)+"'><td>"+s+_+"</td><td>"+d+v+"</td><td>"+c+h+"</td><td>"+u+k+f+b+w+"</td><td>"+g+y+L+"</td><td>"+p+T+j+"</td><td>"+P+"</td></tr>"),$(".detail-count").val(m+1),clearTambahBarang(),$(".section-3").css("display","none")}}function clearTambahBarang(){$(".input-nama-barang").val(""),$(".input-qty-barang").val(""),$(".input-deskripsi-barang").val(""),$(".input-panjang-barang").val(""),$(".input-lebar-barang").val(""),$(".input-tinggi-barang").val(""),$(".input-kubikasi-barang").val(""),$(".input-berat-barang").val(""),clearAllErrors()}function clearAllErrors(){error.nama="",error.qty="",error.deskripsi="",error.dimensi="",error.kubikasi="",error.berat="",$(".error").html("")}function clearPilihanError(){error.dimensi="",error.kubikasi="",error.berat="",$(".error[data-type='dimensi'], .error[data-type='kubikasi'], .error[data-type='berat']").html("")}function showErrors(){$(".error[data-type='nama']").html(error.nama),$(".error[data-type='qty']").html(error.qty),$(".error[data-type='deskripsi']").html(error.deskripsi),$(".error[data-type='dimensi']").html(error.dimensi),$(".error[data-type='kubikasi']").html(error.kubikasi),$(".error[data-type='berat']").html(error.berat)}function updatePosition(a,t,e){$("#"+a).val(t+", "+e)}function initialize(){input=document.getElementById("location_from_address"),autocomplete_asal=new google.maps.places.Autocomplete(input),input=document.getElementById("location_to_address"),autocomplete_tujuan=new google.maps.places.Autocomplete(input),autocomplete_asal.addListener("place_changed",function(){var a=autocomplete_asal.getPlace(),t=getCityFromPlace(a);$("#location_from_name").val(a.name),$("#location_from_city").val(t);var e=a.geometry.location;if(get_lat_long("location",e,"location_from_latlng"),""!=$("#location_to_address").val()){var n=$("#location_to_latlng").val().split(","),i=parseFloat(n[0]),o=parseFloat(n[1]);callDistanceMatrixService(e,n=new google.maps.LatLng(i,o))}}),autocomplete_tujuan.addListener("place_changed",function(){var a=autocomplete_tujuan.getPlace(),t="",e=a.address_components;for(var n in e)if(e.hasOwnProperty(n)){var i=e[n].types;for(var o in i)"administrative_area_level_2"==i[o]&&(t=e[n].long_name)}$("#location_to_name").val(a.name),$("#location_to_city").val(t);var l=a.geometry.location;if(get_lat_long("location",l,"location_to_latlng"),""!=$("#location_from_address").val()){var r=$("#location_from_latlng").val().split(","),s=parseFloat(r[0]),d=parseFloat(r[1]);callDistanceMatrixService(l,r=new google.maps.LatLng(s,d))}})}function getCityFromPlace(a){for(var t="",e=a.address_components,n=0;n<e.length;n++){var i=e[n];if(i.types.indexOf("administrative_area_level_2")>=0){t=i.long_name;break}if(i.types.indexOf("administrative_area_level_1")>=0){t=i.long_name;break}}return t}function callDistanceMatrixService(a,t){map_from_latlng=a,map_to_latlng=t,(new google.maps.DistanceMatrixService).getDistanceMatrix({origins:[a],destinations:[t],travelMode:"DRIVING",avoidHighways:!1,avoidTolls:!1},distanceMatrixCallback)}function distanceMatrixCallback(a,t){if("OK"==t){a.originAddresses,a.destinationAddresses;var e=0,n=a.rows[0].elements[0];e="ZERO_RESULTS"!=n.status?n.distance.value:google.maps.geometry.spherical.computeDistanceBetween(map_from_latlng,map_to_latlng),e/=1e3,$("#shipment_length").val(e)}}function initMap(){geocoder=new google.maps.Geocoder,map_asal=new google.maps.Map(document.getElementById("map_asal"),{center:center_from,streetViewControl:!1,disableDefaultUI:!0,scrollwheel:!1,zoom:17}),placeService=new google.maps.places.PlacesService(map_asal),marker_asal=new google.maps.Marker({position:center_from,draggable:!0,map:map_asal}),google.maps.event.addListener(marker_asal,"dragend",function(){map_asal.setCenter(this.getPosition()),updatePosition("location_from_latlng",this.getPosition().lat(),this.getPosition().lng()),latlng={lat:parseFloat(this.getPosition().lat()),lng:parseFloat(this.getPosition().lng())},(new google.maps.Geocoder).geocode({location:latlng},function(a,t){"OK"===t?a[1]?$("#location_from_address").val(a[0].formatted_address):window.alert("No results found"):window.alert("Geocoder failed due to: "+t)})}),map_tujuan=new google.maps.Map(document.getElementById("map_tujuan"),{center:center_to,streetViewControl:!1,disableDefaultUI:!0,scrollwheel:!1,zoom:17}),marker_tujuan=new google.maps.Marker({position:center_to,draggable:!0,map:map_tujuan}),google.maps.event.addListener(marker_tujuan,"dragend",function(){map_tujuan.setCenter(this.getPosition()),updatePosition("location_to_latlng",this.getPosition().lat(),this.getPosition().lng()),latlng={lat:parseFloat(this.getPosition().lat()),lng:parseFloat(this.getPosition().lng())},(new google.maps.Geocoder).geocode({location:latlng},function(a,t){"OK"===t?a[1]?$("#location_to_address").val(a[0].formatted_address):window.alert("No results found"):window.alert("Geocoder failed due to: "+t)})}),updatePosition("location_from_latlng",center_from.lat,center_from.lng),updatePosition("location_to_latlng",center_to.lat,center_to.lng),google.maps.event.addDomListener(window,"load",initialize)}function get_lat_long(a,t,e){var n,i;"location"==a?(n=t.lat(),i=t.lng()):"address"==a&&(new google.maps.Geocoder).geocode({address:t},function(a,t){n=1*a[0].geometry.location.lat(),i=1*a[0].geometry.location.lng(),"location_from_latlng"==e?($("#location_from_latlng").val(n+", "+i),marker_asal.setPosition(new google.maps.LatLng(n,i)),map_asal.panTo(new google.maps.LatLng(n,i))):"location_to_latlng"==e&&($("#location_to_latlng").val(n+", "+i),marker_tujuan.setPosition(new google.maps.LatLng(n,i)),map_tujuan.panTo(new google.maps.LatLng(n,i)))}),"location_from_latlng"==e?($("#location_from_latlng").val(n+", "+i),marker_asal.setPosition(new google.maps.LatLng(n,i)),map_asal.panTo(new google.maps.LatLng(n,i))):"location_to_latlng"==e&&($("#location_to_latlng").val(n+", "+i),marker_tujuan.setPosition(new google.maps.LatLng(n,i)),map_tujuan.panTo(new google.maps.LatLng(n,i)))}function setMarkerFromLatlng(){latlng=$("#location_latlng").val(),lat=latlng.substring(0,latlng.indexOf(",")),lng=latlng.substring(latlng.indexOf(" "),latlng.length-1),marker.setPosition(new google.maps.LatLng(lat,lng)),map.panTo(new google.maps.LatLng(lat,lng))}var section1Top=0,section2Top=0,section3Top=0,section4Top=0;$(function(){section2Top=$(".section-2").offset().top-70,section3Top=$(".section-3").offset().top-70,section4Top=$(".section-4").offset().top-70,$(".input-tanggal-kirim-awal").datepicker({disableDateBefore:new Date}),$(".input-tanggal-kirim-akhir").datepicker({disableDateBefore:new Date}),$(".input-tanggal-deadline").datepicker({disableDateBefore:new Date}),$(".input-tanggal-kirim-awal").on("datetimeSelected",function(){var a,t=$(this).data("value-date"),e=new Date(t),n=$(".input-tanggal-kirim-akhir").data("value-date");""!=n&&new Date(n)>=e&&(a=n+" "+$(".input-tanggal-kirim-akhir").data("value-time")),$(".input-tanggal-kirim-akhir").datepicker({disableDateBefore:e,firstValue:a}),a=null;var i=$(".input-tanggal-deadline").data("value-date");""!=i&&new Date(i)<=e&&(a=i+" "+$(".input-tanggal-deadline").data("value-time")),$(".input-tanggal-deadline").datepicker({disableDateAfter:e,firstValue:a})}),$(".input-tanggal-kirim-awal").on("datetimeOkSelected",function(){""!=$(this).val()&&""==$(".input-tanggal-kirim-akhir").data("value-date")&&$(".input-tanggal-kirim-akhir").focus()}),$(".input-tanggal-kirim-akhir").on("datetimeOkSelected",function(){""!=$(this).val()&&""==$(".input-tanggal-deadline").data("value-date")&&$(".input-tanggal-deadline").focus()}),$(".section-5-left input").on("datetimeShow",function(){$(this).addClass("focus")}),$(".section-5-left input").on("datetimeHidden",function(){$(this).removeClass("focus")}),$(".btn-show-tambah-barang").on("click",function(){"none"==$(".section-3").css("display")?$(".section-3").css("display","block"):$(".section-3").css("display","none")}),$(document).on("keypress",function(a){13==a.which&&a.preventDefault()}),$("input[type='radio'][name='pilihan-pengisian']").on("change",function(){var a=$(this).data("value");switch(clearPilihanError(),$(".pilihan[data-checked='1']").removeAttr("data-checked"),a){case 1:$(".pilihan-dimensi").attr("data-checked","1"),$(".pilihan-berat").attr("data-checked","1");break;case 2:$(".pilihan-kubikasi").attr("data-checked","1"),$(".pilihan-berat").attr("data-checked","1");break;case 3:$(".pilihan-kubikasi").attr("data-checked","1");break;case 4:$(".pilihan-berat").attr("data-checked","1")}}),$(".saved-location").on("click",function(a){toggleSavedLocation(this),a.stopPropagation()}),$(document).on("click",function(a){"saved-location-container"!==$(a.target).attr("class")&&$(".saved-location-container").css("display","none")}),$(document).on("click",".saved-location-item",function(){var a=$(this).data("fromto"),t=$(this).data("detail"),e=$(this).data("contact"),n=$(this).html(),i=$(this).data("lat"),o=$(this).data("lng"),l=new google.maps.LatLng(i,o);geocoder.geocode({location:l},function(i,o){if("OK"===o){var r=getCityFromPlace(i[0]),s=i[0].formatted_address;if($("#location_"+a+"_address").val(n+", "+s),$("#location_"+a+"_name").val(n),$("#location_"+a+"_city").val(r),$("#location_"+a+"_detail").val(t),$("#location_"+a+"_contact").val(e),get_lat_long("location",l,"location_"+a+"_latlng"),"from"==a){if(""!=$("#location_to_address").val()){var d=$("#location_to_latlng").val().split(","),c=parseFloat(d[0]),u=parseFloat(d[1]);d=new google.maps.LatLng(c,u),callDistanceMatrixService(l,d)}}else if(""!=$("#location_from_address").val()){var g=$("#location_from_latlng").val().split(","),p=parseFloat(g[0]),m=parseFloat(g[1]);g=new google.maps.LatLng(p,m),callDistanceMatrixService(l,g)}}})}),$(".input-gambar").on("change",function(){var a=new FileReader;a.onload=function(a){$(".image-preview").attr("src",a.target.result)},a.readAsDataURL($(this)[0].files[0])}),$(document).on("click","table .btn-remove-item",function(){var a=$(this).data("no");$(".section-4-table tr[data-no='"+a+"']").remove();var t=parseInt($(".detail-count").val());$(".detail-count").val(t-1)}),$("input[data-type='number']").on("keydown",function(a){isNumber(a)}),$(".input-harga").on("input",function(){var a=$(this).val().replace(/,/g,"");a=addCommas(a),$(this).val(a)}),$(".btn-submit").on("click",function(a){clearAllErrors();var t=!0,e=$(".input-judul").val().trim();""==e&&($(".input-judul").next().html("Judul harus diisi"),t&&$(".container-content").scrollTop(section1Top),t=!1);var n=$(".input-keterangan").val().trim();""==n&&($(".input-keterangan").next().html("Keterangan harus diisi"),t&&$(".container-content").scrollTop(section1Top),t=!1);var i=$("#location_from_address").val().trim(),o=$("#location_from_name").val().trim();""==i?($("#location_from_address").next().html("Lokasi Asal harus diisi"),t&&$(".container-content").scrollTop(section2Top),t=!1):""==o&&($("#location_from_address").next().html("Lokasi Asal harus dipilih dari Google Maps"),t&&$(".container-content").scrollTop(section2Top),t=!1);var l=$("#location_from_detail").val().trim();""==l&&($("#location_from_detail").next().html("Detail Lokasi harus diisi"),t&&$(".container-content").scrollTop(section2Top),t=!1);var r=$("#location_from_contact").val().trim();""==r&&($("#location_from_contact").next().html("Kontak harus diisi"),t&&$(".container-content").scrollTop(section2Top),t=!1);var s=$("#location_to_address").val().trim(),d=$("#location_to_name").val().trim();""==s?($("#location_to_address").next().html("Lokasi Tujuan harus diisi"),t&&$(".container-content").scrollTop(section2Top),t=!1):""==d&&($("#location_to_address").next().html("Lokasi Tujuan harus dipilih dari Google Maps"),t&&$(".container-content").scrollTop(section2Top),t=!1);var c=$("#location_to_detail").val().trim();""==c&&($("#location_to_detail").next().html("Detail Lokasi harus diisi"),t&&$(".container-content").scrollTop(section2Top),t=!1);var u=$("#location_to_contact").val().trim();""==u&&($("#location_to_contact").next().html("Kontak harus diisi"),t&&$(".container-content").scrollTop(section2Top),t=!1),0==parseInt($(".detail-count").val())&&($(".section-4-content").next().html("List Barang harus diisi"),t&&$(".container-content").scrollTop(section4Top),t=!1);var g=$(".input-tanggal-kirim-awal").val();""==g&&(t=!1,$(".input-tanggal-kirim-awal").next().html("Tanggal harus diisi"));var p=$(".input-tanggal-kirim-akhir").val();""==p&&(t=!1,$(".input-tanggal-kirim-akhir").next().html("Tanggal harus diisi"));var m=$(".input-tanggal-deadline").val();""==m&&(t=!1,$(".input-tanggal-deadline").next().html("Tanggal harus diisi"));var _=$(".input-harga").val(),v=$(".radio-shipment-type:checked").data("text");a.preventDefault(),t&&getGroupIds({judul:e,keterangan:n,lokasi_awal:i,detail_awal:l,kontak_awal:r,lokasi_tujuan:s,detail_tujuan:c,kontak_tujuan:u,tanggal_kirim:g,sampai_dengan:p,berakhir:m,harga:_,shipment_type:v})}),$("#kirimForm").on("submit",function(){showFullscreenLoading();var a=$(".input-harga").val().replace(/,/g,"");$(".input-harga").val(a);var t=$(".select-group").val();$(this).append("<input type='hidden' name='group_id' value='"+t+"' />")}),$(".btn-submit-submit").on("click",function(){$("#kirimForm").submit()}),$(".select-group").on("change",function(){0==$(this).val()?$(".btn-submit-submit").prop("disabled",!0):$(".btn-submit-submit").prop("disabled",!1)})});var map_asal,map_tujuan,placeService,marker_asal,marker_tujuan,autocomplete_asal,autocomplete_tujuan,map_from_latlng,map_to_latlng,center_from={lat:-2.4153238,lng:108.8510806},center_to={lat:-2.4153238,lng:108.8510806};$("#location_from_address").on("change",function(){location_from_address.changed=!0}),$("#location_to_address").on("change",function(){location_to_address.changed=!0}),$("#location_from_address").on("focusout",function(){location_from_address.autocomplete_clicked=!1,location_from_address.changed=!1}),$("#location_to_address").on("focusout",function(){location_to_address.autocomplete_clicked=!1,location_to_address.changed=!1});