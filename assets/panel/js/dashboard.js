function getKirimanCount(){ajaxCall(getKirimanCountUrl,null,function(t){var a=jQuery.parseJSON(t);isEkspedisi?$(".kiriman-open .value").html(a.kiriman_open):$(".kiriman-total .value").html(a.kiriman_total),$(".kiriman-berjalan .value").html(a.kiriman_berjalan)})}function getMyRating(){ajaxCall(getMyRatingUrl,null,function(t){var a=jQuery.parseJSON(t),d=parseFloat(parseFloat(a[0].user_details_rating).toFixed(2));$(".rating-total-number").html(d)})}function getStatistik(){setLoading(".table-statistik-kiriman, .table-statistik-bidding"),ajaxCall(getStatistikUrl,null,function(t){removeLoading();var a=(t=jQuery.parseJSON(t))[0].jumlah_transaksi_total,d=t[0].jumlah_transaksi_berhasil,i=t[0].jumlah_transaksi_gagal,l=t[0].jumlah_transaksi_total_1_bulan,r=t[0].jumlah_transaksi_berhasil_1_bulan,n=t[0].jumlah_transaksi_gagal_1_bulan,_=t[0].jumlah_transaksi_total_6_bulan,e=t[0].jumlah_transaksi_berhasil_6_bulan,s=t[0].jumlah_transaksi_gagal_6_bulan,m=t[0].jumlah_transaksi_total_12_bulan,u=t[0].jumlah_transaksi_berhasil_12_bulan,h=t[0].jumlah_transaksi_gagal_12_bulan,b="";b+="<td class='td-row-header'>Berhasil</td>",b+="<td>"+d+"</td>",b+="<td>"+r+"</td>",b+="<td>"+e+"</td>",b+="<td>"+u+"</td>",$(".tr-kiriman-berhasil").html(""),$(".tr-kiriman-berhasil").html(b),b="",b+="<td class='td-row-header'>Gagal</td>",b+="<td>"+i+"</td>",b+="<td>"+n+"</td>",b+="<td>"+s+"</td>",b+="<td>"+h+"</td>",$(".tr-kiriman-gagal").html(""),$(".tr-kiriman-gagal").html(b),b="",b+="<td class='td-row-header'>Total</td>",b+="<td>"+a+"</td>",b+="<td>"+l+"</td>",b+="<td>"+_+"</td>",b+="<td>"+m+"</td>",$(".tr-kiriman-total").html(""),$(".tr-kiriman-total").html(b),b="";var g=+(100*d/a).toFixed(2)||0,o=+(100*r/l).toFixed(2)||0,k=+(100*e/_).toFixed(2)||0,j=+(100*u/m).toFixed(2)||0;if(b+="<td class='td-row-header'>Persen</td>",b+="<td>"+g+"%</td>",b+="<td>"+o+"%</td>",b+="<td>"+k+"%</td>",b+="<td>"+j+"%</td>",$(".tr-kiriman-persen").html(""),$(".tr-kiriman-persen").html(b),isEkspedisi){var c=t[0].jumlah_bid_total,p=t[0].jumlah_bid_diterima,x=t[0].jumlah_bid_gagal,F=t[0].jumlah_bid_total_1_bulan,v=t[0].jumlah_bid_diterima_1_bulan,f=t[0].jumlah_bid_gagal_1_bulan,w=t[0].jumlah_bid_total_6_bulan,y=t[0].jumlah_bid_diterima_6_bulan,C=t[0].jumlah_bid_gagal_6_bulan,S=t[0].jumlah_bid_total_12_bulan,E=t[0].jumlah_bid_diterima_12_bulan,J=t[0].jumlah_bid_gagal_12_bulan;b="",b+="<td class='td-row-header'>Berhasil</td>",b+="<td>"+p+"</td>",b+="<td>"+v+"</td>",b+="<td>"+y+"</td>",b+="<td>"+E+"</td>",$(".tr-bidding-berhasil").html(""),$(".tr-bidding-berhasil").html(b),b="",b+="<td class='td-row-header'>Gagal</td>",b+="<td>"+x+"</td>",b+="<td>"+f+"</td>",b+="<td>"+C+"</td>",b+="<td>"+J+"</td>",$(".tr-bidding-gagal").html(""),$(".tr-bidding-gagal").html(b),b="",b+="<td class='td-row-header'>Total</td>",b+="<td>"+c+"</td>",b+="<td>"+F+"</td>",b+="<td>"+w+"</td>",b+="<td>"+S+"</td>",$(".tr-bidding-total").html(""),$(".tr-bidding-total").html(b),b="",b+="<td class='td-row-header'>Persen</td>",b+="<td>"+(g=+(100*p/c).toFixed(2)||0)+"%</td>",b+="<td>"+(o=+(100*v/F).toFixed(2)||0)+"%</td>",b+="<td>"+(k=+(100*y/w).toFixed(2)||0)+"%</td>",b+="<td>"+(j=+(100*E/S).toFixed(2)||0)+"%</td>",$(".tr-bidding-persen").html(""),$(".tr-bidding-persen").html(b)}})}$(function(){getKirimanCount(),isEkspedisi&&getMyRating(),getStatistik()});