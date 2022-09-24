<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\User;
use App\Models\Personal_access_token;
use Illuminate\Http\Request;
use GraphQL\Error\Error;
use PDF;
use Auth;

class Exportpdf extends Controller
{
    public function generatePDF(Request $request)
    {  
    [$token_id, $token] = explode('|', $request->token, 2);
    $id_token = Personal_access_token::where('token', hash('sha256', $token))->select('tokenable_id')->get();
    $id_token_test = json_decode($id_token);
    if($id_token_test == []){
        return "Unauthenticated";
    }
    $id = $id_token_test[0]->tokenable_id; 
       $company_id = User::where('id','=',$id)->select('company_id')->get();
       $company_id_test = json_decode($company_id);
       $user_type = User::where('id','=',$id)->select('type')->get();
       $user_type_test = json_decode($user_type);
       if($user_type_test[0]->type == "admin"){
        $contact = Contact::whereIn('id',explode('_',$request->contact_id))->where('company_id','=',$company_id_test[0]->company_id)->select('id','image','first_name','last_name','email','phone')->get();
       }else{
        $contact = Contact::whereIn('id',explode('_',$request->contact_id))->where('user_id','=',$id)->where('company_id','=',$company_id_test[0]->company_id)->select('id','image','first_name','last_name','email','phone')->get();
       }
       $contact_test = json_decode($contact);
       
        //  dd(array("contact"=>$contact)); 
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('myPDF', array("contact"=>$contact_test));
    
        return $pdf->stream('contactsbook.pdf');
    // return $contact;
    } 
}
