<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class RealEstateProveDocument extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'user_id',
        'loan_id',
        'document_url',
        'document_verification_status',
        'document_type',
    ];


    //table name
    protected $table ='real_estate_ownership_prove_docs';  //could be changed here

    //primary key
    protected $primaryKey ='id'; //could be changed here

   /*
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

    } */




}
