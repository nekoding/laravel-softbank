<?php

namespace Nekoding\LaravelSoftbank\Traits\Payload;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait PayloadSerializer
{
    
    /**
     * encoders
     *
     * @var array
     */
    private $encoders;
        
    /**
     * normalizers
     *
     * @var array
     */
    private $normalizers;

    public function __construct()
    {
        if (!$this->encoders && !$this->normalizers) {
            $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

            $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

            $xmlEncoder = new XmlEncoder([
                XmlEncoder::ROOT_NODE_NAME => 'sps-api-request',
                XmlEncoder::ENCODING => 'Shift_JIS',
            ]);

            $objectNormalizer = new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter);

            $this->encoders = [$xmlEncoder];

            $this->normalizers = [$objectNormalizer, new ArrayDenormalizer(), new GetSetMethodNormalizer()];
        }
    }

    public function generatePayload($data, string $requestId)
    {
        return (new Serializer($this->normalizers, $this->encoders))->serialize([
            '@id'   => $requestId,
            '#'     => $data
        ], XmlEncoder::FORMAT, [
            AbstractObjectNormalizer::SKIP_UNINITIALIZED_VALUES => true,
            AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
        ]);
    }

    public function deserializeData($data, string $className)
    {
        return (new Serializer($this->normalizers, $this->encoders))->deserialize($data, $className, 'xml', [
            AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true
        ]);
    }
}
