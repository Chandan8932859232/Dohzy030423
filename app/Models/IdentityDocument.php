<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class IdentityDocument extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'user_id',
        'document_url',
        'document_verification_status',
        'document_type',
    ];

    //table name
    protected $table ='identification_documents';  //could be changed here

    //primary key
    protected $primaryKey ='id'; //could be changed here


    public function identifyDocumentUploadStatus($userId){

        $identificationUploaded = User::where('id', $userId)->value('identity_doc_upload_status');

        if($identificationUploaded === 1){
            return true;
        }
        return false;

    }

    public function identifyDocumentVerifiedStatus($userId){

        $documentVerified = IdentityDocument::where('user_id', $userId)->value('document_verification_status');

        if($documentVerified === 1){
            return true;
        }
        return false;

    }




}
