<?php

namespace ilateral\SilverStripe\PinterestTags;

use SilverStripe\TagManager\SnippetProvider;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\View\ArrayData;

/**
 * A snippet provider that lets you add arbitrary HTML
 */
class PinterestVerificationTag implements SnippetProvider
{

    public function getTitle()
    {
        return "Pinterest Verification Tag";
    }

    public function getParamFields()
    {
        return new FieldList(
            TextField::create(
                "VerificationCode",
                "Verification Code"
            )
        );
    }

    public function getSummary(array $params)
    {
        return $this->getTitle();
    }

    public function getSnippets(array $params)
    {
        if (empty($params['VerificationCode'])) {
            return [];
        }

        $snippet = ArrayData::create($params)
            ->renderWith(static::class)
            ->raw();

        return [
            SnippetProvider::ZONE_HEAD_START => $snippet
        ];
    }
}