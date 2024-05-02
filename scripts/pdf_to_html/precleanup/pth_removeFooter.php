<?php
declare(strict_types=1);
/*
    Remove anything above a certain top-value
*/

class pth_removeFooter
{    
    private $maxBottomMargin = 65;
    
    public function __construct(&$obj)
    {
        digi_pdf_to_html::sortByTopThenLeftAsc($obj);
        //-------------------------------
        $this->cleanup($obj);       
    }
    
    //#####################################################################
    private function cleanup(&$obj)
    {
        $pageHeight =   $obj['meta']['pageHeight'];
        $maxTop =       $pageHeight - $this->maxBottomMargin;
        
        foreach( $obj['content'] as $index => $properties) 
        {
            if($properties['top'] < $maxTop )   { continue; }  
            digi_pdf_to_html::removeIndex($obj,$index);
            $this->cleanup($obj);
            return;
        }
    }

    //#####################################################################


}

?>