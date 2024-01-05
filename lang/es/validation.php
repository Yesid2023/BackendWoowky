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

    'accepted' => 'El :atributo debe ser aceptado.',
    'accepted_if' => 'El :atributo debe aceptarse cuando :otro es :valor.',
    'active_url' => 'El atributo :no es una URL válida.',
    'after' => 'El :atributo debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El :atributo debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El atributo :solo debe contener letras.',
    'alpha_dash' => 'El atributo :solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El atributo :solo debe contener letras y números.',
    'array' => 'El :atributo debe ser una matriz.',
    'before' => 'El :atributo debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El :atributo debe ser una fecha anterior o igual a :fecha.','entre' => [
        'array' => 'El :atributo debe tener entre :min y :max elementos.',
        'file' => 'El :atributo debe estar entre :min y :max kilobytes.',
        'numeric' => 'El :atributo debe estar entre :min y :max.',
        'string' => 'El atributo : debe estar entre caracteres :min y :max.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación del atributo no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El :atributo no es una fecha válida.',
    'date_equals' => 'El :atributo debe ser una fecha igual a :date.',
    'date_format' => 'El :atributo no coincide con el formato :formato.',
    'declined' => 'El :atributo debe ser rechazado.',
    'declined_if' => 'El :atributo debe rechazarse cuando :otro es :valor.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :atributo debe ser :dígitos dígitos.',
    'digits_between' => 'El :atributo debe estar entre :min y :max dígitos.',
    'dimensions' => 'El atributo :tiene dimensiones de imagen no válidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El :atributo debe terminar con uno de los siguientes: :valores.',
    'enum' => 'El :atributo seleccionado no es válido.',
    'exists' => 'El :atributo seleccionado no es válido.',
    'file' => 'El :atributo debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'El :attribute debe tener más de :value elementos.',
        'file' => 'El atributo :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El :atributo debe ser mayor que :valor.',
        'string' => 'El atributo : debe ser mayor que los caracteres :value.',
    ],
    'gte' => [
        'array' => 'El :attribute debe tener :value elementos o más.',
        'file' => 'El :atributo debe ser mayor o igual que :value kilobytes.',
        'numeric' => 'El :atributo debe ser mayor o igual que :valor.',
        'string' => 'El atributo : debe ser mayor o igual que los caracteres :value.',
    ],
    'image' => 'El atributo : debe ser una imagen.',
    'in' => 'El :atributo seleccionado no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El :atributo debe ser un número entero.',
    'ip' => 'El atributo : debe ser una dirección IP válida.',
    'ipv4' => 'El atributo : debe ser una dirección IPv4 válida.',
    'ipv6' => 'El atributo : debe ser una dirección IPv6 válida.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'array' => 'El atributo :attribute debe tener menos elementos que :value.',
        'file' => 'El atributo :attribute debe ser inferior a :value kilobytes.',
        'numeric' => 'El :atributo debe ser menor que :valor.',
        'string' => 'El :attribute debe tener menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'El :attribute no debe tener más de :value elementos.',
        'file' => 'El :attribute debe ser menor o igual que :value kilobytes.',
        'numeric' => 'El :atributo debe ser menor o igual que :valor.',
        'string' => 'El atributo : debe ser menor o igual que los caracteres :value.',
    ],
    'mac_address' => 'El :atributo debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'El :atributo no debe tener más de :max elementos.',
        'file' => 'El :atributo no debe ser mayor que :max kilobytes.',
        'numeric' => 'El :atributo no debe ser mayor que :max.',
        'string' => 'El :atributo no debe tener más de :max caracteres.',
    ],
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El :atributo debe tener al menos :min elementos.',
        'file' => 'El :atributo debe tener al menos :min kilobytes.',
        'numeric' => 'El :atributo debe ser al menos :min.',
        'string' => 'El :atributo debe tener al menos :min caracteres.',
    ],
    'multiple_of' => 'El :atributo debe ser un múltiplo de :valor.',
    'not_in' => 'El :atributo seleccionado no es válido.',
    'not_regex' => 'El formato :attribute no es válido.',
    'numeric' => 'El :atributo debe ser un número.',
    'present' => 'El campo :attribute debe estar presente.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',
    'regex' => 'El formato :attribute no es válido.',
    'required' => 'El campo :atributo es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :atributo es obligatorio cuando :otro es :valor.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values ​​está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando los valores están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values ​​no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los :values ​​está presente.',
    'same' => 'El :atributo y :otro deben coincidir.',
    'size' => [
        'array' => 'El :atributo debe contener elementos :size.',
        'file' => 'El :atributo debe ser :size kilobytes.',
        'numeric' => 'El :atributo debe ser :tamaño.',
        'string' => 'El :atributo debe tener :caracteres de tamaño.',
    ],
    'starts_with' => 'El :atributo debe comenzar con uno de los siguientes: :valores.',
    'string' => 'El :atributo debe ser una cadena.',
    'timezone' => 'El :atributo debe ser una zona horaria válida.',
    'unique' => 'El :atributo ya ha sido tomado.',
    'uploaded' => 'El atributo no se pudo cargar.',
    'url' => 'El :atributo debe ser una URL válida.',
    'uuid' => 'El :atributo debe ser un UUID válido.',

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
            'rule-name' => 'mensaje personalizado',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
