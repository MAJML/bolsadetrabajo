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

    'accepted'             => 'El  :attribute debe ser aceptado.',
    'active_url'           => 'El  :attribute no es una URL válida.',
    'after'                => 'El  :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El  :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El  :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
    'alpha_num'            => 'El  :attribute sólo puede contener letras y números.',
    'array'                => 'El  :attribute debe ser un array.',
    'before'               => 'El  :attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => 'El  :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El  :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El  :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El  :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El  confirmación de :attribute no coincide.',
    'date'                 => 'El  :attribute no corresponde con una fecha válida.',
    'date_format'          => 'El  :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los s :attribute y :other han de ser diferentes.',
    'digits'               => 'El  :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El  :attribute debe contener entre :min y :max dígitos.',
    'email'                => 'El  :attribute no corresponde con una dirección de e-mail válida.',
    'filled'               => 'El  :attribute es obligatorio.',
    'exists'               => 'El  :attribute no existe.',
    'image'                => 'El  :attribute debe ser una imagen.',
    'in'                   => 'El  :attribute debe ser igual a alguno de estos valores :values',
    'integer'              => 'El  :attribute debe ser un número entero.',
    'ip'                   => 'El  :attribute debe ser una dirección IP válida.',
    'json'                 => 'El  :attribute debe ser una cadena de texto JSON válida.',
    'max'                  => [
        'numeric' => 'El  :attribute debe ser :max como máximo.',
        'file'    => 'El archivo :attribute debe pesar :max kilobytes como máximo.',
        'string'  => 'El  :attribute debe contener :max caracteres como máximo.',
        'array'   => 'El  :attribute debe contener :max elementos como máximo.',
    ],
    'mimes'                => 'El  :attribute debe ser un archivo de tipo :values.',
    'min'                  => [
        'numeric' => 'El  :attribute debe tener al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El  :attribute debe contener al menos :min caracteres.',
        'array'   => 'El  :attribute no debe contener más de :min elementos.',
    ],
    'not_in'               => 'El  :attribute seleccionado es invalido.',
    'numeric'              => 'El  :attribute debe ser un numero.',
    'regex'                => 'El formato del  :attribute es inválido.',
    'required'             => 'El  :attribute es obligatorio',
    'required_if'          => 'El  :attribute es obligatorio cuando el  :other es :value.',
    'required_with'        => 'El  :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El  :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El  :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El  :attribute es obligatorio cuando ningún  :values están presentes.',
    'same'                 => 'Los s :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El  :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El  :attribute debe contener :size caracteres.',
        'array'   => 'El  :attribute debe contener :size elementos.',
    ],
    'string'               => 'El  :attribute debe contener solo caracteres.',
    'timezone'             => 'El  :attribute debe contener una zona válida.',
    'unique'               => 'El :attribute ya está en uso.',
    'url'                  => 'El formato de :attribute no corresponde con el de una URL válida.',

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

    'attributes' => [],

];
