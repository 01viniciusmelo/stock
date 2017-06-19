<?php

/* * *****************************************************************************
 * PHP Invoice                                                                  *
 *                                                                              *
 * Version: 1.0	                                                               *
 * Author:  Farjad Tahir	                                    				   *
 * http://www.splashpk.com                                                      *
 * ***************************************************************************** */
require_once('inc/__autoload.php');

class phpinvoice extends FPDF_rotation {

    private $font = 'tahoma';   /* Font Name : See inc/fpdf/font for all supported fonts */
    private $columnOpacity = 0.06;    /* Items table background color opacity. Range (0.00 - 1) */
    private $columnSpacing = 0.3;     /* Spacing between Item Tables */
    private $referenceformat = array('.', ','); /* Currency formater */
    private $margins = array('l' => 5, 't' => 5, 'r' => 5); /* l: Left Side , t: Top Side , r: Right Side */
    private $job_detail;
    private $cntItem = 0;
    private $item_head_text = array(
        "เลขที่\nNo.",
        "เลขที่ อะไหล่\nPart No.",
        "รายการ อะไหล่ และ บริการ\nDescription Part & Service",
        "จำนวน\nQty",
        );
    
    
    public $lang;
    public $document;
    public $type;
    public $reference;
    public $logo;
    public $color;
    public $date;
    public $time;
    public $due;
    public $from;
    public $to;
    public $items;
    public $totals;
    public $badge;
    public $addText;
    public $footernote;
    public $dimensions;
    public $display_tofrom = true;
    
    public $company_th;
    public $company_en;
    public $address_th;
    public $address_en;
    
    
    /*     * ****************************************
     * Class Constructor               		 *
     * param : Page Size , Currency, Language *
     * **************************************** */

    public function __construct($size = 'A4', $currency = '$', $language = 'en') {
        $this->columns = 4;
        $this->items = array();
        $this->totals = array();
        $this->addText = array();
        $this->firstColumnWidth = 5;
        $this->currency = $currency;
        $this->maxImageDimensions = array(230, 100);
        $this->setLanguage($language);
        $this->setDocumentSize($size);
        $this->setColor("#222222");
        $this->FPDF('P', 'mm', array($this->document['w'], $this->document['h']));
        $this->AliasNbPages();
        $this->SetMargins($this->margins['l'], $this->margins['t'], $this->margins['r']);
    }

    private function setLanguage($language) {
        $this->language = $language;
        include('inc/languages/' . $language . '.inc');
        $this->lang = $lang;
    }

    private function setDocumentSize($dsize) {
        switch ($dsize) {
            case 'A4':
                $document['w'] = 210;
                $document['h'] = 297;
                break;
            case 'letter':
                $document['w'] = 215.9;
                $document['h'] = 279.4;
                break;
            case 'legal':
                $document['w'] = 215.9;
                $document['h'] = 355.6;
                break;
            default:
                $document['w'] = 210;
                $document['h'] = 297;
                break;
        }
        $this->document = $document;
    }

    private function resizeToFit($image) {
        list($width, $height) = getimagesize($image);
        $newWidth = $this->maxImageDimensions[0] / $width;
        $newHeight = $this->maxImageDimensions[1] / $height;
        $scale = min($newWidth, $newHeight);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    private function pixelsToMM($val) {
        $mm_inch = 25.4;
        $dpi = 96;
        return ($val * $mm_inch) / $dpi;
    }

    private function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }

    private function br2nl($string) {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }

    public function isValidTimezoneId($zone) {
        try {
            new DateTimeZone($zone);
        } catch (Exception $e) {
            return FALSE;
        }
        return TRUE;
    }

    public function setTimeZone($zone = "") {
        if (!empty($zone) and $this->isValidTimezoneId($zone) === TRUE) {
            date_default_timezone_set($zone);
        }
    }

    public function setType($title) {
        $this->title = $title;
    }
    
    public function setCompanyEn($title) {
        $this->company_en = $title;
    }
    
    public function setCompanyTh($title) {
        $this->company_th = $title;
    }
    
    public function setAddressEn($title) {
        $this->address_en = $title;
    }
    
    public function setAddressTh($title) {
        $this->address_th = $title;
    }
    
    public function setColor($rgbcolor) {
        $this->color = $this->hex2rgb($rgbcolor);
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function setDue($date) {
        $this->due = $date;
    }

    public function setLogo($logo = 0, $maxWidth = 0, $maxHeight = 0) {
        if ($maxWidth and $maxHeight) {
            $this->maxImageDimensions = array($maxWidth, $maxHeight);
        }
        $this->logo = $logo;
        $this->dimensions = $this->resizeToFit($logo);
    }

    public function hide_tofrom() {
        $this->display_tofrom = false;
    }
    
    public function setJob($job){
        $this->job_detail = $job;
    }

    public function setFrom($data) {
        $this->from = $data;
    }

    public function setTo($data) {
        $this->to = $data;
    }

    public function setReference($reference) {
        $this->reference = $reference;
    }

    public function setNumberFormat($decimals, $thousands_sep) {
        $this->referenceformat = array($decimals, $thousands_sep);
    }

    public function flipflop() {
        $this->flipflop = true;
    }

//    public function addItem($item, $description = "", $quantity, $vat, $price, $discount = 0, $total) {
//        $p['part'] = "PART";
//        $p['item'] = $item;
//        $p['description'] = $this->br2nl($description);
//
//        if ($vat !== false) {
//            $p['vat'] = $vat;
//            if (is_numeric($vat)) {
//                $p['vat'] = $this->currency . ' ' . number_format($vat, 2, $this->referenceformat[0], $this->referenceformat[1]);
//            }
//            $this->vatField = true;
//            $this->columns = 5;
//        }
//        $p['quantity'] = $quantity;
//        $p['price'] = $price;
//        $p['total'] = $total;
//
//        if ($discount !== false) {
//            $this->firstColumnWidth = 58;
//            $p['discount'] = $discount;
//            if (is_numeric($discount)) {
//                $p['discount'] = $this->currency . ' ' . number_format($discount, 2, $this->referenceformat[0], $this->referenceformat[1]);
//            }
//            $this->discountField = true;
//            $this->columns = 6;
//        }
//        $this->items[] = $p;
//    }
     public function addItem($item_no, $item_description = "", $quantity) {
        $this->cntItem += 1;
        $p['num'] = $this->cntItem;
        $p['item_no'] = $item_no;
        $p['description'] = $this->br2nl($item_description);
        $p['quantity'] = $quantity;
        $this->items[] = $p;
    }

    public function addTotal($name, $value, $colored = FALSE) {
        $t['name'] = $name;
        $t['value'] = $value;
        if (is_numeric($value)) {
            $t['value'] = $this->currency . ' ' . number_format($value, 2, $this->referenceformat[0], $this->referenceformat[1]);
        }
        $t['colored'] = $colored;
        $this->totals[] = $t;
    }

    public function addTitle($title) {
        $this->addText[] = array('title', $title);
    }

    public function addParagraph($paragraph) {
        $paragraph = $this->br2nl($paragraph);
        $this->addText[] = array('paragraph', $paragraph);
    }

    public function addBadge($badge) {
        $this->badge = $badge;
    }

    public function setFooternote($note) {
        $this->footernote = $note;
    }

    public function render($name = '', $destination = '') {
        $this->AddPage();
        $this->Body();
        $this->AliasNbPages();
        $this->Output($name, $destination);
    }

    public function Header() {
        if (isset($this->logo) and ! empty($this->logo)) {
            $this->Image($this->logo, $this->margins['l'], $this->margins['t'], $this->dimensions[0], $this->dimensions[1]);
        }
        
        // company
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->font, '', 10);
        $this->Cell(0, 5, iconv("UTF-8", "cp874", $this->company_th), 0, 1, 'R');
        $this->Cell(0, 5,  strtoupper($this->company_en), 0, 1, 'R');
        $this->Ln(2);
        
        // address
        $this->SetFont($this->font, '', 8);
        $this->Cell(0, 5, iconv("UTF-8", "cp874", $this->address_th), 0, 1, 'R');
        $this->Cell(0, 5, strtoupper($this->address_en), 0, 1, 'R');
        $this->Ln(15);
        
        // invoice name
        $this->SetY($this->dimensions[1]+5);
        $this->SetFont($this->font, 'B', 16);
        $this->Cell(0, 5, iconv("UTF-8", "cp874", "ใบรายงานซ่อม"), 0, 1, 'C');
        $this->Cell(0, 5, iconv("UTF-8", "cp874", "Service Report"), 0, 1, 'C');
        $this->SetFont($this->font, '', 12);
        $this->Ln(5);
        
        if ($this->PageNo() == 1) {
            $this->jobDetail();
        }
        
//        //Table header
        if (!isset($this->productsEnded) ) {
            $this->SetY($this->GetY()+5);
            $this->SetTextColor(50, 50, 50);
            $this->SetFont($this->font, 'B', 10);
            foreach($this->item_head_text as $idx=> $text){
                $lineTxt = explode("\n", $text);
                $this->Cell($this->getItemColumnWidth($idx) , 4, iconv("UTF-8", "cp874", $lineTxt[0]), 0, 0, 'L', 0);
            }
            $this->Ln();
            foreach($this->item_head_text as $idx=> $text){
                $lineTxt = explode("\n", $text);
                $this->Cell($this->getItemColumnWidth($idx) , 6, iconv("UTF-8", "cp874", $lineTxt[1]), 0, 0, 'L', 0);
            }
            
            $this->Ln();
            $this->SetLineWidth(0.3);
            $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
            $this->Line($this->margins['l'], $this->GetY(), $this->document['w'] - $this->margins['r'], $this->GetY());
            $this->Ln(2);
        } else {
            $this->Ln(12);
        }
    }
    
    private function getItemColumnWidth($idx = 0){
        $w[0] = ($this->document['w'] *.1 );
        $w[1] = ($this->document['w'] *.35 );
        $w[2] = ($this->document['w'] *.35 );
        $w[3] = ($this->document['w'] *.15 );
        
        return $w[$idx];
    }
    
    public function jobDetail(){
        if( empty($this->job_detail) ){
            return false;
        }
        
        $job = $this->job_detail;
//        print_r($job);
//        exit;
        
        // PO Detail
        // some things to set and 'remember'
        $x = $this->GetX();
        $y = $this->GetY();
        
        $wColumn1 = $this->document['w']*.1;
        $wColumn2 = $this->document['w']*.37;
        $wColumn3 = $this->document['w']*.1;
        $wColumn4 = $this->document['w']*.37;
        
        $this->SetFont($this->font, '', 12);
        
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","วันที่\nDate"),0,'L'); 
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,format_date_time($job->job_date),'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","ลูกค้า\nCustomer/Site"),0,'L'); 
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->cus_sitename),'B','L');
        
        $y+=8;
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","เวลาเริ่ม\nStart Time"),0,'L'); 
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,format_date_time($job->job_date_start),'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","เวลาเสร็จ\nEnd Time"),0,'L');
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",str_replace("  ", " ", format_date_time($job->job_date_finish))),'B','L');$this->SetFont($this->font, '', 12);
        
        $y+=8;
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","เลขที่งาน\nJob No."),0,'L'); 
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,$job->job_no,'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","รหัสหน้างาน\nSite Code"),0,'L'); $this->SetFont($this->font, '', 10);
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",str_replace("  ", " ", str_replace("\n", " ", $job->job_site_code))),'B','L');$this->SetFont($this->font, '', 12);
        
        $y+=8;
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","รถทะเบียน\nTruck License"),0,'L'); 
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,$job->license,'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","เบอร์รถ\nTruck No."),0,'L'); 
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->number),'B','L');
        
        $y+=8;
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","เลขชัวโมง\nEngine Hour"),0,'L'); 
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,$job->engine_hr,'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","เลขเครื่อง\nSerial No."),0,'L'); 
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->serial_tk),'B','L');
        
        $y+=8;
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","เลขไมล์\nMileage"),0,'L'); 
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,$job->milege,'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","เลขไฟฟ้า\nElectric hour"),0,'L'); 
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->electric_hr),'B','L');
        
        $y+=8;
        $this->SetFont($this->font, '', 10);
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","เครื่องทำความเย็น\nRefrigerator Model"),0,'L'); $this->SetFont($this->font, '', 12);
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,$job->refrigerator_model,'B','L');
        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","ผู้ประสานงาน\nContact"),0,'L'); 
        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->job_contact_name),'B','L');
        
//        $y+=10;
//        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","Type"),0,'L'); $this->SetFont($this->font, '', 12);
//        $this->SetXY($x+$wColumn1,$y);
//        $this->SetFont('ZapfDingbats','', 10);
//        $this->MultiCell(3, 3, $job->job_check_document_rm == 'Y', 1, 0);
//        $this->SetFont($this->font, '', 12);
//        
        //$this->MultiCell( $wColumn2,8,$job->milege,'B','L');
        
        
//        $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","VMU type"),0,'L'); 
//        $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->electric_hr),'B','L');
        
        //$this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,$job->job_check_document_rm,'0','L');
        //$this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn3,8,$job->job_check_document_pm,'0','L');
        
        
        
        $y+=10;
        $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","ที่อยู่\nAddress"),0,'L'); $this->SetFont($this->font, '', 12);
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2+$wColumn3+$wColumn4,8,iconv("UTF-8", "cp874",preg_replace( "/\r|\n/", " ", $job->cus_address )),'B','L');
        //$this->checkBox(true);
        
        $y+=10;
        $this->SetXY($x,$y); $this->Cell( $wColumn1 ,4, iconv("UTF-8", "cp874","Job Discription"),0,'L');
        $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2+$wColumn2+$wColumn1,5,iconv("UTF-8", "cp874",preg_replace( "/\r|\n/", "",$job->job_desc)),'B','L');
        $this->Ln(5);
        
    }
    
    private function checkBox($isCheck=FALSE,$boxSize=3)
    {
        //$this->SetX(1);
        if($isCheck)
            $check = "4"; 
        else $check = "";
            
        $this->SetFont('ZapfDingbats','', 10);
        $this->Cell($boxSize, $boxSize, $check, 1, 0);
        $this->SetFont($this->font, '', 12);
    }

    public function Body() {
        
        $cellHeight = 8;
        $bgcolor = (1 - $this->columnOpacity) * 255;
        
        
        $badgeX = $this->getX();
        $badgeY = $this->getY();
        
        if($this->items){
            
            foreach ($this->items as $item) {
                
                if ($item['description']) {
                    //Precalculate height
                    $calculateHeight = new phpinvoice;
                    $calculateHeight->addPage();
                    $calculateHeight->setXY(0, 0);
                    $calculateHeight->SetFont($this->font, '', 10);
                    $calculateHeight->MultiCell($this->getItemColumnWidth(0), 3, iconv("UTF-8", "cp874", $item['description']), 0, 'L', 1);
                    $descriptionHeight = $calculateHeight->getY() + $cellHeight + 2;
                    $pageHeight = $this->document['h'] - $this->GetY() - $this->margins['t'] - $this->margins['t'];
                    
                    if ($pageHeight < 40) {
                        $this->AddPage();
                    }
                }
                $x = $this->GetX();
                $y = $this->GetY();
                $cHeight = $cellHeight;
                $this->SetFont($this->font, '', 12);
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                
//                $this->Cell($this->getItemColumnWidth(0), $cHeight, iconv("UTF-8", "cp874", $item['num']), 0, 0, 'L', 1);
//                $this->Cell($this->getItemColumnWidth(1), $cHeight, iconv("UTF-8", "cp874", $item['item_no']), 0, 0, 'L', 1);
//                $this->Cell($this->getItemColumnWidth(2), $cHeight, iconv("UTF-8", "cp874", $item['description']), 0, 0, 'L', 1);
//                $this->Cell($this->getItemColumnWidth(3), $cHeight, iconv("UTF-8", "cp874", $item['quantity']), 0, 0, 'L', 1);
                $this->SetXY($x,$y);
                $this->MultiCell($this->getItemColumnWidth(0), $cHeight, iconv("UTF-8", "cp874", "    ".$item['num']), 0, 'L', 1);
                $this->SetXY($this->getItemColumnWidth(0),$y);
                $this->MultiCell($this->getItemColumnWidth(2), $cHeight, iconv("UTF-8", "cp874", "      ".$item['item_no']), 0, 'L', 1);
                $this->SetXY($this->getItemColumnWidth(0)+$this->getItemColumnWidth(1),$y);
                $this->MultiCell($this->getItemColumnWidth(2), $cHeight, iconv("UTF-8", "cp874", "      ".$item['description']), 0, 'L', 1);
                $this->SetXY($this->getItemColumnWidth(0)+$this->getItemColumnWidth(1)+$this->getItemColumnWidth(2),$y);
                $this->MultiCell($this->getItemColumnWidth(3), $cHeight, iconv("UTF-8", "cp874", "      ".$item['quantity']), 0, 'L', 1);

                $this->Ln($this->columnSpacing);
            }
            
        }
        

        $this->productsEnded = true;
        $badgeX = $this->getX();
        $badgeY = $this->getY();
        $this->Ln();
        $this->Ln(3);


        //Badge
        if ($this->badge) {
            $badge = ' ' . strtoupper($this->badge) . ' ';
            $resetX = $this->getX();
            $resetY = $this->getY();
            $this->setXY($badgeX, $badgeY + 15);
            $this->SetLineWidth(0.4);
            $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
            $this->setTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetFont($this->font, 'b', 15);
            $this->Rotate(10, $this->getX(), $this->getY());
            $this->Rect($this->GetX(), $this->GetY(), $this->GetStringWidth($badge) + 2, 10);
            $this->Write(10, $badge);
            $this->Rotate(0);
            if ($resetY > $this->getY() + 20) {
                $this->setXY($resetX, $resetY);
            } else {
                $this->Ln(18);
            }
        }
        
        
        //
        if($this->job_detail){
            
            $job = $this->job_detail;

            // some things to set and 'remember'
            $this->setXY($badgeX, $this->document['h'] - 40);
            $x = $this->GetX();
            $y = $this->GetY();

            $wColumn1 = $this->document['w']*.2;
            $wColumn2 = $this->document['w']*.27;
            $wColumn3 = $this->document['w']*.16;
            $wColumn4 = $this->document['w']*.3;

            $this->SetFont($this->font, '', 10);
            $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","Truck Received By ผู้รับรถเข้าซ่อม\nDate/Time (วัน/เวลา)"),0,'L'); 
            $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,"",'B','L');
            $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","Mechanic ช่างซ่อม \nDate/Time (วัน/เวลา)"),0,'L'); 
            $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,"",'B','L');
            
            $y+=10;
            $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","Repair Completed and checked by\nซ่อมเสร็จสมบูรณ์และตรวจสอบโดย"),0,'L'); 
            $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,"",'B','L');
            $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","Receiver/Driver ผู้รับรถ/พขร\nDate/Time (วัน/เวลา)"),0,'L'); 
            $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,"",'B','L');

//            $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","ผู้ขออนุมัติ\nOffer by"),0,'L'); 
//            $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,iconv("UTF-8", "cp874",$job->job_offer_by),'B','L');
//            $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","ผู้แจ้งซ่อม\nDriver"),0,'L'); 
//            $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->job_driver),'B','L');
//            
//            $y+=10;
//            $this->SetXY($x,$y); $this->MultiCell( $wColumn1 ,4, iconv("UTF-8", "cp874","ผู้ขออนุมัติ\nOffer by"),0,'L'); 
//            $this->SetXY($x+$wColumn1,$y);$this->MultiCell( $wColumn2,8,iconv("UTF-8", "cp874",$job->job_offer_by),'B','L');
//            $this->SetXY($x+$wColumn1+$wColumn2,$y); $this->MultiCell( $wColumn3 ,4, iconv("UTF-8", "cp874","ผู้แจ้งซ่อม\nDriver"),0,'L'); 
//            $this->SetXY($x+$wColumn1+$wColumn2+$wColumn3,$y);$this->MultiCell( $wColumn4,8,iconv("UTF-8", "cp874",$job->job_driver),'B','L');
            
        }

        //Add information
//        foreach ($this->addText as $text) {
//            if ($text[0] == 'title') {
//                $this->SetFont($this->font, 'b', 12);
//                $this->SetTextColor(50, 50, 50);
//                $this->Cell(0, 10, iconv("UTF-8", "cp874", strtoupper($text[1])), 0, 0, 'L', 0);
//                $this->Ln();
//                $this->SetLineWidth(0.3);
//                $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
//                $this->Line($this->margins['l'], $this->GetY(), $this->document['w'] - $this->margins['r'], $this->GetY());
//                $this->Ln(4);
//            }
//            if ($text[0] == 'paragraph') {
//                $this->SetTextColor(80, 80, 80);
//                $this->SetFont($this->font, '', 8);
//                $this->MultiCell(0, 4, iconv("UTF-8", "cp874", $text[1]), 0, 'L', 0);
//                $this->Ln(4);
//            }
//        }
    }

    public function Footer() {
        $this->SetY(-$this->margins['t']);
        $this->SetFont($this->font, '', 8);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 10, $this->footernote, 0, 0, 'L');
        $this->Cell(0, 10, $this->lang['page'] . ' ' . $this->PageNo() . ' ' . $this->lang['page_of'] . ' {nb}', 0, 0, 'R');
    }

}
