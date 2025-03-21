<?php

namespace Weglot\Parser\Check\Dom;

use Weglot\Client\Api\Enum\WordType;

class InputRadioOrderText extends AbstractDomChecker
{
    const DOM = 'input[type="radio"]';

    const PROPERTY = 'data-order_button_text';

    const WORD_TYPE = WordType::VALUE;
}
