<?php
namespace App\Core\Annotation;

interface AnnotationParser {

    public function parse($sAnnotationName, $sExpression);

}
