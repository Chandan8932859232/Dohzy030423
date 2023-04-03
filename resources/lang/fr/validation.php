<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => ':attribute doit être une date postérieure ou égale à :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'Les deux :attribute ne correspondent pas.',
    'date'                 => ":attribute n'est pas valide",
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'Le :attribute doit être :digits chiffres.',
    'digits_between'       => 'Le :attribute doit être entre :min et :max chiffres.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ':attribute doit être une adresse e-mail valide.',
    'exists'               => ":attribute n'est pas valide.",
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'gt'                   => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'string'  => 'The :attribute must be greater than :value characters.',
        'array'   => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        'string'  => 'The :attribute must be greater than or equal :value characters.',
        'array'   => 'The :attribute must have :value items or more.',
    ],
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute ne peut pas être supérieur à :max chiffres.',
        'file'    => ':attribute ne peut pas être supérieur à  :max kilo-octets.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute doit être un fichier de type: :values.',
    'mimetypes'            => ':attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => ':attribute doit être au moins :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute doit être au moins :min caractères.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => ':attribute doit être un nombre.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => ':attribute est obligatoire.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => ':attribute doit être une chaîne.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ':attribute est déjà liée à un compte.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'Adresse e-mail',
        'firstname' => 'Prénom',
        'firstName'=>'Prénom',
        'lastname' => 'Nom',
        'lastName' =>'Nom',
        'password' =>'Mot de passe',
        'referralCode' =>'Code de référence',
        'amountRequested' =>'Montant requise',
        'receiveMoneyDate' =>"Date pour recevoir l'argent",
        'payBackDate' =>'Date de remboursement',
        'interactEmail'=>'Email Pour Virement Interac',
        'autoDepositEnabled'=>'État du dépôt automatique par virement interac',
        'institutionNumber' =>"Numéro d'établissement",
        'transitNumber' =>'Numéro de transit',
        'accountNumber' =>'Numéro de compte',
        'voidChequeImage'=>'Image de chèque annulé',
        'gender'=>'Genre',
        'address'=>'adresse',
        'birthYear'=>'année de naissance',
        'countryOfOrigin'=>"pays d'origine",
        'phoneNumber'=>'Numéro de téléphone',
        'phoneVerificationCode'=>'Code de vérification du téléphone',
        'language'=>'Langue',
        'referralCodePurpose'=>'Objectif du code de référence',
        'name'=>'Nom',
        'message'=>'Message',
        'relationship'=>'Relation',
        'trustLevel'=>'Niveau de confiance',
        'realEstateProveDocument'=>'Document de preuve immobilière',
        'referrer'=>'référent',
        'firstInstallmentPayBackDate'=>'Date de remboursement du premier versement',
        'secondInstallmentPayBackDate' =>'Date de remboursement du deuxième versement',
        'installmentPayBack'=>'Votre réponse sur les versements',
        "amountSent" => 'Montant envoyé',
        "sentMoneyDate" => "Date d'envoi de l'argent",
        "interacPassword" =>"Mot de passe pour Interac",
        "workIndustry"=>"industrie de l'emploi",
        "yearsInCanada"=>"Années passées au Canada",
        "maritalStatus"=>"Statut matrimonial",
        "businessAge" => "Âge de l'entreprise",
        "businessIndustry" => "Industrie d'entreprise",
        "businessCountry" => "Pays d'entreprise",
        "businessRevenue"=>"Chiffre d'affaires de l'entreprise",
        "businessSummary" => "Résumé de l'entreprise",
        "uploadedFile"=>"Fichier téléchargé",
        "payStub"=>"Talon de paie",
        "withdrawAmount"=>"Montant à retirer",
        'contributionPlan'=> 'Plan de cotisations',
        'contributionStartMonth'=> 'Mois de début de cotisation',
        'contributionReceiveMonth'=> 'Mois pour recevoir la contribution',
        'participationPurpose'=>'Objectif de participation'

    ],

];
