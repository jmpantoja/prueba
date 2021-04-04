<?= $entity['fullName'] ?>:
    collectionOperations:
        get:
            filters:
        post: ~

    properties:
        id:
            identifier: true

    attributes:
        input: <?= $input['fullName'] ."\n"?>
        output: <?= $output['fullName'] ."\n" ?>
    normalization_context:
        groups: [ 'read' ]
    denormalization_context:
        groups: [ 'write' ]

