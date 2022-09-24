<?php

namespace App\GraphQL\Mutations;

use App\Models\Contact;
use App\Models\User;
use PDF;
final class ExportPDF
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
/*         $id = auth()->user()->id;

 
        $contact = Contact::where('user_id','=',$id)->select('id','image','first_name','last_name','email','phone')->get();
      
       $contact_test = json_decode($contact);
       
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('myPDF', array("contact"=>$contact_test));
    
        return $pdf->stream('contactsbook.pdf'); */
    }
}
