<?php

require '../vendor/autoload.php';

use Aws\Textract\TextractClient;
use Aws\Exception\AwsException;

$bucketName = 'nome-do-bucket'; // Insira o nome do bucket criado no S3
$file = 'nome-do-arquivo'; // Insira o nome do arquivo do S3 que deseja analisar

$featureTypesExample = ['TABLES']; // Valores aceitos: TABLES | FORMS | QUERIES | SIGNATURES | LAYOUT
$queriesConfig = [
        'Queries' => [
            ['Text' => 'What organization issued this document?'],
        ]
    ];

// Instanciar o cliente Textract
$textract = new TextractClient([
    'version' => 'latest',
    'region' => 'us-east-1',  // Ajuste a região conforme necessário
]);

// Testar a chamada ao Textract
try {
    $result = $textract->analyzeDocument([
        'Document' => [
            'S3Object' => [
                'Bucket' => $bucketName,
                'Name' => $file,  // Exemplo: 'documentos/exemplo.pdf'
            ],
        ],
        'FeatureTypes' => $featureTypesExample,
        // 'QueriesConfig' => $queriesConfig,
    ]);

    print_r($result);
} catch (AwsException $e) {
    echo $e->getMessage();
}
