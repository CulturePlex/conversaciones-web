<?php

namespace Weglot\Parser\Check\Dom;

use Weglot\Client\Api\Enum\WordType;

class ImageAlt extends AbstractDomChecker
{
    const DOM = 'img';

    const PROPERTY = 'alt';

    const WORD_TYPE = WordType::IMG_ALT;

    const ESCAPE_SPECIAL_CHAR = true;
}
