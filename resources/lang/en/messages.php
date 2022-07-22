<?php

namespace Resources\Lang\en\Messages;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SiteData
{
    public function getData($page)
    {
        $response['from_lang'] = (session()->get('from_lang')) ? session()->get('from_lang') : 'en';
        $response['to_lang'] = (session()->get('to_lang')) ? session()->get('to_lang') : 'en';
        if($page == "LangIndex"){
            $data = $this->index_page();
        } elseif($page == "LangCreate"){
            $data = $this->create_page();
        } elseif($page == "LangEdit"){
            $data = $this->edit_page();
        }
        foreach($data as $key=>$value){
            $message_data[$key] = GoogleTranslate::trans($value, $response['to_lang'], $response['from_lang']);
        }
        $response['data'] = $message_data;
        return $response;
    }
    public function index_page()
    {
        return [
            'title' => 'Multi Language Website in Laravel',

            'create' => 'Create Company',
            'edit' => 'Edit',
            'delete' => 'Delete',

            'table_row_1' => 'S.No',
            'table_row_2' => 'Company Name',
            'table_row_3' => 'Company Email',
            'table_row_4' => 'Company Address',
            'table_row_5' => 'Action',
        ];
    }
    public function create_page()
    {
        return [
            'add_button' => 'Add Company',
            'back_button' => 'Back',
            'submit_button' => 'Submit',

            'create_company_name' => 'Company Name',
            'create_company_email' => 'Company Email',
            'create_company_address' => 'Company Address',
        ];
    }
    public function edit_page(){
        return [
            'edit_button' => 'Edit Company',
            'back_button' => 'Back',
            'submit_button' => 'Submit',

            'create_company_name' => 'Company Name',
            'create_company_email' => 'Company Email',
            'create_company_address' => 'Company Address',
        ];
    }
}
