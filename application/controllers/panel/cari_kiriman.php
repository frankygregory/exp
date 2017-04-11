<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cari_kiriman extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $kirim = "select a.*,concat(datediff(a.shipment_end_date,curdate()),' hari') rem_date,".
                   "(select count(1) from t_bidding b where a.shipment_id=b.shipment_id) bid_count,".
                   "(select count(1) from t_bidding b where a.shipment_id=b.shipment_id and b.bidding_status=0) active_bid_count,".
                   "(select min(bidding_price) from t_bidding b where a.shipment_id=b.shipment_id) min_bid_price,".
                   "(select sum(b.item_weight*if(upper(b.item_weight_unit)='TON',1000,1)) from m_shipment_details b where a.shipment_id=b.shipment_id) tot_weight_kg,".
                   "DATE_FORMAT(a.shipment_delivery_date_from,'%d-%b-%y') ship_date_from,".
                   "DATE_FORMAT(a.shipment_delivery_date_to,'%d-%b-%y') ship_date_to ".
                 "from m_shipment a ".
                 "where a.shipment_status = -1 ".
                   "and datediff(a.shipment_end_date,curdate())>-300";

        $data = array(
            'title' => 'Cari Kiriman',
            'kiriman_data' => $this->queryArray($kirim),
        );
        parent::template('cari_kiriman', $data);
    }

    public function detail()
    {
        $data = array(
            'title' => 'Detail Kiriman'
        );
        parent::template('detail_kiriman', $data);
    }
}
