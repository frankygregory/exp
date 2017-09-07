function deleteSupir(t){showFullscreenLoading();var a={submit_delete:!0,driver_id:$(".dialog-konfirmasi-delete").data("id")};ajaxCall(deleteSupirUrl,a,function(t){hideFullscreenLoading(),closeDialog(),"success"==JSON.parse(t).status?getSupir():alert("terjadi kesalahan")})}function clearErrors(){$(".error").html("")}function cekInputError(t,a,i){clearErrors();var e=!0;return""==t&&(e=!1,$(".input-nama").next().html("Nama supir harus diisi")),""==a&&(e=!1,$(".input-alamat").next().html("Alamat supir harus diisi")),""==i&&(e=!1,$(".input-hp").next().html("No. HP supir harus diisi")),e}function editSupir(t){var a=$(t).data("id"),i=$(t).closest(".tr-supir"),e=i.find(".td-name").html(),d=i.find(".td-address").html(),r=i.find(".td-handphone").html(),n=i.find(".td-information").html(),l=i.data("status");$(".dialog-edit").data("id",a),$(".dialog-edit .input-nama").val(e),$(".dialog-edit .input-alamat").val(d),$(".dialog-edit .input-hp").val(r),$(".dialog-edit .input-keterangan").val(n),$(".dialog-edit .input-status").val(l),showDialog(".dialog-edit")}function updateSupir(){var t=$(".dialog-edit").data("id"),a=$(".dialog-edit .input-nama").val().trim(),i=$(".dialog-edit .input-hp").val().trim(),e=$(".dialog-edit .input-alamat").val().trim(),d=$(".dialog-edit .input-keterangan").val().trim(),r=$(".dialog-edit .input-status").val();if(cekInputError(a,e,i)){showFullscreenLoading();var n={submit_update:!0,driver_id:t,driver_name:a,driver_handphone:i,driver_address:e,driver_information:d,driver_status:r};ajaxCall(updateSupirUrl,n,function(t){hideFullscreenLoading(),closeDialog(),"success"==JSON.parse(t).status?getSupir():alert("terjadi kesalahan")})}}function tambahSupir(){var t=$(".dialog-tambah .input-nama").val().trim(),a=$(".dialog-tambah .input-hp").val().trim(),i=$(".dialog-tambah .input-alamat").val().trim(),e=$(".dialog-tambah .input-keterangan").val().trim(),d=$(".dialog-tambah .input-status").val();if(cekInputError(t,i,a)){showFullscreenLoading();var r={submit_tambah:!0,driver_name:t,driver_handphone:a,driver_address:i,driver_information:e,driver_status:d};ajaxCall(tambahSupirUrl,r,function(t){hideFullscreenLoading();var a=JSON.parse(t);closeDialog(),"success"==a.status?getSupir():alert("terjadi kesalahan")})}}function getSupir(){showFullscreenLoading(),ajaxCall(getSupirUrl,null,function(t){hideFullscreenLoading(),$(".tbody-supir").html("");for(var a=jQuery.parseJSON(t),i=a.length,e=0;e<i;e++)addSupirToTable(e+1,a[e]);0==i?$(".table-empty-state").addClass("shown"):$(".table-empty-state").removeClass("shown")})}function addSupirToTable(t,a){var i="Tersedia",e=a.shipment_ids.split(",");if(e.length>0&&""!=e){i="";for(var d=0;d<e.length;d++)i+="<a class='shipment-id' href='"+shipmentUrl+e[d]+"'>"+e[d]+" (No. Kirim)</a>"}null==a.driver_rating&&(a.driver_rating="Unrated");var r=0==a.driver_status?"Tidak Aktif":"Aktif",n="<button class='btn-action btn-edit' title='edit' style='background-image: url("+editIconUrl+");' data-id='"+a.driver_id+"'></button>",l="<button class='btn-action btn-delete' title='delete' style='background-image: url("+deleteIconUrl+");' data-id='"+a.driver_id+"'></button>",s="<tr class='tr-supir' data-id='"+a.driver_id+"' data-status='"+a.driver_status+"'><td class='td-no'>"+t+"</td><td class='td-name'>"+a.driver_name+"</td><td class='td-handphone'>"+a.driver_handphone+"</td><td class='td-address'>"+a.driver_address+"</td><td class='td-ketersediaan'>"+i+"</td><td class='td-rating'>"+a.driver_rating+"</td><td class='td-jumlah-transaksi'>"+a.driver_jumlah_transaksi+"</td><td class='td-information'>"+a.driver_information+"</td><td>"+r+"</td><td>"+n+l+"</td></tr>";$(".tbody-supir").append(s)}$(function(){getSupir(),$(".btn-tambah").on("click",function(){clearErrors(),showDialog(".dialog-tambah"),$(".dialog-tambah .input-nama").select()}),$(".btn-submit-tambah").on("click",function(){tambahSupir()}),$(".input-hp").on("keydown",function(t){isNumber(t)}),$(document).on("click",".btn-edit",function(){clearErrors(),editSupir(this)}),$(".btn-submit-edit").on("click",function(){updateSupir()}),$(document).on("click",".btn-delete",function(){var t=$(this).closest(".tr-supir").children(".td-name").html(),a=$(this).closest(".tr-supir").data("id");$(".dialog-konfirmasi-delete").data("id",a),$(".dialog-konfirmasi-delete .dialog-body").html("Delete "+t+"?"),showDialog(".dialog-konfirmasi-delete")}),$(".btn-submit-delete").on("click",function(){deleteSupir(this)})});